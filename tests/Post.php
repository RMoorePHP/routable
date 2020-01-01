<?php

namespace Tests\RMoore\Routable;

use Illuminate\Database\Eloquent\Model;
use RMoore\Routable\Routable;

class Post extends Model
{
    use Routable;

    protected $fillable = ['title', 'content'];
}
