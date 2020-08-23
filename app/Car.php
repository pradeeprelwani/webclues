<?php

namespace App;


use App\Colour;
use App\CarPicture;
use Illuminate\Database\Eloquent\Model;

class Car extends Model {

    protected $fillable = ['name', 'fuel_type','status', 'color_id','icon', 'detail', 'date', 'month', 'year'];

    public function picture(){
        return $this->hasMany(CarPicture::class,'car_id','id');
    }
     public function colour(){
        return $this->hasOne(Colour::class,'id','color_id');
    }
    
    public function getIconUrlAttribute(){
        return url('image/'.$this->icon);
        
    }
}
