<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Checklist;
use Auth;
class ChecklistCreate extends Component
{
    public $activity_id, $title, $description, $aid;

    public function openChecklistForm(){
        $this->dispatchBrowserEvent('openChecklistForm');
    }
    public function closeChecklistForm(){
        $this->dispatchBrowserEvent('closeChecklistForm');
    }

    public function storeChecklist($aid){
        Checklist::create([
            'activity_id' => $aid,
            'name' => $this->title,
            'description' => $this->description,
            'status' => 0,
            'created_by' => Auth::id(),
        ]);
        
        session()->flash('success','Success add new checklist');

        $this->title = NULL;
        $this->description = NULL;

        $this->emit('addChecklist',$aid);
    }

    public function render()
    {
        return view('livewire.checklist-create');
    }
}
