<?php
namespace App\Repositories;

use App\Models\Category;
use App\QueryFilter\CategoryFilter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryRepository
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function getAll():Collection
    {
        return (new CategoryFilter($this->request))->apply(Category::query())->get();
    }

    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

        public function update(Category $category, array $data): bool
    {
        return $category->update($data);
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}
