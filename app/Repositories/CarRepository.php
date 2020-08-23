<?php

namespace App\Repositories;

use App\User;
Use App\Car;
use App\CarPicture;
class CarRepository extends BaseRepository {

    protected $car;
    protected $userFriend;

    public function __construct() {
        $this->car = new Car();
    }

    public function carListing() {
        return $this->car->with('colour')->where('status', '=', 'Active')->get();
    }

    public function createCar($request, $pictures = null) {

        $car = $this->car->create($request);
        if ($pictures) {
            $data = [];
            foreach ($pictures as $picture) {
                $data[] = ['car_id' => $car->id, 'name' => $picture];
            }
            $car->picture()->insert($data);
        }
        return $car;
    }

    public function updateCar($id, $request, $pictures = null) {

        $car = $this->car->where('id', $id);
        $car->update($request);
       
        if ($pictures) {
            $data = [];
            foreach ($pictures as $picture) {
                $data[] = ['car_id' => $car->first()->id, 'name' => $picture];
            }
          
           $car->first()->picture()->insert($data);
        }
        return $car;
    }

}
