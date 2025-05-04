<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use function Filament\Support\format_number;

class UsersOverview extends BaseWidget
{
    protected ?string $heading = 'Users Analytics';

    protected ?string $description = 'An overview of users stats.';
    protected function getStats(): array
    {
        $users = User::all();
        $avgAdsPerUser = User::withCount('ads')->get();
        return [
            Stat::make('Users',$users->count())
            ->description('Total number of users'),
            Stat::make('Avg Ads',Number::format($avgAdsPerUser->avg('ads_count'),1))
            ->description('Average ads per user'),
            Stat::make('Max Ads',Number::format($avgAdsPerUser->max('ads_count'),0))
            ->description('Max ads per user')
            ->color('danger'),
        ];
    }
}
