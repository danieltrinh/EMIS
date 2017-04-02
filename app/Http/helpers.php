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

 ?>