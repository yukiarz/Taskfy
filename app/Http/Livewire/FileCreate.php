<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Attc;
use Livewire\WithFileUploads;

class FileCreate extends Component
{
    use WithFileUploads;
    public $attcs, $file, $name, $aid, $attc;
    public function mount($aid){
        $this->attcs = Attc::where('activity_id',$aid)->get();
        $this->aid = $aid;
    }
    public function refresh($aid){
        $this->attcs = Attc::where('activity_id',$aid)->get();
        $this->aid = $aid;

    }

    public function download($id){
        $attc = Attc::where('id',$id)->first();
        return response()->download(public_path('../storage/app/public/attc/'.$attc->file));
    }

    public function uploadAttc($aid){
        $filename = $this->name.'.'.$this->attc->getClientOriginalExtension();
        $this->attc->storePubliclyAs('public/attc', $filename);
        Attc::create([
            'user_id' => 1,
            'activity_id' => $aid,
            'file' => $filename,
        ]);

        $this->refresh($aid);
    }

    public function render()
    {
        return view('livewire.file-create');
    }
}
