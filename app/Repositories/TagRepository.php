<?php
namespace App\Repositories;

use App\Models\Tag;
use App\QueryFilter\TagFilter;
use Illuminate\Http\Request;

class TagRepository
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getAll()
    {
        return (new TagFilter($this->request))->apply(Tag::query())->get();
    }

    public function findById($id)
    {
        return Tag::find($id);
    }

    public function create(array $data)
    {
        return Tag::create($data);
    }

    public function update($id, array $data): bool
    {
        $tag = Tag::find($id);
        return $tag ? $tag->update($data) : false;
    }

    public function delete($id): bool
    {
        $tag = Tag::find($id);
        return $tag ? $tag->delete() : false;
    }
}
