<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{

    protected $table = 'guardians';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'role','bd','job','phone_number'];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
