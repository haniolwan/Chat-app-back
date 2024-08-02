<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('friends')->insert([
            'user_id' => \App\Models\User::all()->random()->id,
            'friend_id' => \App\Models\User::all()->random()->id,
            'accepted' => fake()->boolean(),
        ]);
    }
}
