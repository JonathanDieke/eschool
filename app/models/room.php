<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    protected $fillable = ['code', 'libel', 'capacity'];

    public function getRouteKeyName(){ return  'code' ;}

    public function classroom()
    {
        return $this->hasOne('App\models\classroom');
    }
}
