<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'first_name' => 'I Wayan Andika',
            'last_name' => 'Pranayoga',
            'name' => 'I Wayan Andika Pranayoga',
            'dealer_code' => 'group',
            'email' => 'praandikayoga@gmail.com',
            'username' => 'andika',
            'email_verified_at' => Carbon::now('GMT+8'),
            'password' => bcrypt('andika*#'),
            'access' => 'master',
            'created_at' => Carbon::now('GMT+8'),
        ]);
    }
}
