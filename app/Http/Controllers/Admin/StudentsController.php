<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if ($user && $user->hasRole('principle')) 
        {
            $current_school =  getPrincipleSchool($user->id); 
            $current_school = \App\School::findOrFail($current_school[0]->id);
            $students = Student::where('school_id', $current_school->id)->paginate(25);
            $relations = [
            'students' => $students,
            ];
            return view('admin.students.index', $relations);
        }
        elseif ($user && $user->hasRole('teacher')) 
        {
            $teacher_id = explode("@", $user->email);
            $teacher_id = $teacher_id[0]; 
            $current_classroom = getTeacherClassroom($teacher_id);
            $current_classroom_id = $current_classroom[0]->id;
            $current_classroom = \App\Classroom::findOrFail($current_classroom_id);
            $relations = [
            'students' => $current_classroom->students,
            ];
            return view('admin.students.index', $relations);
        }
        else
        {
            $students = Student::paginate(25);
            return view('admin.students.index', compact('students'));
        }
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
        
        $new_student = Student::create($requestData);


        Session::flash('flash_message', 'Student added!');

        return redirect('admin/students/'.$new_student->id);
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

        return redirect('admin/students/'.$student->id);
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
