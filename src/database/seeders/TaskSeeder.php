<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++) {
            Task::create([
                'title' => 'test',
                'description' => 'test',
                'assigned_by_id' => 1,
                'assigned_to_id' => 1
            ]);
        }

    }
}
