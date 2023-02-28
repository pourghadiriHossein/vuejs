<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\Client;

class OauthClinetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'Web Client',
            'id' => env('AUTH_WEB_CLIENT_ID',1),
            'secret' => env('AUTH_WEB_CLIENT_SECRET'),
            'redirect' => 'localhost:8000',
            'provider' => 'users',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
        ]);
    }
}
