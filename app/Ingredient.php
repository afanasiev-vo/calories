<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    const ACTIVE = 'ACTIVE';
    const HOLD = 'HOLD';
    const PER_PAGE = 15;

    protected $fillable = ['id'];

    public function owner() {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_ingredients');
    }
}
