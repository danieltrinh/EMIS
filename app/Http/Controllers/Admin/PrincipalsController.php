<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Principal;
use Illuminate\Http\Request;
use Session;

class PrincipalsController extends Controller
{

    public function index()
    {
        $principals = Principal::paginate(25);

        return view('admin.principals.index', compact('principals'));
    }


    public function create()
    {
        return view('admin.principals.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Principal::create($requestData);

        Session::flash('flash_message', 'Principal added!');

        return redirect('admin/principals');
    }

    public function show($id)
    {
        $principal = Principal::findOrFail($id);

        return view('admin.principals.show', compact('principal'));
    }


    public function edit($id)
    {
        $principal = Principal::findOrFail($id);

        return view('admin.principals.edit', compact('principal'));
    }


    public function update($id, Request $request)
    {
        
        $requestData = $request->all();
        
        $principal = Principal::findOrFail($id);
        $principal->update($requestData);

        Session::flash('flash_message', 'Principal updated!');

        return redirect('admin/principals');
    }

    public function destroy($id)
    {
        Principal::destroy($id);

        Session::flash('flash_message', 'Principal deleted!');

        return redirect('admin/principals');
    }
}
