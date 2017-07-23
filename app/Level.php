<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    protected $table = 'levels';


    protected $primaryKey = 'id';


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
