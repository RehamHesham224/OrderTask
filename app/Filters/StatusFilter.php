<?php

namespace App\Filters;

use Closure;

class StatusFilter
{
    public function handle($query, Closure $next)
    {
        $query->when(
            request('status'),
            fn($q) => $q->where('status', request('status'))
        );

        return $next($query);
    }
}
