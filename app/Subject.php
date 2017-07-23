<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    protected $table = 'subjects';


    protected $primaryKey = 'id';


    protected $fillable = ['name', 'abbreviation'];

        public function grades()
    {
        return $this->belongsToMany('App\Grade');
    }

}
