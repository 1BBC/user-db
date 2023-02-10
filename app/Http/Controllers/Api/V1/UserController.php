<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Contracts\StoreUserActionContract;
use App\Exceptions\ApiDefaultException;
use App\Filters\UserFilter;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\User\FilterUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\V1\UserPaginatedCollection;
use App\Http\Resources\V1\UserResource;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends ApiController
{
    public function __construct(private UserRepositoryContract $repository){}

    /**
     * Display a listing of the resource.
     *
     * @param FilterUserRequest $request
     * @return JsonResource
     */
    public function index(FilterUserRequest $request): JsonResource
    {
        $queryParams = array_filter($request->validated());
        $filter = app(UserFilter::class, compact('queryParams'));

        $users = $this->repository->paginatedList($filter);

        return $this->success(new UserPaginatedCollection($users));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @param StoreUserActionContract $action
     * @return JsonResource
     */
    public function store(StoreUserRequest $request, StoreUserActionContract $action): JsonResource
    {
        $data = $request->validated();

        $user = $action($data);

        return $this->success([
            'user_id' => $user->id,
            'message' => __('New user successfully registered')
        ]);
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

        return $this->success(['user' => new UserResource($user)]);
    }
}
