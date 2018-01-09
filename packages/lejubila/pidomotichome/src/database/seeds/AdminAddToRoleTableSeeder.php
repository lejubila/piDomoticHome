<?php

namespace Lejubila\PiDomoticHome\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminAddToRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'name' => 'admin',
        ]);
    }
}
