<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $guarded = [];

    public function getRouteKeyName(){
        return 'code';
    }

    public function teacher()
    {
        return $this->hasMany('App\models\teacher');
    }

    public function category()
    {
        return $this->belongsTo('App\models\category', 'category_id', 'id');
        /*
            first id=> foreign_key : colonne du model qui est censée correspondre à la clé primaire du modele passé en param (category)

            second id => local key : clé primaire du modele passé en param avec laquelle on teste la correspondance avec la clé etrangere du $this->model
        */
    }

     public function ratings()
    {
        return $this->hasMany('App\models\rating', 'subject_code', 'code');
    }
}
