<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tasks')->insert([
                [
                    'title' => 'First Task',
                    'completed' => true,
                ],
                [
                    'title' => 'Second Task',
                    'completed' => false,
                ],
            ]);
    }
}
