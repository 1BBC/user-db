<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Utilities\TimeLimitToken\TimeLimitToken;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenController extends ApiController
{
    public function __invoke(TimeLimitToken $token): JsonResource
    {
        return $this->success(['token' => $token->get()]);
    }
}
