<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Classroom;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class ClassroomsController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user && $user->hasRole('principle')) 
        {
            $current_school =  getPrincipleSchool($user->id); 
            $current_school = \App\School::findOrFail($current_school[0]->id);
            $classrooms = Classroom::where('school_id', $current_school->id)->paginate(25);
            $relations = [
            'classrooms' => $classrooms,
            ];
            return view('admin.classrooms.index', $relations);
        }
        else
        {
            $classrooms = Classroom::paginate(25);
            return view('admin.classrooms.index', compact('classrooms'));
        }

    }


    public function create()
    {
        $relations = [
            'schools' => \App\School::get()->pluck('name', 'id'),
            'classrooms' => \App\Classroom::get()->pluck('name', 'id'),
            'subjects' => \App\Subject::get()->pluck('name', 'id'),
        ];
        return view('admin.classrooms.create', $relations);
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Classroom::create($requestData);

        Session::flash('flash_message', 'Classroom added!');

        return redirect('admin/classrooms');
    }


    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);

        return view('admin.classrooms.show', compact('classroom'));
    }

    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
         $relations = [
            'levels' => \App\Level::get()->pluck('name', 'id')->prepend(''),
            'schools' => \App\School::get()->pluck('name', 'id'),
            'classrooms' => \App\Classroom::get()->pluck('name', 'id'),
            'subjects' => \App\Subject::get()->pluck('name', 'id'),

        ];
        return view('admin.classrooms.edit', compact('classroom')+$relations);
    }

    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $classroom = Classroom::findOrFail($id);
        $classroom->update($requestData);

        Session::flash('flash_message', 'Classroom updated!');

        return redirect('admin/classrooms');
    }

    public function destroy($id)
    {
        Classroom::destroy($id);

        Session::flash('flash_message', 'Classroom deleted!');

        return redirect('admin/classrooms');
    }
}
