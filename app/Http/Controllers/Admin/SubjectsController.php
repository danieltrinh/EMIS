<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subject;
use Illuminate\Http\Request;
use Session;

use Zizaco\Entrust\Traits\EntrustUserTrait;


class SubjectsController extends Controller
{
    use EntrustUserTrait;
    public function __construct()
    {
          $this->middleware('role:admin|teacher|principle',['only' => ['show', 'index']]);
          // $this->middleware('permission:manage-subjects');
    }

    public function index()
    {
        $subjects = Subject::paginate(25);

        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Subject::create($requestData);

        Session::flash('flash_message', 'Subject added!');

        return redirect('admin/subjects');
    }


    public function show($id)
    {
        $subject = Subject::findOrFail($id);

        return view('admin.subjects.show', compact('subject'));
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);

        return view('admin.subjects.edit', compact('subject'));
    }


    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $subject = Subject::findOrFail($id);
        $subject->update($requestData);

        Session::flash('flash_message', 'Subject updated!');

        return redirect('admin/subjects');
    }

    public function destroy($id)
    {
        Subject::destroy($id);

        Session::flash('flash_message', 'Subject deleted!');

        return redirect('admin/subjects');
    }
}
