<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{

    protected $table = 'grades';


    protected $primaryKey = 'id';


    protected $fillable = ['name', 'level_id'];

    public function level()
	{
		return $this->belongsTo('App\Level');
	}
	
    public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }
}
