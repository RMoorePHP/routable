<?php

namespace Tests;

use RMoore\Filterable\Filters;
use Illuminate\Database\Eloquent\Builder;

class PostFilters extends Filters {

    public function publicTest(Builder $query, $value) : Builder {
        return $query->where('title', 'like', "%$value%");
    }

    protected function protectedTest(Builder $query, $value) : Builder {
        return $query->where('title', 'like', "%$value%");
    }

    private function privateTest(Builder $query, $value) : Builder {
        return $query->where('title', 'like', "%$value%");
    }
}
