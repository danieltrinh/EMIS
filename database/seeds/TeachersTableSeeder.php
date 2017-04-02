<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;


class TeachersTableSeeder extends Seeder
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

    	     
    	//Seed Teachers
	 	// foreach (range(1,60) as $teacher_id) {
	 	// 	$gender = rand(0,1);
	 	// 	if($gender==0) $firstname= $faker->firstNameMale; 
	 	// 	else $firstname=$faker->firstNameFemale;

	 	// 	DB::table('teachers')->insert([
	 	// 		'name' => $firstname." ".$faker->lastName,
	 	// 		'teacher_id' => "TE-KD-PR-".$teacher_id,
	 	// 		'school_id' => "2",
	 	// 		'level_id' => "1", 
	 	// 		'bd'		=> $faker->dayOfMonth()."/".$faker->month."/".rand(1960,1990),
	 	// 		'female'	=> rand(0,1),
	 	// 		'address'	=> $faker->streetAddress,
	 	// 		'state'		=> $faker->state,
	 	// 		'hometown'  => $faker->address,
	 	// 		'phone_number' => $faker->phoneNumber,
	 	// 		'email'	=> $faker->email,
	 	// 		'certificate' => rand(1,3)

	 	// 		]);
	 	// }


    	// Primary class-teacher
  //   	foreach (range(124,133) as $teacher_id) {
  // 		 $class_ids = DB::table('classrooms')->select('id')->where([
  // 			['school_id','2'],
  // 			])->pluck('id');

  // 		foreach($class_ids as $id => $class_id){
  // 			// echo $teacher_id." ".$id." ".$class_id."\n";
	 //        DB::table('classroom_teacher')->insert([
	 //            'classroom_id' => $class_id, 
	 //            'teacher_id'	=> $teacher_id ,
	 //            'homeroom'	=> 0,
	 //        ]);
	 //    }
	 // }

    
    	//Subject Teacher Elementary
    	 // $subjects = DB::select("SELECT DISTINCT S.name, S.id
    	 // 	FROM grade_subject GS
    	 // 	INNER JOIN grades G
    	 // 	ON GS.grade_id = G.id
    	 // 	INNER JOIN subjects S
    	 // 	ON GS.subject_id = S.id
    	 // 	WHERE G.level_id = 1 AND S.id!=9 AND S.id!=18");

    	 // foreach (range(74,123) as $teacher_id) {
    	 // 	// $teacher_ids = DB::table('teachers')->select('id')->where([['school_id','2'],])->pluck('id');

	    	//  	foreach($subjects as $subject){
	  			// // echo $teacher_id." ".$subject->id."\n";
		    //     DB::table('subject_teacher')->insert([
		    //         'subject_id' => $subject->id, 
		    //         'teacher_id'	=> $teacher_id ,
		    //     ]);
    	 // 	}
    	 // }

    	 
    }
}
