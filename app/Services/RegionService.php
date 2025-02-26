<?php
namespace App\Services;

use App\Repositories\RegionRepository;

class RegionService
{
    protected RegionRepository $regionRepository;

    public function __construct(RegionRepository $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function getAll()
    {
        return $this->regionRepository->getAll();
    }

    public function getById($id)
    {
        return $this->regionRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->regionRepository->create($data);
    }

    public function update($id, array $data): bool
    {
        return $this->regionRepository->update($id, $data);
    }

    public function delete($id): bool
    {
        return $this->regionRepository->delete($id);
    }
}
