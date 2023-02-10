<?php

namespace App\Repositories\Contracts;

use App\Exceptions\ApiDefaultException;
use App\Filters\AbstractFilter;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryContract
{
    /**
     * @param AbstractFilter|null $filter
     * @return LengthAwarePaginator
     */
    public function paginatedList(?AbstractFilter $filter = null): LengthAwarePaginator;

    /**
     * @param int $id user id
     * @return User
     * @throws ApiDefaultException
     */
    public function find(int $id): User;
}
