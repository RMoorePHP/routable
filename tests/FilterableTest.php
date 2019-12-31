<?php

namespace Tests;

class FilterableTest extends TestCase {

    /** @test */
    public function it_can_apply_public_scopes(){
        $query = Post::filter(['publicTest' => 'test']);

        $this->assertEquals('select * from "posts" where "title" like ?', $query->toSql());

        $bindings = $query->getBindings();
        $this->assertCount(1, $bindings);

        $this->assertEquals('%test%', $bindings[0]);
    }

    /** @test */
    public function it_doesnt_apply_protected_scopes(){
        $query = Post::filter(['protectedTest' => 'test']);

        $this->assertEquals('select * from "posts"', $query->toSql());

        $bindings = $query->getBindings();
        $this->assertCount(0, $bindings);
    }

    /** @test */
    public function it_doesnt_apply_private_scopes(){
        $query = Post::filter(['privateTest' => 'test']);

        $this->assertEquals('select * from "posts"', $query->toSql());

        $bindings = $query->getBindings();
        $this->assertCount(0, $bindings);
    }

    /** @test */
    public function it_only_applies_public_scopes_when_public_and_private_given(){
        $query = Post::filter(['publicTest' => 'test', 'privateTest' => 'testing']);

        $this->assertEquals('select * from "posts" where "title" like ?', $query->toSql());

        $bindings = $query->getBindings();
        $this->assertCount(1, $bindings);

        $this->assertEquals('%test%', $bindings[0]);
    }

    /** @test */
    public function it_can_be_applied_multiple_times(){
        $query = Post::filter(['publicTest' => 'test'])->filter(['publicTest' => 'testing']);

        $this->assertEquals('select * from "posts" where "title" like ? and "title" like ?', $query->toSql());

        $bindings = $query->getBindings();
        $this->assertCount(2, $bindings);

        $this->assertEquals('%test%', $bindings[0]);
        $this->assertEquals('%testing%', $bindings[1]);
    }

}
