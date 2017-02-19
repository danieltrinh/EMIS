<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Classroom;

use App\Http\Requests;

 use Illuminate\Foundation\Bus\DispatchesJobs;
 use Illuminate\Routing\Controller;	

class AjaxController extends Controller
{
    //
       public function ajaxcall($id){
	// $cid = Input::get('cid');

  	$classrooms= \App\Classroom::where('school_id','=',$id)->get(); 

  	return \Response::json($classrooms);

     }

     public function ajaxsubjectcall($id){
	// $cid = Input::get('cid');

  	// $grades= \App\Subject::where('level_id','=',$id)->get(); 

  	$subjects=$cards = \DB::select("SELECT DISTINCT S.*
									FROM grade_subject GS
									INNER JOIN grades G
										ON GS.grade_id = G.id
									INNER JOIN subjects S
										ON GS.subject_id = S.id
									WHERE G.level_id = ".$id);

  	return \Response::json($subjects);

     }
}
