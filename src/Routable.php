<?php

namespace RMoore\Routable;

use Illuminate\Container\Container;

trait Routable
{
    public function routeBase() : string
    {
        return $this->getTable();
    }

    public function routes() : Router
    {
        return Container::getInstance()->make(Router::class, ['model' => $this]);
    }
}
