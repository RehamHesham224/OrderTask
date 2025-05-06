<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Pipeline;

trait filterable
{
    public function scopeFilter(Builder $query, array $filters)
    {
        return app(Pipeline::class)
            ->send($query)
            ->through($filters)
            ->thenReturn();
    }

}
