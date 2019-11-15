<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['name', 'price', 'tax', 'car_model_id', 'full_price', 'front_view', 'back_view'];

    public function car_model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }
}
