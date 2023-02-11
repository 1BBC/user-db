<?php

namespace App\Providers;

use App\Services\ImageOptimize\ImageOptimizeContract;
use App\Services\ImageOptimize\FakeImageOptimizeService;
use App\Services\ImageOptimize\TinyPngImageOptimizeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ImageOptimizeContract::class => TinyPngImageOptimizeService::class, //FakeImageOptimizeService::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
//        JsonResource::withoutWrapping();
    }
}
