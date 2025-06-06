<?php

/**
 * @copyright  Copyright (c) 2025 Code Chip (https://codechip.com.br)
 * @author     Will <willvix@outlook.com>
 * @Link       https://github.com/code-chip
 */

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Company::factory(10)->create();
    }
}
