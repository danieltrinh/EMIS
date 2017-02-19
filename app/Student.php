<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
    protected $table = 'students';

    
    protected $primaryKey = 'id';

    
    protected $fillable = ['name', 'student_id', 'school_id','classroom_id'];

    

    public function classroom()
	{
		return $this->belongsTo('App\Classroom');
	}

    public function school()
    {
        return $this->belongsTo('App\School');
    }
	
    public function subjects()
    {
        return $this->belongsToMany('App\Subject')->withPivot('grade_id','subject_id','s1_quizzes','s1_midterm','s1_final','s1_total','s2_quizzes','s2_midterm','s2_final','s2_total' ,'year_final','year');
    }
}
