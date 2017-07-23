<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{

    protected $table = 'schools';


    protected $primaryKey = 'id';

    protected $fillable = ['name', 'level_id'];

     public function setLevelIdAttribute($input)
    {
        $this->attributes['level_id'] = $input ? $input : null;
    }
    

    public function level()
	{
		return $this->belongsTo('App\Level');
	}
	public function classrooms() {
        return $this->hasMany('App\Classroom');
    }
    public function teachers() {
        return $this->hasMany('App\Teacher');
    }

    public function students()
    {
        return $this->hasManyThrough('App\Student', 'App\Classroom' , 'school_id','classroom_id');
    }
}
