<?php

namespace Database\Seeders;

use App\Enum\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'hossein.654321@yahoo.com',
            'password' => Hash::make('123456')
        ]);
        $user->assignRole(Role::findByName(Roles::ADMIN, 'api'));
    }
}
