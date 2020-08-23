<?php

use Illuminate\Database\Seeder;
use App\Colour;

class ColourSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $array = [
            '0' => [
                'name' => 'Red',
                'status' => 'Active',
            ],
            '1' => [
                'name' => 'Yellow',
                'status' => 'Active',
            ],
            '2' => [
                'name' => 'Green',
                'status' => 'Active',
            ]
            
        ];
        Colour::insert($array);
    }

}
