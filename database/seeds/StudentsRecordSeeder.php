<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class StudentsRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Kim dong Studeent record
        $faker = Faker::create();

        $student_ids = DB::table('students')->select('id')->where('school_id','2')->pluck('id');

        // foreach ($student_ids as $key => $student_id) {
        	$student_current_classroom =DB::table('students')->where('id','22190')->value('classroom_id'); 
        	$student_grade=DB::table('classrooms')->where('id',$student_current_classroom)->value('grade_id');
        	// echo $student_id;
        	echo "\t";
        	// echo $student_current_classroom;
        	// echo "\t";
        	// echo $student_grade;,
        	// echo "\t";
        	for($i=1;$i<=$student_grade;$i++)
        	{
        		$subjects = \DB::select("SELECT S.id, S.name, G.id
									FROM grade_subject GS
									INNER JOIN grades G
										ON GS.grade_id = G.id and G.id = $i
									INNER JOIN subjects S
										ON GS.subject_id = S.id");
        		print_r($subjects);

        	// 	echo $s1_quizzes = random_grades();
        	// 	echo " ";

        	// 	echo $s1_midterm = random_grades();
        	// 	echo " ";

        	// 	echo $s1_final = random_grades();
        	// 	echo " ";

        	// 	echo $s1_total = 0.2*$s1_quizzes + 0.3*$s1_midterm + 0.5* $s1_final;
        	// 	echo " ";

        	// 	echo $s2_quizzes = random_grades();
        	// 	echo " ";

        	// 	echo $s2_midterm = random_grades();
        	// 	echo " ";

        	// 	echo $s2_final = random_grades();
        	// 	echo " ";

        	// 	echo $s2_total = 0.2*$s2_quizzes + 0.3*$s2_midterm + 0.5* $s2_final;

        	// 	echo " ";

        	// 	echo $year = round(($s1_total+$s2_total)/2,1);

        	// echo "\n";

        	}
        	echo "\n";


        	// DB:table('student_subject')->insert([

        	// 	])
        // }

    }
}
