<?php

namespace Lejubila\PiDomoticHome\ExampleModule\src\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->insert([
            'name' => 'example manage buttons'
        ]);
    }
}
