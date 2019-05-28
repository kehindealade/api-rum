<?php

use Illuminate\Database\Seeder;

class RoomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Rumi\Models\Roomer::class, 10)->create()->each(function($u){
        	$u->save();
        });
    }
}
