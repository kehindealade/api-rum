<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        /* $this->call(LeaserTableSeeder::class);
        $this->call(RoomerTableSeeder::class);
        $this->call(LeaserProfileSeeder::class);
        $this->call(RoomerProfileSeeder::class);
        $this->call(HostelSeeder::class);
        $this->call(NewRoomBookOrderSeeder::class); */
        //$this->call(ApiKeySeeder::class);
        $this->call(StudentSeeder::class);
    }
}
