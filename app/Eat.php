<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eat extends Model
{
    const ACTIVE = 'ACTIVE';
    const DELETED = 'DELETED';

    public function products()
    {
        return $this->belongsToMany('App\Product', 'eat_products')->withPivot('weight');
    }
}
