<?php

namespace App\Providers;

use App\Repositories\Contracts\PositionRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\PositionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        UserRepositoryContract::class => UserRepository::class,
        PositionRepositoryContract::class => PositionRepository::class,
    ];
}
