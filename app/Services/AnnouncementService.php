<?php
namespace App\Services;

use App\Repositories\AnnouncementRepository;

class AnnouncementService
{
    protected AnnouncementRepository $repository;

    public function __construct(AnnouncementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id): bool
    {
        return $this->repository->delete($id);
    }
}
