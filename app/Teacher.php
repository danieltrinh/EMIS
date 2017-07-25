<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $table = 'teachers';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'school_id', 'level_id','bd','female','address','state','email','hometown','phone_number'];

    public function school()
	{
		return $this->belongsTo('App\School');
	}
	public function level()
    {
        return $this->belongsTo('App\Level');
    }
    public function classrooms()
    {
        return $this->belongsToMany('App\Classroom')->orderBy('name');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject')->orderBy('name');
    }
}
