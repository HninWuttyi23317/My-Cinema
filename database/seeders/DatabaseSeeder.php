<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '09693941515',
            'address' => 'Yangon',
            'gender' => 'female',
            'role' => 'admin',
            'password' => Hash::make('admin123')
        ]);
        User::create([
            'name' => 'Wuttyi',
            'email' => 'wuttyi@gmail.com',
            'phone' => '09793941515',
            'address' => 'Zigon',
            'gender' => 'female',
            'role' => 'admin',
            'password' => Hash::make('wuttyi123')
        ]);
        User::create([
            'name' => 'Sithu',
            'email' => 'sithu@gmail.com',
            'phone' => '09693944343',
            'address' => 'Yangon',
            'gender' => 'male',
            'role' => 'admin',
            'password' => Hash::make('sithu123')
        ]);
        User::create([
            'name' => 'Hanna',
            'email' => 'hanna@gmail.com',
            'phone' => '09798341515',
            'address' => 'Yangon',
            'gender' => 'female',
            'role' => 'user',
            'password' => Hash::make('hanna123')
        ]);
        User::create([
            'name' => 'Paing',
            'email' => 'paing@gmail.com',
            'phone' => '09798341515',
            'address' => 'Yangon',
            'gender' => 'male',
            'role' => 'user',
            'password' => Hash::make('paing123')
        ]);
    }
}
