<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Alaa Mo Shaat',
            'email' => 'alaamshaat445@gmail.com'
        ]);
        Listing::factory(5)->create([
            'user_id' => $user->id
        ]);
    }
}
