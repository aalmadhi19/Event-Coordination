<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'Admin@nizer.com',
            'password' => '12345678',
        ]);
        Role::create(['name' => 'Admin']);
        User::first()->assignRole('Admin');
    }
}
