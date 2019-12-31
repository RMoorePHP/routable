<?php

namespace RMoore\Filterable;

use Illuminate\Database\Eloquent\Builder;

trait Filterable {

    public function scopeFilter(Builder $query, array $args = null) : Builder {
        $handler = $this->filters();

        $filters = array_merge($this->defaultFilters(), $args ?? request()->all());

        $query = $handler->apply($query, $filters);

        return $query;
    }

    public function filters(){
        $class = get_class($this); // App\User
        $base = class_basename($class); // User

        $namespace = config('filterable.base_namespace'); // App\Filters

        $filters = sprintf('%s\\%sFilters', $namespace, $base); // App\Filters\UserFilters

        return resolve($filters);
    }

    public function defaultFilters() : array {
        return [];
    }
}
