<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classrooms';

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
    protected $fillable = ['name', 'school_id', 'grade_id'];

    public function school()
	{
		return $this->belongsTo('App\School');
	}

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }
    
    public function teachers()
    {
        return $this->belongsToMany('App\Teacher');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }

}
