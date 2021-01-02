<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['code', 'libel'];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function subject()
    {
        return $this->hasMany('App\models\subject');
    }
}
