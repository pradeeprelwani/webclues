<?php

namespace App;

use App\Colour;
use Illuminate\Database\Eloquent\Model;

class CarPicture extends Model {

    protected $fillable = ['name', 'car_id'];

    public function colour() {
        return $this->hasOne(Colour::class, 'id', 'color_id');
    }

}
