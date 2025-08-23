<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Status::truncate();
        Schema::enableForeignKeyConstraints();

        $columns = ['id', 'name'];
        $items = [
            [1, 'Submitted'],
            [2, 'Assigned'],
            [3, 'Sent Back'],
            [4, 'Rejected'],
        ];

        foreach ($items as $item) {
            Status::create(array_combine($columns, $item));
        }
    }
}
