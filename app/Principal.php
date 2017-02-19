<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'principals';

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
    protected $fillable = ['name', 'principal_id', 'school_id'];

    public function school()
	{
		return $this->belongsTo('App\School');
	}
	
}
