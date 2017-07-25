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

function getYearYearResult($year,$student_id){
	$sql = "SELECT s.name , ss.year_final, ss.year 
	FROM student_subject as ss
	JOIN subjects as s
	WHERE ss.year= ".intval($year)."
	AND ss.student_id = ".intval($student_id)."
	AND ss.subject_id = s.id
	";
	$result = \DB::select($sql);
	return $result;
}

function getYearsAverage($student_id,$grade_id = null){
	$sql = "SELECT ROUND(Avg(ss.year_final),1) as all_subject, ss.year 
	FROM student_subject as ss
	JOIN subjects as s
	WHERE ss.student_id = ".intval($student_id)."
	AND ss.subject_id = s.id
	GROUP BY year
	ORDER BY year DESC
	LIMIT ".(int)$grade_id;
	$result = \DB::select($sql);
	return array_reverse ($result);
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
function getPrincipleSchool($principle_id)
{
	$sql = "SELECT s.*
	FROM schools AS s
	JOIN principals	AS p
	ON s.`id` = p.`school_id`
	WHERE  p.`user_id`= ".intval($principle_id);
	$result = \DB::select($sql);
	return $result;
}
/**
* @param  id
* @return string
*/
function getTeacherClassroom($teacher_id)
{
	$sql = "SELECT classrooms.* 
	FROM classrooms 
	WHERE classrooms.`homeroom_teacher` = '".$teacher_id."' ORDER BY year DESC";
	$result = \DB::select($sql);
	if(empty($result) || !isset($result))
	{
		$result = getTidFromTeacherid($teacher_id);
	}
	return $result;
}

function getTidFromTeacherid($teacher_id)
{
	$sql = "SELECT id 
	FROM teachers 
	WHERE teacher_id = '".$teacher_id."'";
	$result = \DB::select($sql);
	$teacher = \App\Teacher::findOrFail($result[0]->id);
	return $teacher->classrooms;
}




/**
* @param  id
* @return string
*/
function getClassroomBehavior($class_id)
{
	$sql = "SELECT AVG(s.behavior) AS average_behavior
	FROM `students` AS s
	WHERE s.`classroom_id` = ".intval($class_id);
	$result = \DB::select($sql);
	return $result[0]->average_behavior;
}

/**
 * [getClassroomPerfomance description]
 * @param  id $class_id [description]
 * @return string           [description]
 */
function getClassroomPerfomance($students)
{
	$classPerfomance = array();
	foreach ($students as $student ) {
		$sql = "SELECT AVG(year_final) AS average_per_year
		FROM student_subject
		WHERE grade_id= 4
		AND YEAR = 2017
		AND student_id = ".$student->id;
		$result = \DB::select($sql);
		array_push($classPerfomance,  $result[0]->average_per_year);
	}
	if(count($classPerfomance)==0)
	{
		return false;
	}
	$avg = array_sum($classPerfomance)/count($classPerfomance);
	return $avg;
}


/**
 * [getClassroomPerfomance description]
 * @param  id $class_id [description]
 * @return string           [description]
 */
function getStudentPerfomance($classroom, $order)
{
	$data 			= array();
	$behavior 		= array();
	$name 			= array();
	$performance 	= array();
	$data_aca		= array();
	$i = 0;
	foreach ($classroom->students->sortBy('behavior',true,true) as $student) {
		$sql = "SELECT  AVG(year_final) AS average_per_year, students.*
		FROM student_subject
		JOIN students 
		ON students.`id` = student_subject.`student_id`  
		WHERE student_subject.`student_id`  = ".$student->id."
		AND student_subject.`year` = 2017";
		$result = \DB::select($sql);

		array_push($name,$result[0]->name);
		array_push($performance,round($result[0]->average_per_year,2));
		array_push($behavior,round($result[0]->behavior,2));

		//sort by performance
		$data_aca[$i]['name'] = $result[0]->name;
		$data_aca[$i]['performance'] = round($result[0]->average_per_year,2);
		$data_aca[$i]['behavior'] = round($result[0]->behavior,2);

		$i++;
	}

	if ($order==2)
	{
		$data['labels']=$name;

		$data['datasets'][0]['data']=$behavior;
		$data['datasets'][0]['backgroundColor']='red';
		$data['datasets'][0]['label']='Behavior';

		$data['datasets'][1]['data']=$performance;
		$data['datasets'][1]['backgroundColor']='blue';
		$data['datasets'][1]['label']='Academic Perfomance';
	}
	else
	{
		$behavior_aca 		= array();
		$name_aca 			= array();
		$performance_aca 	= array();
		foreach ($data_aca as $key => $row) {
			$performance[$key]  = $row['performance'];
		}
		array_multisort($performance, SORT_DESC, $data_aca);

		foreach ($data_aca as $key => $value) {
			array_push($name_aca,$value['name']);
			array_push($performance_aca,$value['performance']);
			array_push($behavior_aca,$value['behavior']);
		}
		$data['labels']=$name_aca;

		$data['datasets'][0]['data']=$behavior_aca;
		$data['datasets'][0]['backgroundColor']='red';
		$data['datasets'][0]['label']='Behavior';

		$data['datasets'][1]['data']=$performance_aca;
		$data['datasets'][1]['backgroundColor']='blue';
		$data['datasets'][1]['label']='Academic Perfomance';
	}

	return $data;
}

/**
 * [getClassroomPerfomance description]
 * @param  id $class_id [description]
 * @return string           [description]
 */
function getTopStudent($classroom)
{
	$data 			= array();
	$behavior 		= array();
	$name 			= array();
	$performance 	= array();
	$data_aca		= array();
	$i = 0;
	foreach ($classroom->students->sortBy('behavior',true,true) as $student) {
		$sql = "SELECT  AVG(year_final) AS average_per_year, students.*
		FROM student_subject
		JOIN students 
		ON students.`id` = student_subject.`student_id`  
		WHERE student_subject.`student_id`  = ".$student->id."
		AND student_subject.`year` = 2017";
		$result = \DB::select($sql);

		//sort by performance
		$data_aca[$i]['name'] = $result[0]->name;
		$data_aca[$i]['performance'] = round($result[0]->average_per_year,2);
		$data_aca[$i]['behavior'] = round($result[0]->behavior,2);

		$i++;
	}
	foreach ($data_aca as $key => $row) {
			$performance[$key]  = $row['performance'];
		}
		array_multisort($performance, SORT_DESC, $data_aca);

	return $data_aca;
}
/**
 * [getClassroomPerfomance description]
 * @param  id $class_id [description]
 * @return string           [description]
 */
function getGradeGender($school_id,$grade_id)
{
	$sql = "
	SELECT  students.female, COUNT(students.id) AS COUNT
	FROM students
	JOIN classrooms
	ON	students.`classroom_id` = classrooms.`id`
	WHERE students.`school_id` = ".intval($school_id)."
	AND classrooms.`grade_id`= ".intval($grade_id)."
	GROUP BY  students.female";
	$result = \DB::select($sql);
	$data = array();
	$labels = array();
	$datasets = array();
	$backgroundColor = array();
	foreach ($result as $gender ) {
		if($gender->female==0)
		{
			array_push($labels, "male");
			array_push($backgroundColor, "#36a2eb");
		}
		else
		{
			array_push($labels, "female");
			array_push($backgroundColor, "rgb(255,205,86)");
		}
		array_push($datasets,$gender->COUNT);
	}
	$data['labels'] = $labels;
	$data['datasets'][0]['data'] = $datasets;
	$data['datasets'][0]['backgroundColor'] = $backgroundColor;
	return $data;
}

function getSchoolYears($school_id)
{
	$sql = "SELECT c.year
			FROM schools as s 
			JOIN classrooms as c
			On s.id= c.school_id
			WHERE c.year != '' 
			AND s.id = ".intval($school_id)."
			GROUP BY c.year
			ORDER BY c.year DESC";
	$result = \DB::select($sql);
	$data = array();
	foreach ($result as $key => $year ) {
		$data[$key]['id']= $year->year;
		$data[$key]['name']= (intval($year->year) -1)." - ".(intval($year->year));
	}
	return $data;
}

 function countCurrentClasses($school_id,$year_id)
 {
 	$sql="SELECT count(*) as count
			FROM	classrooms
			WHERE school_id = ".intval($school_id)."
			AND year = ".intval($year_id);
	$result = \DB::select($sql);
	return $result[0]->count;
 }

 function getUserIdFromSid($sid)
 {
 	$sql="SELECT id
			FROM users 
			WHERE email LIKE '%".$sid."%'";
	$result = \DB::select($sql);
	if(empty($result))
		return false;
	return $result[0]->id;
 }

  function getSid($student_id)
 {
 	$sql="SELECT id
			FROM students 
			WHERE student_id LIKE '%".$student_id."%'";
	$result = \DB::select($sql);
	if(empty($result))
		return false;
	return $result[0]->id;
 }

 function getParentId($sid,$role_id)
 {
 	$sql="SELECT id	
			FROM guardians
			WHERE student_id = ".intval($sid)." AND role = ".intval($role_id);
	$result = \DB::select($sql);	
	if(empty($result))
		return false;
	return $result[0]->id;	
 }

?>

