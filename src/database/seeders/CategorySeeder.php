<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => '仕事',     'created_at' => now(), 'updated_at' => now()],
            ['name' => '勉強',     'created_at' => now(), 'updated_at' => now()],
            ['name' => '買い物',   'created_at' => now(), 'updated_at' => now()],
            ['name' => '趣味',     'created_at' => now(), 'updated_at' => now()],
            ['name' => 'その他',   'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
