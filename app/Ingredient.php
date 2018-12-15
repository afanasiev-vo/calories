<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function calories()
    {
        return $this->belongsTo('App\Calories');
    }

    public function owner() {
        return $this->belongsTo('App\User');
    }
}
