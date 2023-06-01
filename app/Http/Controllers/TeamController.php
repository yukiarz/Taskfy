<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Facades\Hash;

class TeamController extends Controller
{

    public function index()
    {
        $teams = User::with('userSetting')->get();
        return view('teams.index',compact('teams'));
    }


    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $this->submit($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('teams.edit');
    }


    public function update(Request $request, $id)
    {
        $this->submit($request, $id);


    }


    public function destroy($id)
    {
        User::where('id',$id)->delete();
        UserSetting::where('id',$id)->delete();

    }

    public function submit($request, $id){
        if(!$id){
            $user = new User();
            $userSetting = new UserSetting();
        }else{
            $user = User::where('id',$id)->first();
            $userSetting = UserSetting::where('id',$id)->first();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $userSetting->level = $request->level;
        $userSetting->phone = $request->phone;
        $userSetting->posisition = $request->posisition;
        $userSetting->profile = $request->profile;

        $user->save();
        $userSetting->save();

    }
}
