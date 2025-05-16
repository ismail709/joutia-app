<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ads = Ad::all();

        foreach ($ads as $ad) {
            $ad->images()->create(Image::factory()->make()->toArray());
            $ad->images()->create(Image::factory()->make()->toArray());
            $ad->images()->create(Image::factory()->make()->toArray());
        }
    }
}
