<?php


namespace App\QueryFilter;

class AnnouncementFilter extends QueryFilter
{
    public function title($value)
    {
        $this->builder->where('title', 'like', '%' . $value . '%');
    }

    public function category_id($value)
    {
        $this->builder->where('category_id', $value);
    }

    public function region_id($value)
    {
        $this->builder->where('region_id', $value);
    }

    public function price_min($value)
    {
        $this->builder->where('price', '>=', $value);
    }

    public function price_max($value)
    {
        $this->builder->where('price', '<=', $value);
    }
}
