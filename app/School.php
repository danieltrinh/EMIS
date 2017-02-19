<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schools';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
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
