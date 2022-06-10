<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admininstrator',
            'username' => 'admin',
            'role_id' => 1,
            'email' => 'chandraes@unsri.ac.id',
            'password' => bcrypt('segitiga')
        ]);

        User::create([
            'name' => 'Admin Universitas',
            'username' => 'admin-univ',
            'role_id' => 2,
            'email' => 'admin@unsri.ac.id',
            'password' => bcrypt('admin')
        ]);
    }
}
