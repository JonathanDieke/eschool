<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $fillable = ['category_id', 'subject_id', 'register', 'fullname','email', 'birthday', 'birthplace','avatar'];

    public function getRouteKeyName()
    {
        return 'register' ;
    }

    public function subject()
    {
        return $this->belongsTo('App\models\subject', 'subject_id', 'id');
        /*
            first id=> foreign_key : colonne du model qui est censée correspondre à la clé primaire du modele passé en param (category)

            second id => local key : clé primaire du modele passé en param avec laquelle on teste la correspondance avec la clé etrangere du $this->model
        */
    }

    public function ratings()
    {
        return $this->hasMany('App\models\rating');
    }
}
