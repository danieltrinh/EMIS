<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{

    protected $table = 'guardians';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'radio'];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
