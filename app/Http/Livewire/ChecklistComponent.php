<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Checklist;
use App\Models\Activity;
use Auth;
    
class ChecklistComponent extends Component
{
    public $show, $checks, $act, $cid, $aid;

    protected $listeners = ['addChecklist'=>'refresh', 'checklistUpdate'=>'load'];
    

    function checklistUpdate($cid){
        $data = Checklist::where('id',$cid)->first();

        if($data->status == 0){
            $data->status = 1;
            $data->updated_by = Auth::id();
        }else{
            $data->status = 0;
            
        }
        $data->save();
        $this->emit('checklistUpdate',$data->activity_id);
    }

    public function load($activity_id){
        $this->show = true;
        $this->checks = Checklist::where('activity_id',$activity_id)->get();
    }

    public function refresh($aid){
        $this->show = true;
        $this->act = Activity::where('id',$aid)->first();
        $this->checks = Checklist::where('activity_id',$aid)->get();
        $this->aid = $aid;
        $this->dispatchBrowserEvent('checklistSuccess');

    }

    public function mount($activity_id){
        $this->show = true;
        $this->aid = $activity_id;

        $this->checks = Checklist::where('activity_id',$activity_id)->get();
    }

    public function render()
    {
        return view('livewire.checklist-component');
    }
}
