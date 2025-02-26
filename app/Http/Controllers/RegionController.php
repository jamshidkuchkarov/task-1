<?php
namespace App\Http\Controllers;

use App\Http\Requests\RegionRequest;
use App\Services\RegionService;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class RegionController extends Controller
{
    protected RegionService $regionService;

    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;
    }

    public function index(): JsonResponse
    {
        $regions = $this->regionService->getAll();
        return ApiResponse::success($regions, 'Hududlar muvaffaqiyatli olindi');
    }

    public function store(RegionRequest $request): JsonResponse
    {
        $region = $this->regionService->create($request->validated());
        return ApiResponse::success($region, 'Hudud muvaffaqiyatli yaratildi', 201);
    }

    public function show($id): JsonResponse
    {
        $region = $this->regionService->getById($id);
        return $region
            ? ApiResponse::success($region, 'Hudud topildi')
            : ApiResponse::error('Hudud topilmadi', 404);
    }

    public function update(RegionRequest $request, $id): JsonResponse
    {
        $updated = $this->regionService->update($id, $request->validated());
        return $updated
            ? ApiResponse::success(['updated' => $updated], 'Hudud muvaffaqiyatli yangilandi')
            : ApiResponse::error('Hudud yangilashda xatolik yuz berdi', 400);
    }

    public function destroy($id): JsonResponse
    {
        $deleted = $this->regionService->delete($id);
        return $deleted
            ? ApiResponse::success(['deleted' => $deleted], 'Hudud muvaffaqiyatli o‘chirildi')
            : ApiResponse::error('Hudud o‘chirishda xatolik yuz berdi', 400);
    }
}
