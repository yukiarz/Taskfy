<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LogTask;

class LogTaskUser extends Component
{
    public $tasks;
    public $today;

    public function openModal(){
        $tasks = LogTask::where('user_id',auth()->id())->first();
        $this->today = $tasks->today;
        $this->dispatchBrowserEvent('openModal');
    }
    public function closeModal(){
        $this->dispatchBrowserEvent('closeModal');
    }
    public function render()
    {
        $this->tasks = LogTask::all();
        return view('livewire.log-task-user');
    }


    public function edit($id)
    {
        $tasks = LogTask::where('id',$id)->where('user_id',auth()->id())->first();
        $this->today = $project->tasks;
        $this->dispatchBrowserEvent('openModal');

    }

    public function save()
    {
        LogTask::updateOrCreate(['user_id' => auth()->id()], [
            'today' => $this->today,
            'user_id' => auth()->id(),
        ]);
        $this->today = null;
        $this->dispatchBrowserEvent('closeModal');

    }

    public function delete($id)
    {
        $project = LogTask::findOrFail($id);
        $project->delete();
    }
}
