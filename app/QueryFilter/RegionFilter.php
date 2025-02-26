<?php

namespace App\QueryFilter;

class RegionFilter extends QueryFilter
{
    public function name($value)
    {
        $this->builder->where('name', 'like', '%' .$value. '%');
    }

}
