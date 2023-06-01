<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Checklist;
use Auth;

class ActivityComponent extends Component
{
    public $activities, $project_id, $checks, $activity, $act, $aid, $name, $description, $data, $did;
    public $show = false;
    public $deleteId = '';
    public $display = false;
    public $opacity = false;
    public $activityProgress = 0;
    
    protected $listeners = [
        'addActivity'=>'refresh',
        'checklistUpdate'=>'checklist',
        'addChecklist'=>'checklist',
        // 'progressUpdate'=>'checklist',
    ];

    public function mount($project_id){
        $this->activities = Activity::where('project_id',$project_id)->get();
    }

    // reload after add new activity
    public function refresh($pid){
        $this->activities = Activity::where('project_id',$pid)->get();
        $this->dispatchBrowserEvent('activitySuccess');
    }

    
    public function checklist($aid){
        $this->show = true;
        $this->act = Activity::where('id',$aid)->first();
        $this->checks = Checklist::where('activity_id',$aid)->get();

        // activity progress bar
        if($this->checks->count() == 0){
            $this->activityProgress = 0;
        }else{ 
            $countTrue = Checklist::where('activity_id',$aid)->where('status',1)->count();
            $countAll = Checklist::where('activity_id',$aid)->count();
            $this->activityProgress = round(($countTrue * 100) / $countAll);
        }
        $this->emit('progressUpdate',$this->act->project_id);
    }
        

    // Edit activity
    public function openActivityFormEdit($aid){
        $this->display = true;
        $this->dispatchBrowserEvent('openActivityFormEdit');
        $this->data = Activity::where('id',$aid)->first();
        $this->name = $this->data->name;
        $this->description = $this->data->description;

    }

    public function closeActivityFormEdit(){
        $this->dispatchBrowserEvent('closeActivityFormEdit');
    }

    public function updateActivity($aid){
        $query = Activity::where('id',$aid)->first();
        $query->update([
            'name' => $this->name,
            'description' => $this->description,
            'user_id' => Auth::id(),
        ]);
        $this->dispatchBrowserEvent('closeActivityFormEdit');

        $this->refresh($query->project_id);

        // $this->emit('updateActivity',$query->project_id);

    }

    // DELETE ACTIVITY
    public function deleteActivity($did){
        $this->opacity = true;
        $this->dispatchBrowserEvent('deleteActivity');
        $this->did = $did;
    }

    public function closeDeleteActivity(){
        $this->dispatchBrowserEvent('closeDeleteActivity');

    }  

    public function delete($did)
    {
        $data = Activity::where('id',$did)->first();
        
        Activity::where('id',$did)->delete();
        $this->dispatchBrowserEvent('closeDeleteActivity');

        $this->refresh($data->project_id);
    }
    public function render()
    {
        return view('livewire.activity-component');
    }

}
