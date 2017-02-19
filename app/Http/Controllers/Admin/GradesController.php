<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Grade;
use Illuminate\Http\Request;
use Session;

class GradesController extends Controller
{

    public function index()
    {
        $grades = Grade::paginate(25);

        return view('admin.grades.index', compact('grades'));
    }


    public function create()
    {
        return view('admin.grades.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Grade::create($requestData);

        Session::flash('flash_message', 'Grade added!');

        return redirect('admin/grades');
    }


    public function show($id)
    {
        $grade = Grade::findOrFail($id);

        return view('admin.grades.show', compact('grade'));
    }


    public function edit($id)
    {
        $grade = Grade::findOrFail($id);

        return view('admin.grades.edit', compact('grade'));
    }


    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $grade = Grade::findOrFail($id);
        $grade->update($requestData);

        Session::flash('flash_message', 'Grade updated!');

        return redirect('admin/grades');
    }


    public function destroy($id)
    {
        Grade::destroy($id);

        Session::flash('flash_message', 'Grade deleted!');

        return redirect('admin/grades');
    }
}
