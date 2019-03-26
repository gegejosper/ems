<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    public function members()
    {
        return $this->hasMany('App\Member', 'region', 'regioname');
    }
}
