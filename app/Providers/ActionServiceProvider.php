<?php

namespace App\Providers;

use App\Actions\Contracts\StoreUserActionContract;
use App\Actions\User\StoreUserAction;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public array $bindings = [
        StoreUserActionContract::class => StoreUserAction::class,
    ];
}
