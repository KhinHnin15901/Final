<?php

namespace Database\Seeders;

use App\Models\UserPrefix;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserPrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        UserPrefix::truncate();
        Schema::enableForeignKeyConstraints();

        $prefixes = ['Dr.', 'Prof.', 'Mr.', 'Miss.', 'Mrs.', 'Ms.'];

        foreach ($prefixes as $key => $prefix) {
            UserPrefix::create(['name' => $prefix]);
        }
    }
}
