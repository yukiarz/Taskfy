<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Reminder;
use App\Models\User;
use App\Models\UserReminder;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class ReminderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Reminder::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                        $btn = '
                        <div class="btn-group">
                        <a href="'.route('reminder.edit',$data->id).'" class="btn btn-success btn-sm"><i class="bx bxs-edit"></i></a>

                        <form method="POST" action="'.route('reminder.destroy', $data->id).'">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="delete-confirm btn btn-sm btn-danger" onclick="deleteConfirmation('.$data->id.')"><i class="bx bx-trash"></i></button>
                        </form>
                        </div>
                        ';
                        return $btn;
                })
                ->editColumn('user', function($data){
                    $userReminder;
                    foreach($data->user as $user){
                        $userReminder[] = '<span class="badge bg-secondary">'.$user->name.'</span>';
                    }
                    return $userReminder;
                })
                ->rawColumns(['action'])
                ->escapeColumns('user')
                ->make(true);
        }

        return view('reminder.index');


        // $keyword = $request->get('search');
        // $perPage = 25;

        // if (!empty($keyword)) {
        //     $reminder = Reminder::where('user_id', 'LIKE', "%$keyword%")
        //         ->orWhere('text', 'LIKE', "%$keyword%")
        //         ->latest()->paginate($perPage);
        // } else {
        //     $reminder = Reminder::latest()->paginate($perPage);
        // }

        // return view('reminder.index', compact('reminder'));
    }

    public function create()
    {
        $users = User::all();
        return view('reminder.create',compact('users'));
    }


    public function store(Request $request)
    {

        $reminder = new Reminder();
        $reminder->description = $request->description;
        $reminder->save();
        foreach ($request->user_id as $uid) {
            $userReminder = new UserReminder();
            $userReminder->user_id = $uid;
            $userReminder->reminder_id = $reminder->id;
            $userReminder->save();
        }


        return redirect('reminder')->with('success', 'Reminder added!');
    }


    public function show($id)
    {
        $reminder = Reminder::findOrFail($id);

        return view('reminder.show', compact('reminder'));
    }


    public function edit($id)
    {
        $reminder = Reminder::where('id',$id)->first();

        return view('reminder.edit', compact('reminder'));
    }


    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $reminder = Reminder::findOrFail($id);
        $reminder->update($requestData);

        return redirect('reminder')->with('flash_message', 'Reminder updated!');
    }


    public function destroy($id)
    {
        Reminder::where('id',$id)->delete();
        UserReminder::where('reminder_id',$id)->delete();

        return back()->with('success','Success deleted data');
    }
}
