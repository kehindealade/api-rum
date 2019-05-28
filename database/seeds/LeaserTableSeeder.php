<?php

use Illuminate\Database\Seeder;

class LeaserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Rumi\Models\Leaser::class, 10)->create()->each(function ($u) {
            $u->save();
        });
    }
}
