<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Target;
use Illuminate\Http\Request;
use DataTables;
use Auth;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Target::where('user_id',Auth::id())->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                        $btn = '
                        <div class="btn-group">
                        <a href="'.route('target.edit',$data->id).'" class="btn btn-success btn-sm"><i class="bx bxs-edit"></i></a>

                        <form method="POST" action="'.route('target.destroy', $data->id).'">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="delete-confirm btn btn-sm btn-danger" onclick="deleteConfirmation('.$data->id.')"><i class="bx bx-trash"></i></button>
                        </form>
                        </div>
                        ';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('target.index');
    }

    public function create()
    {
        return view('target.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        $requestData['user_id'] = Auth::id();
        Target::create($requestData);
        return back()->with('success','Success add data');
    }

    public function show($id)
    {
        $target = Target::where('id',$id)->first();

        return view('target.show', compact('target'));
    }


    public function edit($id)
    {
        $target = Target::where('id',$id)->first();
        return view('target.edit', compact('target'));
    }


    public function update(Request $request, $id)
    {
        $request->user_id = 2;
        $requestData = $request->all();
        $target = Target::where('id',$id)->first();
        $target->update($requestData);

        return redirect('target')->with('flash_message', 'Target updated!');
    }

    public function destroy($id)
    {
        Target::destroy($id);
        return redirect('target')->with('flash_message', 'Target deleted!');
    }
}
