<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Project;
use App\Models\User;
use App\Models\Contributor;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;
class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){


        if ($request->ajax()) {
            $data = Project::whereHas('contributor', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();
    
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                        $btn = '
                        <a
                        type="button"
                        class="dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                        <a href="'.route('project.show', $data->id).'" class="dropdown-item" title="View Project">View</a>

                        <a href="'.route('project.edit', $data->id).'" class="dropdown-item" title="Edit Project">Edit</a>
                        
                        <form method="POST" action="'.route('project.destroy', $data->id).'" accept-charset="UTF-8" style="display:inline">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="dropdown-item" title="Delete Project" onclick="deleteConfirmation('.$data->id.')">Delete
                            </button>
                        </form>
                        </li>
                    </ul>
                        ';
                        return $btn;
                })
                ->editColumn('by', function($data){
                    return $data->user->name;
                })
                ->editColumn('deadline', function($data){
                    $deadline = '
                        <div id="hide-element" class="deadline'.$data->id.'">'.date('F d, Y H:i:s', strtotime($data->deadline)).'
                        </div>
                        <div class="countDown'.$data->id.'"></div>
                       
                    ';

                    return $deadline;
                })
                ->editColumn('progress', function($data){
                    $complete = DB::table('projects as p')
                    ->join('activities as a', 'a.project_id', '=', 'p.id')
                    ->join('checklists as c', 'c.activity_id', '=', 'a.id')
                    ->where('status', 1)
                    ->where('p.id', $data->id)
                    ->count();
                    $process = DB::table('projects as p')
                    ->join('activities as a', 'a.project_id', '=', 'p.id')
                    ->join('checklists as c', 'c.activity_id', '=', 'a.id')
                    ->select('status')
                    ->where('p.id', $data->id)
                    ->count();
                    if($process == 0){
                        $projectProgress = 0;
                    }else{
                        $projectProgress = round(($complete * 100) / $process);
            
                    }
                    $bar = '
                    <div class="progress h15 mt-3 mb-3">
                    <div class="progress-bar h15 progress-bar-striped progress-bar-animated bg-success" 
                    role="progressbar h15" 
                    style="width:'.$projectProgress.'%;" 
                    aria-valuenow="'.$projectProgress.'" 
                    aria-valuemin="0" 
                    aria-valuemax="100">'.$projectProgress.'%</div>
                    </div>
                    ';
                    return $bar;

                })
                ->rawColumns(['action','deadline','progress'])
                ->make(true);
        }

        return view('project.index');

        
    }

    public function create(){
        $users = User::where('id','!=',Auth::id())->get();
        return view('project.create',compact('users'));
    }


    public function store(Request $request){
        
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $project = Project::create($data);

        $contributorData = [
            'user_id' => Auth::id(),
            'project_id' => $project->id,
        ];

        $contributors = [];
        foreach ($request->user_id as $user_id){
            $contributors[] = [
                'project_id' => $project->id,
                'user_id' => $user_id
            ];
        }
        Contributor::create($contributors);
        Contributor::create($contributorData);
        
        return redirect('project')->with('flash_message', 'Project added!');
    }


    public function show($id){

        $contributors = Contributor::where('project_id',$id)->get();
        $value = [];
        foreach ($contributors as $key => $contributor) {
            $value[] = $contributor->user_id;
        }
        // return $value;
        if(!in_array(Auth::id(), $value)){
            return redirect('project')->with('error', 'You are not contributor!');
            
            
        }
        $project = Project::where('id',$id)->first();
        return view('project.show', compact('project'));
    }

    public function edit($id){
        $project = Project::findOrFail($id);
        $users = DB::table('users as u')
                ->leftJoin('contributors as c', 'u.id', '=', 'c.user_id')
                ->leftJoin('projects as p', 'p.id', '=', 'c.project_id')
                ->whereNotIn('u.id', function($subquery) use ($id) {
                    $subquery->select('user_id')
                        ->from('contributors')
                        ->where('project_id', $id);
                })
                ->select('u.id', 'u.name')
                ->get();
        return view('project.edit', compact('project','users'));
    }


    public function update(Request $request, $id)
    {
        
        $data = Project::where('id',$id)->first();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->start = $request->start;
        $data->deadline = $request->deadline;
        $data->save();

        $contributors = [];
        foreach ($request->user_id as $user_id){
            $contributors[] = [
                'project_id' => $id,
                'user_id' => $user_id
            ];
        }
        Contributor::insert($contributors);

        return redirect('project')->with('flash_message', 'Project updated!');
    }


    public function destroy($id)
    {
        Project::destroy($id);

        return redirect('project')->with('flash_message', 'Project deleted!');
    }
}
