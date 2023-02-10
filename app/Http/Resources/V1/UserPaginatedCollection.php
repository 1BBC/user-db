<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\V1\Traits\Paginatable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserPaginatedCollection extends ResourceCollection
{
    use Paginatable;

    public static $wrap = null;
    public $collects = UserResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            $this->merge($this->paginateMeta()),
            'users' => $this->collection
        ];
    }
}
