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
        $i = 121;
        for ($i=121; $i <=170 ; $i++) 
        { 
            $student_ids = DB::table('students')->select('id')->where('school_id','2')->where('classroom_id',$i)->pluck('id');

            foreach ($student_ids as $key => $student_id) {
                $student_current_classroom =DB::table('students')->where('id','22038')->value('classroom_id'); 
                $student_grade=DB::table('classrooms')->where('id',$student_current_classroom)->value('grade_id');
                // echo $student_grade;
                // echo "\t";
                    // echo $student_current_classroom;
                    // echo "\t";
                    // echo $student_grade;,
                    // echo "\t";
                for($grade=1;$grade<=$student_grade;$grade++)
                {
                    // echo "Grade".$grade;
                    // echo "\n-----------------------------\n";
                    $subjects= $this->getAllSubjects($grade);
                    $study_year = (date("Y") - ($student_grade-$grade));

                    foreach ($subjects as $key => $value) {
                        // echo $value->subject_name;
                        $scoreArray = $this->scoreArray();
                        // print_r($scoreArray);
                        DB::table('student_subject')->insert([
                            "student_id" => $student_id,
                            "subject_id" => $value->subject_id, 
                            "grade_id" => $grade, 
                            "s1_quizzes" => $scoreArray['s1_quizzes'],
                            "s1_midterm" => $scoreArray['s1_midterm'],
                            "s1_final" => $scoreArray['s1_final'],
                            "s1_total" => $scoreArray['s1_total'],
                            "s2_quizzes" => $scoreArray['s2_quizzes'],
                            "s2_midterm" => $scoreArray['s2_midterm'],
                            "s2_final" => $scoreArray['s2_final'],
                            "s2_total" => $scoreArray['s2_total'],
                            "year_final" => $scoreArray['year_final'],
                            "year" => $study_year,
                            ]);

                    }
                    reset($scoreArray);

                }
                // echo "\n";
            }
        }

    }

    public function scoreArray(){
        $s1_quizzes = $this->random_grades();
        $s1_midterm = $this->random_grades();
        $s1_final = $this->random_grades();
        $s1_total = round(0.2*$s1_quizzes + 0.3*$s1_midterm + 0.5* $s1_final,1);
        $s2_quizzes = $this->random_grades();
        $s2_midterm = $this->random_grades();
        $s2_final = $this->random_grades();
        $s2_total = round(0.2*$s2_quizzes + 0.3*$s2_midterm + 0.5* $s2_final,1);

        $year = round(($s1_total+$s2_total)/2,1);

        $yearScores =array();
        $yearScores = array(
            "s1_quizzes" => $s1_quizzes,
            "s1_midterm" => $s1_midterm,
            "s1_final" => $s1_final,
            "s1_total" => $s1_total,
            "s2_quizzes" => $s2_quizzes,
            "s2_midterm" => $s2_midterm,
            "s2_final" => $s2_final,
            "s2_total" => $s2_total,
            "year_final" => $year,
            );

        return $yearScores;

    }

    public function getAllSubjects($grade){
      $subjects = \DB::select("SELECT S.id as subject_id, S.name as subject_name, G.id as grade_id
        FROM grade_subject GS
        INNER JOIN grades G
        ON GS.grade_id = G.id and G.id = $grade
        INNER JOIN subjects S
        ON GS.subject_id = S.id
        ");
      return $subjects;
  }

//1-10 for elementary 
//1-100 for secondary & highschool
  public function random_grades(){
    $number=0;
    if (rand(0, 10) <= 70) { 
        $number = rand(5, 10);
    } else {
        $number = rand(0, 4);
    }   
    return $number;
}


}
