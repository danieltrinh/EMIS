<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{

    protected $table = 'principals';


    protected $primaryKey = 'id';


    protected $fillable = ['name', 'principal_id', 'school_id'];

    public function school()
	{
		return $this->belongsTo('App\School');
	}
	
}
