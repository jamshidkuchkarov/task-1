<?php
namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function getById(int $id)
    {
        $category = $this->categoryRepository->findById($id);

        if (!$category) {
            throw ValidationException::withMessages(['category' => 'Kategoriya topilmadi!']);
        }

        return $category;
    }

    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        $category = $this->getById($id);
        return $this->categoryRepository->update($category, $data);
    }

    public function delete(int $id)
    {
        $category = $this->getById($id);
        return $this->categoryRepository->delete($category);
    }
}
