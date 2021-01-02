<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable = ['register', 'classroom_id', 'fullname', 'birthday', 'birthplace', 'avatar'];

    public function getRouteKeyName(){ return 'register';}

    public function classroom()
    {
        return $this->belongsTo('App\models\classroom');
    }

    public function ratings()
    {
        return $this->hasMany('App\models\rating');
    }

    public function getRate($subject, $teacher){
        return $this->ratings()->where("subject_code", $subject)->where("teacher_id", $teacher)->first() ;
    }
}
