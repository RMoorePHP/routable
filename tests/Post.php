<?php

namespace Tests\RMoore\Routable;

use RMoore\Routable\Routable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use Routable;

    protected $fillable = ['title', 'content'];
}
