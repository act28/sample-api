<?php

use Illuminate\Database\Seeder;

class LibraryTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\Library\Library::class, 10)->create();
    }
}