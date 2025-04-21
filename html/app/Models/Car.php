<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['brand', 'model', 'plate', 'category_id', 
    'price_per_day', 'image', 'transmission', 'fuel_type', 'doors_number',
    'min_age', 'free_cancelation', 'bag_space'];
    // protected $guarded = [];
    

    /* Relaciones BBDD */
    public function categories() {
        $this->belongsToMany(Category::class('category_id'));
    }
}
