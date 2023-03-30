<?php

use App\ProblemaAereo;
use Illuminate\Database\Seeder;

class ProblmeaAereoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(ProblemaAereo::class, 50)->create();

    }
}
