<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::user()->get();
        $categories = Category::whereNotNull('parent_id')->get();

        foreach ($users as $user) {
            $nbr_ads = rand(1, 5);
            for ($i = 0; $i < $nbr_ads; $i++) {
                $ad = Ad::factory()->make([
                    'category_id' => $categories->random()->id
                ]);
                
                $user->ads()->create($ad->toArray());
            }
        }
    }
}
