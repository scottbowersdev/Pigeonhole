<?php

namespace Database\Seeders;

use App\Models\Month;
use App\Models\Outgoing;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Month::factory(10)->create();
        Outgoing::factory(10)->create();
    }
}
