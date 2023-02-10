<?php

namespace App\Repositories;

use App\Exceptions\ApiDefaultException;
use App\Filters\AbstractFilter;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository implements UserRepositoryContract
{
    /**
     * @inheritdoc
     */
    public function paginatedList(?AbstractFilter $filter = null): LengthAwarePaginator
    {
        $postQuery = User::query()->with('position')->idDescending();

        if (isset($filter)) {
            $postQuery->filter($filter);
        }

        $users = $postQuery->paginate(
            perPage: $filter->getQueryParam('count', config('app.user.per_page')),
            page: $filter->getQueryParam('offset') ? 1 : $filter->getQueryParam('page')
        );

        if ($users->count() === 0 || $users->currentPage() > $users->lastPage()) {
            throw new NotFoundHttpException();
        }

        return $users;
    }


    /**
     * @inheritdoc
     */
    public function find(int $id): User
    {
        try {
            /* @var User $user */
            $user = User::query()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ApiDefaultException(
                __('The user with the requested identifier does not exist'),
                404,
                ['user_id' => __('User not found')]
            );
        }

        return $user;
    }
}
