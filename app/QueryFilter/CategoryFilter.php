<?php

namespace App\QueryFilter;

class CategoryFilter extends QueryFilter
{
    public function name($value)
    {
        $this->builder->where('name', 'like', '%' .$value. '%');
    }

}
