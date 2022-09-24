<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
//        $this->call(TaskSeeder::class);
        $this->call(AdminSeeder::class);
        User::factory(10000)->create();
        Admin::factory(100)->create();
    }
}
