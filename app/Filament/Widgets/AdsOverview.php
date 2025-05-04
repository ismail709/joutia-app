<?php

namespace App\Filament\Widgets;

use App\Enums\AdStatusEnum;
use App\Models\Ad;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdsOverview extends BaseWidget
{
    protected ?string $heading = 'Ads Analytics';

    protected ?string $description = 'An overview of ads stats.';
    protected function getStats(): array
    {
        $onlineAds = Ad::where('status', AdStatusEnum::APPROVED->value)->get()->count();
        $pendingAds = Ad::where('status', AdStatusEnum::PENDING->value)->get()->count();
        $allAds = Ad::all()->count();
        return [
            Stat::make('All Ads', $allAds)
                ->description('Total number of ads'),
            Stat::make('Online Ads', $onlineAds)
                ->description('Total number of online ads')
                ->color('success'),
            Stat::make('Pending Ads', $pendingAds)
                ->description('Total number of pending ads')
                ->color('warning')
        ];
    }
}
