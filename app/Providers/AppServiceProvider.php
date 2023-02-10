<?php

namespace App\Providers;

use App\Services\ImageOptimize\ImageOptimizeContract;
use App\Services\ImageOptimize\FakeImageOptimizeService;
use App\Services\ImageOptimize\TinyPngImageOptimizeService;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ImageOptimizeContract::class => FakeImageOptimizeService::class, //FakeImageOptimizeService::class
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
