<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
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
    'email' => 'admin@admin.com',
    'password' => bcrypt('123456'),
    'role'=>'teacher'
]);
Role::create(['name' => 'student']);
Role::create(['name' => 'teacher']);
    }
}
