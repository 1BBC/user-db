<?php
namespace App\Http\Resources\V1\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait Paginatable
{
    protected function paginateMeta(): array
    {
        if (isset($this->resource) && $this->resource instanceof LengthAwarePaginator) {
            return [
                'page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
                $this->totalKeyName() => $this->total(),
                'count' => $this->perPage(),
                'links' => [
                    'next_url' => $this->nextPageUrl(),
                    'prev_url' => $this->previousPageUrl(),
                ],
            ];
        }

        return [];
    }

    protected function totalKeyName(): string
    {
        preg_match("/^.*\\\([A-Z][a-z]*)/", get_class($this), $matches);
        if (isset($matches[1])) {
            return 'total_'.str($matches[1])->lower()->plural();
        }

        return 'total';
    }
}
