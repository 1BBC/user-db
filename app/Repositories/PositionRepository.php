<?php

namespace App\Repositories;

use App\Exceptions\ApiDefaultException;
use App\Filters\FilterContract;
use App\Models\Position;
use App\Repositories\Contracts\PositionRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PositionRepository implements PositionRepositoryContract
{
    /**
     * @inheritdoc
     */
    public function list(?FilterContract $filter = null): Collection
    {
        $postQuery = Position::query()->idDescending();

        if (isset($filter)) {
            $postQuery->filter($filter);
        }

        return $postQuery->get();
    }


    /**
     * @inheritdoc
     */
    public function find(int $id): Position
    {
        try {
            /* @var Position $position */
            $position = Position::query()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ApiDefaultException(
                __('The position with the requested identifier does not exist'),
                404,
                ['position_id' => __('Position not found')]
            );
        }

        return $position;
    }
}
