<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $sadmin =  User::factory()->create([
            'id' => 1,
            'name' => 'Analytical Journey',
            'email' => 'admin@analytical.com',
            'password' => Hash::make('aj$21'),
            'observe' => Carbon::now()->addMonths(12),
            'type' => User::ROLE_ADMINISTRATOR,
        ]);

        $admin =  User::factory()->create([
            'id' => 2,
            'name' => 'Analytical Journey',
            'email' => 'cms@analytical.com',
            'observe' => Carbon::now()->addMonths(1),
            'type' => User::ROLE_ADMINISTRATOR,
        ]);

        $creator = User::factory()->create([
            'id' => 3,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'type' => User::ROLE_ADMINISTRATOR,
            'observe' => Carbon::now()->addYear(1),
        ]);

        $member = User::factory()->create([
            'id' => 4,
            'email' => 'member@cms.com',
            'type' => User::ROLE_MEMBER,
            'observe' => Carbon::now()->addMonths(2),
        ]);

        $member = User::factory()->create([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'type' => User::ROLE_MEMBER,
            'observe' => Carbon::now()->addMonths(2),
        ]);
    }
}
