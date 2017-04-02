<?php 

function random_grades(){
	$number=0;
	if (rand(0, 10) <= 7) { 
		$number = rand(5, 10);
	} else {
		$number = rand(0, 4);
	}	
	return $number;
}
function getCurrentGradeResult($grade,$student_id){
	$result = \DB::select("SELECT * FROM student_subject
		WHERE grade_id= $grade
		AND student_id = $student_id
		");
	return $result;
}
function getSubjectName($subject_id){
	$result = \DB::table('subjects')->where('id', $subject_id)->value('name'); 
	return $result;
}
?>