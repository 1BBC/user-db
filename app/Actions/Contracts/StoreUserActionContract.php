<?php

namespace App\Actions\Contracts;

use App\Models\User;

interface StoreUserActionContract
{
    public function __invoke(array $data): User;
}
