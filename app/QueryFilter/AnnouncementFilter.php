<?php

namespace App\QueryFilter;

class AnnouncementFilter extends QueryFilter
{
    public function title($value)
    {
        $this->builder->where('title', 'like', '%' . $value . '%');
    }
    public function description($value)
    {
        $this->builder->where('description', 'like', '%' . $value . '%');
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

    public function attributes($values)
    {
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                $this->builder->whereHas('attributes', function ($query) use ($key, $value) {
                    $query->where('key', $key)->where('value', $value);
                });
            }
        }
    }

    public function tags($values)
    {
        if (is_array($values)) {
            $this->builder->whereHas('tags', function ($query) use ($values) {
                $query->whereIn('tags.id', $values);
            });
        }
    }
}
