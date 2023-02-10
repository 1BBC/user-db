<?php

namespace App\Repositories\Contracts;

use App\Exceptions\ApiDefaultException;
use App\Filters\AbstractFilter;
use App\Models\Position;

interface PositionRepositoryContract
{
    /**
     * @param AbstractFilter|null $filter
     * @return
     */
    public function list(?AbstractFilter $filter = null);

    /**
     * @param int $id user id
     * @return Position
     * @throws ApiDefaultException
     */
    public function find(int $id): Position;
}
