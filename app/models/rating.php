<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    public function student()
    {
        return $this->belongsTo('App\models\student');
    }

    public function teacher()
    {
        return $this->belongsTo('App\models\teacher');
    }

    public function subject()
    {
        return $this->belongsTo('App\models\subject');
    }
}
