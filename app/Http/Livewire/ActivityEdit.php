<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use Auth;
class ActivityEdit extends Component
{
    public $aid;
    public $title;
    public $description;
    public $data;

    protected $listeners = [
        'detailActivity'=>'mount',
    ];





    // public function mount($aid){
    //     $this->data = Activity::where('id',$aid)->first();
    // }

    // public function refresh($aid){
    //     $this->data = Activity::where('id',$aid)->first();
    // }



    public function render()
    {
        return view('livewire.activity-edit');
    }
}
