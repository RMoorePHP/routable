<?php

namespace Tests;

use Illuminate\Database\Capsule\Manager as DB;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp() : void
    {
        $this->setUpDatabase();
        $this->migrateTables();
    }

    private function setUpDatabase()
    {
        $database = new DB();
        $database->addConnection(['driver' => 'sqlite', 'database' => ':memory:']);
        $database->bootEloquent();
        $database->setAsGlobal();
    }

    private function migrateTables()
    {
        DB::schema()->create('posts', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });
    }
}
