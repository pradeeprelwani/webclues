<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colour extends Model {

    protected $table='colors';
    protected $fillable = ['name', 'status'];
 
     
}
