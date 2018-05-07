<?php

use Illuminate\Database\Seeder;

class ProfilesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Profile::class, 20)->create();
    }
}
