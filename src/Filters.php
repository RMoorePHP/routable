<?php

namespace RMoore\Filterable;

use Illuminate\Database\Eloquent\Builder;

class Filters {

    protected function canApply(string $method, $value) : bool {
        if(!method_exists($this, $method)) // if method doesnt exist then skip
            return false;

        $reflection = new \ReflectionMethod($this, $method);
        if(!$reflection->isPublic()) // if method exists but is not public then skip
            return false;

        return true;
    }

    function apply(Builder $query, array $filters) : Builder{
        foreach ($filters as $key => $value) {
            if($this->canApply($key, $value)){
                $query = $this->$key($query, $value) ?? $query;
            }
        }

        return $query;
    }

}
