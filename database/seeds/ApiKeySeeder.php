<?php

use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Rumi\ApiKeys::class, 1)->create()->each(function($u){
            $u->save();
        });
    }
}
