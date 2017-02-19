<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\School;
use Illuminate\Http\Request;
use Session;

class SchoolsController extends Controller
{

    public function index()
    {
        $schools = School::paginate(25);

        return view('admin.schools.index', compact('schools'));
    }


    public function create()
    {
         $relations = [
            'levels' => \App\Level::get()->pluck('name', 'id'),
        ];
        return view('admin.schools.create',$relations);
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        School::create($requestData);

        Session::flash('flash_message', 'School added!');

        return redirect('admin/schools');
    }


    public function show($id)
    {
        $school = School::findOrFail($id);

        return view('admin.schools.show', compact('school'));
    }


    public function edit($id)
    {
        $school = School::findOrFail($id);

        $relations = [
            'levels' => \App\Level::get()->pluck('name', 'id'),
        ];

        return view('admin.schools.edit', compact('school') + $relations);
    }

    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $school = School::findOrFail($id);
        $school->update($requestData);

        Session::flash('flash_message', 'School updated!');

        return redirect('admin/schools');
    }

    public function destroy($id)
    {
        School::destroy($id);

        Session::flash('flash_message', 'School deleted!');

        return redirect('admin/schools');
    }
}
