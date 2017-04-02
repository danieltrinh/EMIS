<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	 $faker = Faker::create();

    	     	 // Seed CLASSROOM data of a school (id)
	  	 	// foreach (range(1,5) as $grade) {
		  	 // 	foreach (range('A','J') as $index) {
			   //      DB::table('classrooms')->insert([
			   //          'name' => $grade."-".$index,
			   //          'school_id' => "2",
			   //          'grade_id' => $grade,
			   //      ]);
		    //   }
		    // }

    	//seed STUDENTS of class of grades in classrooms with school id
    	 // $year=2008;

    	 // foreach (range(1,5) as $grade) {
    	 // 	foreach (range ('A','J') as $class){
    	 // 		$class_name =  $grade."-".$class;
    	 // 		$class_ids = DB::table('classrooms')->select('id')->where('name',$class_name)->first();


    	 // 		foreach($class_ids as $id => $class_id){

    	 // 			foreach (range(1,rand(10,20)) as $student_id) {
    	 // 				$gender = rand(0,1);
    	 // 				if($gender==0) $firstname= $faker->firstNameMale; 
    	 // 				else $firstname=$faker->firstNameFemale;

    	 // 				DB::table('students')->insert([
    	 // 					'name' => $firstname." ".$faker->lastName,
    	 // 					'student_id' => "KD-17-".$class_name."-".$student_id,
    	 // 					'school_id' => "2",
    	 // 					'classroom_id' => $class_id, 
    	 // 					'bd'		=>$faker->dayOfMonth()."/".$faker->month."/".$year,
    	 // 					'female'	=> $gender,
    	 // 					'address'	=> $faker->streetAddress,
    	 // 					'state'		=> $faker->state,
    	 // 					'behavior'	=> rand(0,10),
    	 // 					'economic_disadvantaged'	=> rand(0,1),
    	 // 					'hometown'  => $faker->address,
    	 // 					'phone_number' => $faker->phoneNumber,
    	 // 					]);
    	 // 			}

    	 // 		}

    	 // 	}
    	 // 	$year++;
    	 // }

    	//Seed PARENTS
  //   	$student_ids = DB::table('students')->select('id')->where('school_id','2')->pluck('id');
  //   	foreach($student_ids as $key => $student_id){
  //   		DB::table('guardians')->insert([
  //   			'name' => $faker->name,
  //   			'student_id' => $student_id,
  //   			'role' => 1, 
  //   			'bd'		=> $faker->dayOfMonth()."/".$faker->month."/".rand(1960,1990),
  //   			'home_state'		=> $faker->state,
  //   			'job'		=> $faker->jobTitle,
  //   			'phone_number' => $faker->phoneNumber,
  //   			]);

  //   		DB::table('guardians')->insert([
  //   			'name' => $faker->name,
  //   			'student_id' => $student_id,
  //   			'role' => rand(2,3), 
  //   			'bd'		=> $faker->dayOfMonth()."/".$faker->month."/".rand(1960,1990),
  //   			'home_state'		=> $faker->state,
  //   			'job'		=> $faker->jobTitle,
  //   			'phone_number' => $faker->phoneNumber,
  //   			]);
		// };

    }
}
