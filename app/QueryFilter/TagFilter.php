<?php

namespace App\QueryFilter;

class TagFilter extends QueryFilter
{
    public function name($value)
    {
        $this->builder->where('name', 'like', '%' .$value. '%');
    }

}
