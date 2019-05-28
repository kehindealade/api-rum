<?php

use Illuminate\Database\Seeder;

class HostelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(Rumi\Models\Hostel::class, 10)->create()->each(function($u){
           $u->save();
       });
    }
}
