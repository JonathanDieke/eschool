<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    protected $fillable = ['room_id', 'code', 'libel'];

    public function getRouteKeyName(){ return 'code' ;}
    
    public function student()
    {
        return $this->hasMany('App\models\student');
    }

    public function room()
    {
        return $this->belongsTo('App\models\room');
    }
}
