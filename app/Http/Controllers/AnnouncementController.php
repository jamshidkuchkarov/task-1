<?php
namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Http\Resources\AnnouncementCollection;
use App\Http\Resources\AnnouncementResource;
use App\Services\AnnouncementService;
use App\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class AnnouncementController extends Controller
{
    protected AnnouncementService $service;

    public function __construct(AnnouncementService $service)
    {
        $this->service = $service;
    }

    public function index(): JsonResponse
    {
        $announcements = $this->service->getAll();
        return ApiResponse::success(new AnnouncementCollection($announcements), 'E’lonlar muvaffaqiyatli olindi');
    }

    public function show($id): JsonResponse
    {
        $announcement = $this->service->findById($id);
        return $announcement
            ? ApiResponse::success(new AnnouncementResource($announcement), 'E’lon muvaffaqiyatli olindi')
            : ApiResponse::error('E’lon topilmadi', 404);
    }

    public function store(AnnouncementRequest $request): JsonResponse
    {
        $announcement = $this->service->create($request->validated());
        return ApiResponse::success(new AnnouncementResource($announcement), 'E’lon muvaffaqiyatli yaratildi', 201);
    }

    public function update(AnnouncementRequest $request, $id): JsonResponse
    {
        return $this->service->update($id, $request->validated())
            ? ApiResponse::success([], 'E’lon muvaffaqiyatli yangilandi')
            : ApiResponse::error('E’lon topilmadi', 404);
    }

    public function destroy($id): JsonResponse
    {
        return $this->service->delete($id)
            ? ApiResponse::success([], 'E’lon muvaffaqiyatli o‘chirildi')
            : ApiResponse::error('E’lon topilmadi', 404);
    }
}
