<?php

namespace Tests;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Routing\UrlGenerator;

class RoutableTest extends TestCase
{
    const BASE_URL = 'http://www.foo.com';

    /** @test */
    public function it_can_generate_show_route()
    {
        $router = $this->getRouter();

        $router->resource('posts', 'PostController');

        $post = Post::create(['title' => 'test', 'content' => 'test']);

        $route = $post->routes()->show();

        $this->assertEquals(sprintf('%s/posts/%s', static::BASE_URL, $post->getRouteKey()), $route);
    }

    protected function getRouter()
    {
        $container = Container::setInstance(new Container);
        $router = new Router(new Dispatcher, $container);
        $container->singleton(Registrar::class, function () use ($router) {
            return $router;
        });

        $container->singleton(\Illuminate\Contracts\Routing\UrlGenerator::class, function () use ($router) {
            return new UrlGenerator(
                $router->getRoutes(),
                Request::create(static::BASE_URL)
            );
        });

        return $router;
    }
}
