<?php
namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{
    protected TagRepository $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAll()
    {
        return $this->tagRepository->getAll();
    }

    public function getById($id)
    {
        return $this->tagRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->tagRepository->create($data);
    }

    public function update($id, array $data): bool
    {
        return $this->tagRepository->update($id, $data);
    }

    public function delete($id): bool
    {
        return $this->tagRepository->delete($id);
    }
}
