<?php

namespace App\Http\Controllers\Api\V1;


use App\Exceptions\ApiDefaultException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\V1\PositionCollection;
use App\Http\Resources\V1\PositionResource;
use App\Repositories\Contracts\PositionRepositoryContract;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionController extends ApiController
{
    public function __construct(private PositionRepositoryContract $repository){}

    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $positions = $this->repository->list();

        return $this->success(new PositionCollection($positions));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResource
     * @throws ApiDefaultException
     */
    public function show(int $id): JsonResource
    {
        $user = $this->repository->find($id);

        return $this->success(new PositionResource($user));
    }
}
