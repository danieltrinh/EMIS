<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Guardian;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;


class GuardiansController extends Controller
{

    public function index()
    {

        $user = Auth::user();
        if ($user && $user->hasRole('principle')) 
        {
            $guardians = Guardian::paginate(25);
            return view('admin.guardians.index', compact('guardians'));
        }
        elseif ($user && $user->hasRole('teacher')) 
        {
            $current_classroom = getTeacherClassroom($user->id);
            $current_classroom_id = $current_classroom[0]->id;
            $current_classroom = \App\Classroom::findOrFail($current_classroom_id);
            $guardians = Guardian::get();
            foreach ($guardians as $key => $guardian ) {
                $ss = \App\Student::findOrFail($guardian->student_id);
                if ($ss->classroom_id != $current_classroom_id)
                {
                    unset($guardians[$key]);
                }
            }
            $relations = [
            'guardians' => $guardians,
            ];
            return view('admin.guardians.index', $relations);
        }
        else
        {
           $guardians = Guardian::paginate(25);
            return view('admin.guardians.index', compact('guardians'));
        }
        
    }

    public function create()
    {
        return view('admin.guardians.create');
    }


    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Guardian::create($requestData);

        Session::flash('flash_message', 'Guardian added!');

        return redirect('admin/guardians');
    }

    public function show($id)
    {
        $guardian = Guardian::findOrFail($id);

        return view('admin.guardians.show', compact('guardian'));
    }

    public function edit($id)
    {
        $guardian = Guardian::findOrFail($id);

        return view('admin.guardians.edit', compact('guardian'));
    }

    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $guardian = Guardian::findOrFail($id);
        $guardian->update($requestData);

        Session::flash('flash_message', 'Guardian updated!');

        return redirect('admin/guardians');
    }

    public function destroy($id)
    {
        Guardian::destroy($id);

        Session::flash('flash_message', 'Guardian deleted!');

        return redirect('admin/guardians');
    }
}
