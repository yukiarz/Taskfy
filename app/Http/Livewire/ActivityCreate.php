<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use DB;
use Auth;

class ActivityCreate extends Component{

    public $title;
    public $description;
    public $project_id;
    public $pid;
    public $complete;
    public $process;
    public $projectProgress;

    protected $listeners = [
        'progressUpdate'=>'projectProgressBar',
        // 'progressUpdate'=>'checklist',
    ];

    public function openActivityForm(){
        $this->dispatchBrowserEvent('openActivityForm');
    }
    public function closeActivityForm(){
        $this->dispatchBrowserEvent('closeActivityForm');
    }

    public function projectProgressBar($pid){
        $this->complete = DB::table('projects as p')
        ->join('activities as a', 'a.project_id', '=', 'p.id')
        ->join('checklists as c', 'c.activity_id', '=', 'a.id')
        ->where('status', 1)
        ->where('p.id', $pid)
        ->count();
        $this->process = DB::table('projects as p')
        ->join('activities as a', 'a.project_id', '=', 'p.id')
        ->join('checklists as c', 'c.activity_id', '=', 'a.id')
        ->select('status')
        ->where('p.id', $pid)
        ->count();
        if($this->process == 0){
            $this->projectProgress = 0;
        }else{
            $this->projectProgress = round(($this->complete * 100) / $this->process);

        }
    }   

    public function mount($project_id){
        $this->projectProgressBar($project_id);
    }
    
    public function refresh($project_id){
        $this->projectProgressBar($project_id);
    }

    public function storeActivity($pid){
        Activity::create([
            'project_id' => $pid,
            'user_id' => Auth::id(),
            'name' => $this->title,
            'description' => $this->description,
        ]);

        $this->title = NULL;
        $this->description = NULL;
        $this->dispatchBrowserEvent('closeActivityForm');
        $this->emit('addActivity',$pid);
    }




    

    public function render()
    {
        return view('livewire.activity-create');
    }
}
