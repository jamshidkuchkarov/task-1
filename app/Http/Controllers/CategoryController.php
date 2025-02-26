<?php
namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(): JsonResponse
    {
        $categories = $this->categoryService->getAll();
        return ApiResponse::success($categories, 'Kategoriyalar muvaffaqiyatli olindi');
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->create($request->validated());
        return ApiResponse::success($category, 'Kategoriya muvaffaqiyatli yaratildi', 201);
    }

    public function show($id): JsonResponse
    {
        $category = $this->categoryService->getById($id);
        return $category
            ? ApiResponse::success($category, 'Kategoriya topildi')
            : ApiResponse::error('Kategoriya topilmadi', 404);
    }

    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $updated = $this->categoryService->update($id, $request->validated());
        return $updated
            ? ApiResponse::success(['updated' => $updated], 'Kategoriya muvaffaqiyatli yangilandi')
            : ApiResponse::error('Kategoriya yangilashda xatolik yuz berdi', 400);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->categoryService->delete($id);
        return $deleted
            ? ApiResponse::success(['deleted' => $deleted], 'Kategoriya muvaffaqiyatli o‘chirildi')
            : ApiResponse::error('Kategoriya o‘chirishda xatolik yuz berdi', 400);
    }
}
