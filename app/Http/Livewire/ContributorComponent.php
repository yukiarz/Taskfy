<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contributor;
use Illuminate\Support\Facades\DB;
class ContributorComponent extends Component
{
    public $showContributorPanel = false;
    public $cid;
    public $contributors, $project_id, $addContributors;




    // public function updatedSelectedOptions()
    // {
    //     $this->emitUp('storeContributor', $this->contributors_id);
    // }


    public function storeContributor($project_id){
        dd($this->cid);

       
    }


    // $this->contributors_id = [];

    // $this->refresh($project_id);
    // $this->emit('loadSelect2');


    public function sidePanelContributor($project_id){
        $this->showContributorPanel = true;
        $this->emit('loadSelect2');
        $this->getDataContributor($project_id);


    }

    public function hydrate()
    {
        $this->emit('loadSelect2');
        $this->emit('select2');


    }
    public function mount($project_id){
        $this->getDataContributor($project_id);
        $this->emit('loadSelect2');
       
    }

    public function refresh($pid){
        $this->showContributorPanel = true;

        $this->getDataContributor($pid);
        $this->emit('loadSelect2');

    }

    public function render()
    {
        return view('livewire.contributor-component');
    }

    public function getDataContributor($project_id){
        $this->contributors = Contributor::where('project_id',$project_id)->get();
        $this->addContributors = DB::table('users as u')
                ->leftJoin('contributors as c', 'u.id', '=', 'c.user_id')
                ->leftJoin('projects as p', 'p.id', '=', 'c.project_id')
                ->whereNotIn('u.id', function($subquery) use ($project_id) {
                    $subquery->select('user_id')
                        ->from('contributors')
                        ->where('project_id', $project_id);
                })
                ->select('u.id', 'u.name')
                ->get();
    }


}
