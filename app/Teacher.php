<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teachers';

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
    protected $fillable = ['name', 'school_id', 'level_id'];

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
