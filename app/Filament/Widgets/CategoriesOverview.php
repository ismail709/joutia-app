<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class CategoriesOverview extends BaseWidget
{
    protected ?string $heading = 'Categories Analytics';

    protected ?string $description = 'An overview of categories stats.';
    protected function getStats(): array
    {
        $categories = Category::all();
        $avgAdsPerCategory = Category::whereNotNull('parent_id')->withCount('ads')->get();
        return [
            Stat::make('Categories',$categories->count())
            ->description('Total number of categories'),
            Stat::make('Avg Ads',Number::format($avgAdsPerCategory->avg('ads_count'),1))
            ->description('Average ads per category'),
            Stat::make('Max Ads',Number::format($avgAdsPerCategory->max('ads_count'),0))
            ->description('Max ads per category')
            ->color('danger'),
        ];
    }
}
