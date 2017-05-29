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

function getYearResult($grade,$student_id){
	$sql = "SELECT s.name , ss.year_final, ss.year 
	FROM student_subject as ss
	JOIN subjects as s
	WHERE ss.grade_id= ".intval($grade)."
	AND ss.student_id = ".intval($student_id)."
	AND ss.subject_id = s.id
	";
	$result = \DB::select($sql);
	return $result;
}

function getYearsAverage($student_id){
	$sql = "SELECT ROUND(Avg(ss.year_final),1) as all_subject, ss.year 
	FROM student_subject as ss
	JOIN subjects as s
	WHERE ss.student_id = ".intval($student_id)."
	AND ss.subject_id = s.id
	GROUP BY year
	";
	$result = \DB::select($sql);
	return $result;
}

function getEconomicDisadvantage($school_id){
	$sql = "SELECT economic_disadvantaged, count(economic_disadvantaged) ,
	FROM students 
	WHERE school_id = $school_id
	GROUP BY economic_disadvantaged";
	$result = \DB::select($sql);
	return $result;
}

function getGenderPercent($school_id){
	$sql = "SELECT female as gender, count(female)  as gender_quantity , grade_id
	FROM students as s JOIN classrooms as c

	WHERE s.school_id = $school_id
	AND s.classroom_id = c.id
	GROUP BY grade_id, female";
	$result = \DB::select($sql);
	return $result;
}
?>