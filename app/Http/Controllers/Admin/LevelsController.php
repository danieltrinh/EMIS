<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Level;
use Illuminate\Http\Request;
use Session;

class LevelsController extends Controller
{
    public function index()
    {
        $relations = [
            'levels' => \App\Level::get(),
            'schools' => \App\School::get(),
            'grades'  => \App\Grade::get(),
            'classrooms' => \App\Classroom::get(),
            'subjects' => \App\Subject::get(),

        ];
        return view('admin.levels.index', $relations );
    }


    public function create()
    {
        return view('admin.levels.create');
    }


    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Level::create($requestData);

        Session::flash('flash_message', 'Level added!');

        return redirect('admin/levels');
    }

    public function show($id)
    {
        $level = Level::findOrFail($id);

        return view('admin.levels.show', compact('level'));
    }

    public function edit($id)
    {
        $level = Level::findOrFail($id);

        return view('admin.levels.edit', compact('level'));
    }

    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $level = Level::findOrFail($id);
        $level->update($requestData);

        Session::flash('flash_message', 'Level updated!');

        return redirect('admin/levels');
    }

    public function destroy($id)
    {
        Level::destroy($id);

        Session::flash('flash_message', 'Level deleted!');

        return redirect('admin/levels');
    }
}
