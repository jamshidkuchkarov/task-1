<?php
namespace App\Repositories;

use App\Models\Category;
use App\Models\Region;
use App\QueryFilter\CategoryFilter;
use App\QueryFilter\RegionFilter;
use Illuminate\Http\Request;

class RegionRepository
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function getAll()
    {
        return (new RegionFilter($this->request))->apply(Region::query())->get();
    }

    public function findById($id)
    {
        return Region::find($id);
    }

    public function create(array $data)
    {
        return Region::create($data);
    }

    public function update($id, array $data): bool
    {
        $region = Region::find($id);
        return $region ? $region->update($data) : false;
    }

    public function delete($id): bool
    {
        $region = Region::find($id);
        return $region ? $region->delete() : false;
    }
}
