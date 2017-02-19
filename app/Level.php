<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'levels';

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
    protected $fillable = ['name', 'description'];

    public function schools()
    {
        return $this->hasMany('App\School');
    }
    public function teachers()
    {
        return $this->hasMany('App\Teacher');
    }
    public function grades()
    {
        return $this->hasMany('App\Grade');
    }
    
}
