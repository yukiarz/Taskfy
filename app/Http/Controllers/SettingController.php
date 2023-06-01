<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class SettingController extends Controller
{

    public function index(Request $request)
    {
        $setting = User::with('userSetting')->where('id', Auth::id())->first();
        // return $setting;
        return view('setting.index',compact('setting'));
    }


    public function create()
    {
        return view('setting.create');
    }


    public function store(Request $request)
    {
        
        $requestData = $request->all();
        Setting::create($requestData);
        return redirect('setting')->with('flash_message', 'Setting added!');
    }


    public function show($id)
    {
        $setting = Setting::findOrFail($id);

        return view('setting.show', compact('setting'));
    }

    public function edit($id)
    {
        $setting = Setting::findOrFail($id);

        return view('setting.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $setting = Setting::findOrFail($id);
        $setting->update($requestData);

        return redirect('setting')->with('flash_message', 'Setting updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Setting::destroy($id);

        return redirect('setting')->with('flash_message', 'Setting deleted!');
    }
}
