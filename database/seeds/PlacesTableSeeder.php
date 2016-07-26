<?php

use Illuminate\Database\Seeder;
use App\Place;
class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Place::create([
    		'name' => 'place A',
    		'lat' => 21.023943953402217,
    		'lon' => 105.84157705307007,
    		'description' => 'Mo ta diem A',
    		'votes' => 0,
    		'status' => 1,
    		'user_id' => 1
    	]);
    	Place::create([
    		'name' => 'place B',
    		'lat' => 21.02610345468585,
    		'lon' => 105.84286061188322,
    		'description' => 'Mo ta diem B',
    		'votes' => 0,
    		'status' => 1,
    		'user_id' => 1
    	]);
    }
}
