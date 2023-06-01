<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Contributor;
use Illuminate\Http\Request;

class ContributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $contributor = Contributor::where('user_id', 'LIKE', "%$keyword%")
                ->orWhere('project_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $contributor = Contributor::latest()->paginate($perPage);
        }

        return view('contributor.index', compact('contributor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('contributor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Contributor::create($requestData);

        return redirect('contributor')->with('flash_message', 'Contributor added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $contributor = Contributor::findOrFail($id);

        return view('contributor.show', compact('contributor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $contributor = Contributor::findOrFail($id);

        return view('contributor.edit', compact('contributor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $contributor = Contributor::findOrFail($id);
        $contributor->update($requestData);

        return redirect('contributor')->with('flash_message', 'Contributor updated!');
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
        Contributor::destroy($id);

        return redirect('contributor')->with('flash_message', 'Contributor deleted!');
    }
}
