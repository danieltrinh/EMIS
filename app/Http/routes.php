<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'web'], function (){
	Route::Auth();

	Route::group(['prefix' => 'admin'], function() {

		Route::resource('subjects', 'Admin\\SubjectsController');
	});

});
		// Route::resource('subjects', 'Admin\\SubjectsController');

Route::resource('admin/posts', 'Admin\\PostsController');
Route::resource('admin/levels', 'Admin\\LevelsController');
Route::resource('admin/grades', 'Admin\\GradesController');
Route::resource('admin/schools', 'Admin\\SchoolsController');

Route::resource('admin/classrooms', 'Admin\\ClassroomsController');
Route::resource('admin/teachers',  'Admin\\TeachersController');
Route::resource('admin/students', 'Admin\\StudentsController');
Route::resource('admin/guardians', 'Admin\\GuardiansController');

// Route::post('/ajaxClass','AjaxController@index');
Route::get('/ajax-classroom/{sid}/{gid}/{yid}', 'AjaxController@ajaxcall');
Route::get('/ajax-subject/{id}', 'AjaxController@ajaxsubjectcall');
Route::get('/ajax-school/{id}', 'AjaxController@ajaxschoolcall');
Route::get('/ajax-grade/{id}', 'AjaxController@ajaxgradecall');
Route::get('/ajax-school_year/{id}', 'AjaxController@ajaxschoolyearcall');

Route::get('/ajax-student/{id}', 'AjaxController@ajaxstudentcall');
Route::get('/ajax-principle-dashboard/{uid}/{gid}/{yid}', 'AjaxController@ajaxprincipledashboard');

Route::get('/ajax-principle-dashboard-gender/{sid}/{gid}/{yid}', 'AjaxController@ajaxprinciplegender');

Route::get('/ajax-member/{sid}/{name}/{role}', 'AjaxController@ajaxaddmember');

Route::get('/ajax-unassign/{sid}', 'AjaxController@ajaxdeletemember');
Route::get('/ajax-reset_pass/{sid}', 'AjaxController@ajaxresetpassword');





// Route::get('/ajax-classroom',function(){
// 	$cid = Input::get('cid');

//   	$classrooms= \App\Classroom::where('school_id','=',$cid)->get(); 

//   	return Response::json($classrooms);

// });

Route::resource('admin/principals', 'Admin\\PrincipalsController');

// Route::get('role',[
// 	'middleware' => 'Role:editor',
// 	'uses'	=> 'RoleController@index'
// 	]);

// Route::get('admin', function(){
// 	echo "You have access";
// })->middleware('role');