<?php

use Illuminate\Database\Seeder;

class RoomerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Rumi\Models\RoomerProfile::class, 10)->create()->each(function($u){
            $u->save();
        });
    }
}
