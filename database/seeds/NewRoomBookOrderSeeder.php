<?php

use Illuminate\Database\Seeder;

class NewRoomBookOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Rumi\Models\NewRoomBookOrder::class, 10)->create()->each(function($u){
            $u->save();
        });
    }
}
