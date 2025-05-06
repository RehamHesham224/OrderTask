<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;

trait WithPagination
{
    public static function paginate($resource, $wrapper = 'data'): ResourceCollection
    {
        if (! ($resource instanceof AbstractPaginator)) {
            return self::collection($resource);
        }

        return new class ($resource, self::class, $wrapper) extends ResourceCollection {
            public string $wrapper;

            public function __construct($resource, string $collects, $wrapper = 'data')
            {
                $this->collects = $collects;
                parent::__construct($resource);
                $this->wrapper = $wrapper;
            }

            public function toArray($request): array
            {
                return [
                    $this->wrapper => $this->collection,
                    'paginate' => [
                        'count' => $this->count(),
                        'total' => $this->total(),
                        'per_page' => $this->perPage(),
                        'current_page' => $this->currentPage(),
                        'has_pages' => $this->hasPages(),
                        'last_item' => $this->lastItem(),
                        'from' => $this->firstItem(),
                        'path' => $this->path(),
                        'to' => $this->lastItem(),
                    ],
                ];
            }
        };
    }

}
