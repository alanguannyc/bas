<?php

use Illuminate\Database\Seeder;

class FinalScoreSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Final_score::class, 30)->create();
    }
}
