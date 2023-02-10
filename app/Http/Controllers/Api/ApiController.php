<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SuccessResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiController extends Controller
{
    /**
     * Create a new JSON response instance.
     *
     * @param JsonResource|array $data
     * @return JsonResource
     */
    protected function success(mixed $data = []): JsonResource
    {
        return new SuccessResource($data);
    }
}
