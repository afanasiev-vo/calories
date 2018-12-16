<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const ACTIVE = 'ACTIVE';
    const DELETED = 'DELETED';

    public function ingredients()
    {
        return $this->belongsToMany('App\Ingredient', 'product_ingredients')->withPivot('weight');
    }

    public function owner() {
        return $this->belongsTo('App\User');
    }


}
