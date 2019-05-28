<?php

use Illuminate\Database\Seeder;

class LeaserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Rumi\Models\LeaserProfile::class, 10)->create()->each(function($u){
       	$u->save();
       });
    }
}
