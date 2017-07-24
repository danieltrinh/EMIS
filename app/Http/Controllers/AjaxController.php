<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Classroom;

use App\Http\Requests;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;	

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class AjaxController extends Controller
{
    //
 public function ajaxcall($sid,$gid=null,$yid=null){
	// $cid = Input::get('cid');
  if(!$yid) $yid=date("Y");
  if($gid!=0){
    $classrooms= \App\Classroom::where('school_id','=',$sid)->where('grade_id','=',$gid)->where('year','=',$yid)->get(); 
    return \Response::json($classrooms);
  }
  else
  {
    $classrooms= \App\Classroom::where('school_id','=',$sid)->where('year','=',$yid)->get(); 
    return \Response::json($classrooms);
  }


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

 public function ajaxschoolcall($id){

  $schools= \App\School::where('level_id','=',$id)->get(); 

  return \Response::json($schools);

}

public function ajaxstudentcall($id){

  $students= \App\Student::where('classroom_id','=',$id)->get(); 

  return \Response::json($students);

}

public function ajaxgradecall($id){

  $grades= \App\Grade::where('level_id','=',$id)->get(); 

  return \Response::json($grades);

}

public function ajaxschoolyearcall($id){

  $result= getSchoolYears($id); 

  return \Response::json($result);

}

public function ajaxprincipledashboard($uid,$gid,$yid){
  $current_school =  getPrincipleSchool($uid); 
  $current_school = \App\School::findOrFail($current_school[0]->id);
  $allClassInfo = array();

  foreach ($current_school->classrooms as $classroom) {
    if($classroom->year==$yid)
    {
      $class_id = $classroom['attributes']['id'];
      $class_grade = $classroom['attributes']['grade_id'];
      $average = getClassroomBehavior($class_id);
      $perfomance_avg = getClassroomPerfomance($classroom->students); 
      $allClassInfo [$class_grade] [$class_id]  ['behavior'] = round($average,2);  
      $allClassInfo [$class_grade] [$class_id]  ['name'] = $classroom['attributes']['name'];  
      $allClassInfo [$class_grade] [$class_id]  ['perfomance'] = round($perfomance_avg,2);
    }
  }

  $grade = $allClassInfo[$gid];
  $datasets = array();reset($datasets);
  $label = array();reset($label);
  $datasets_perfomance = array();reset($datasets_perfomance);
  foreach ($grade as $classroom_id => $classroom) {
    array_push($label, $classroom['name']);
    array_push($datasets, $classroom['behavior']);
    array_push($datasets_perfomance, $classroom['perfomance']);
  }
  $level = \App\Level::findOrFail($current_school->level['attributes']['id']);
  $grades = $level->grades;
  $data['labels']=$label;
  $data['datasets'][0]['data']=$datasets;
  $data['datasets'][0]['backgroundColor']='rgba(255,177,193,0.8)';
  // $data['datasets'][0]['borderColor']='window.chartColors.red';
  // $data['datasets'][0]['borderWidth']=1;


  $data['datasets'][0]['label']='Behavior';

  $data['datasets'][1]['data']=$datasets_perfomance;
  $data['datasets'][1]['backgroundColor']='rgba(154,208,245,0.8)';
  //   $data['datasets'][0]['borderColor']='window.chartColors.blue';
  // $data['datasets'][0]['borderWidth']=1;
  $data['datasets'][1]['label']='Academic Perfomance';

  return \Response::json($data);

}

public function ajaxprinciplegender($sid,$gid){
    $data = getGradeGender($sid,$gid);

    return \Response::json($data);

  }

public function ajaxaddmember($sid, $name,$role){
  $name = urldecode($name);
  $sid = urldecode($sid);
  // $role = Role::where('name','=','admin')->first();
  $user = new \App\User();
  $user->name = $name;
  $user->email = $sid."@emis.com";
  $user->password = bcrypt("aaaaaaa");
  $user->save();

  $role = \App\Role::where('name', '=', $role)->firstOrFail();

  $user->roles()->attach($role->id);
  $user->ps="aaaaaaa";
   return \Response::json($user);
  }

}
