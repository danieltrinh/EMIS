<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Teacher;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;


class TeachersController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user && $user->hasRole('principle')) 
        {
            $current_school =  getPrincipleSchool($user->id); 
            $current_school = \App\School::findOrFail($current_school[0]->id);
            $teachers = Teacher::where('school_id', $current_school->id)->paginate(25);
            $relations = [
            'teachers' => $teachers,
            ];
            return view('admin.teachers.index', $relations);
        }
        elseif ($user && $user->hasRole('teacher')) 
        {

        }
        else
        {
            $teachers = Teacher::paginate(25);
            return view('admin.teachers.index', compact('teachers'));
        }
    }


    public function create()
    {
        $relations = [
            'levels' => \App\Level::get()->pluck('name', 'id'),
            'schools' => \App\School::get()->pluck('name', 'id'),
            'classrooms' => \App\Classroom::get()->pluck('name', 'id'),
            'subjects' => \App\Subject::get()->pluck('name', 'id'),

        ];
        return view('admin.teachers.create', $relations);
    }


    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        $teacher = Teacher::create($requestData);

        $teacher->classrooms()->sync(array_filter((array)$request->input('classrooms')));
        $teacher->subjects()->sync(array_filter((array)$request->input('subjects')));


        Session::flash('flash_message', 'Teacher added!');

        return redirect('admin/teachers');
    }


    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);

        return view('admin.teachers.show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $relations = [
            'levels' => \App\Level::get()->pluck('name', 'id')->prepend(''),
            'schools' => \App\School::get()->pluck('name', 'id'),
            'classrooms' => \App\Classroom::get()->pluck('name', 'id'),
            'subjects' => \App\Subject::get()->pluck('name', 'id'),

        ];
        return view('admin.teachers.edit', compact('teacher') + $relations);
    }

    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $teacher = Teacher::findOrFail($id);
        $teacher->update($requestData);
        $teacher->classrooms()->sync(array_filter((array)$request->input('classrooms')));
        $teacher->subjects()->sync(array_filter((array)$request->input('subjects')));
        

        Session::flash('flash_message', 'Teacher updated!');

        return redirect('admin/teachers');
    }


    public function destroy($id)
    {
        Teacher::destroy($id);

        Session::flash('flash_message', 'Teacher deleted!');

        return redirect('admin/teachers');
    }
}
