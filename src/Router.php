<?php

namespace RMoore\Routable;

use Illuminate\Contracts\Routing\UrlGenerator;

class Router
{
    protected $model;
    protected $router;

    public function __construct($model, UrlGenerator $router)
    {
        $this->model = $model;
        $this->router = $router;
    }

    public function __call(string $method, array $parameters)
    {
        return $this->router->route(
            sprintf('%s.%s', $this->model->routeBase(), $method),
            array_merge([$this->model], $parameters[0] ?? []),
            $parameters[1] ?? true
        );
    }
}
