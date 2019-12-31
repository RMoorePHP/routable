<?php

namespace Tests;

use RMoore\Filterable\Filterable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use Filterable;

    public function filters() {
        return new PostFilters();
    }
}
