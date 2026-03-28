<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    $users = [
        ['name' => 'Admin', 'email' => 'admin@telcovantage.com', 'password' => bcrypt('admin@123!'), 'role' => 'admin'],
        ['name' => 'renzo toledo', 'email' => 'renzo.toledo@telcovantage.com', 'password' => bcrypt('TELCOVANTAGE@2026!'), 'role' => 'pm'],
        ['name' => 'zander boncodin', 'email' => 'zander.boncodin@telcovantage.com', 'password' => bcrypt('TELCOVANTAGE@2026!'), 'role' => 'pm'],
    ];

    foreach ($users as $user) {
        \App\Models\User::firstOrCreate(['email' => $user['email']], $user);
    }
}

}
