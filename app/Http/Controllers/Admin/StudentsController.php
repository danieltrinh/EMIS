<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;
use Illuminate\Http\Request;
use Session;

class StudentsController extends Controller
{

    public function index()
    {
        $students = Student::paginate(25);

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $relations = [
            'schools' => \App\School::get()->pluck('name', 'id'),
            'classrooms' => \App\Classroom::get()->pluck('name', 'id'),
        ];

        return view('admin.students.create', $relations);
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Student::create($requestData);

        Session::flash('flash_message', 'Student added!');

        return redirect('admin/students');
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return view('admin.students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);

        $relations = [
            'schools' => \App\School::get()->pluck('name', 'id'),
            'classrooms' => \App\Classroom::get()->pluck('name', 'id'),
        ];

        return view('admin.students.edit', compact('student') + $relations);
    }

    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $student = Student::findOrFail($id);
        $student->update($requestData);

        Session::flash('flash_message', 'Student updated!');

        return redirect('admin/students');
    }

    public function destroy($id)
    {
        Student::destroy($id);

        Session::flash('flash_message', 'Student deleted!');

        return redirect('admin/students');
    }

    public function getCurrentGradeResult($grade,$student_id){
              $result = \DB::select("SELECT * FROM student_subject
                                        WHERE grade_id= $grade
                                        and student_id = $student_id
        ");
      return $result;
    }

    
}
