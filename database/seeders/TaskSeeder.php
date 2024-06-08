<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tasks')->insert([
            'title' => "Tarea 1",
            'description' => "Tarea pendiente.",
            'status_id' => 1,
            'user_id' => 1,
            'archived' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'title' => "Tarea 2",
            'description' => "Tarea terminada.",
            'status_id' => 2,
            'user_id' => 1,
            'archived' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'title' => "Tarea 3",
            'description' => "Tarea pendiente archivada.",
            'status_id' => 1,
            'user_id' => 1,
            'archived' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'title' => "Tarea 4",
            'description' => "Tarea terminada archivada.",
            'status_id' => 2,
            'user_id' => 1,
            'archived' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
