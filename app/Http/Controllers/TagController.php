<?php
namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Services\TagService;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    protected TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(): JsonResponse
    {
        $tags = $this->tagService->getAll();
        return ApiResponse::success($tags, 'Teglar muvaffaqiyatli olindi');
    }

    public function store(TagRequest $request): JsonResponse
    {
        $tag = $this->tagService->create($request->validated());
        return ApiResponse::success($tag, 'Teg muvaffaqiyatli yaratildi', 201);
    }

    public function show($id): JsonResponse
    {
        $tag = $this->tagService->getById($id);
        return $tag
            ? ApiResponse::success($tag, 'Teg topildi')
            : ApiResponse::error('Teg topilmadi', 404);
    }

    public function update(TagRequest $request, $id): JsonResponse
    {
        $updated = $this->tagService->update($id, $request->validated());
        return $updated
            ? ApiResponse::success(['updated' => $updated], 'Teg muvaffaqiyatli yangilandi')
            : ApiResponse::error('Teg yangilashda xatolik yuz berdi', 400);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->tagService->delete($id);
        return $deleted
            ? ApiResponse::success(['deleted' => $deleted], 'Teg muvaffaqiyatli o‘chirildi')
            : ApiResponse::error('Teg o‘chirishda xatolik yuz berdi', 400);
    }
}
