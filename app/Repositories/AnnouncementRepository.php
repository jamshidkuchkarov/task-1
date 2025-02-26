<?php
namespace App\Repositories;

use App\Models\Announcement;
use App\QueryFilter\AnnouncementFilter;
use Illuminate\Http\Request;

class AnnouncementRepository
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getAll()
    {
        return (new AnnouncementFilter($this->request))->apply(Announcement::query()->with(['attributes', 'tags']))->get();
    }

    public function findById($id)
    {
        return Announcement::with(['attributes', 'tags'])->find($id);
    }

    public function create(array $data)
    {
        if ($this->request->hasFile('image')) {
            $imagePath = $this->request->file('image')->store('announcements', 'public');
            $data['image'] = $imagePath;
        }
        $announcement = Announcement::create($data);

        if (isset($data['attributes'])) {
            $announcement->attributes()->createMany($data['attributes']);
        }

        if (isset($data['tags'])) {
            $announcement->tags()->sync($data['tags']);
        }

        return $announcement;
    }

    public function update($id, array $data): bool
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return false;
        }
        if ($this->request->hasFile('image')) {
            if ($announcement->image) {
                \Storage::disk('public')->delete($announcement->image);
            }

            $imagePath = $this->request->file('image')->store('announcements', 'public');
            $data['image'] = $imagePath;
        }

        $announcement->update($data);

        if (isset($data['attributes'])) {
            $announcement->attributes()->delete();
            $announcement->attributes()->createMany($data['attributes']);
        }

        if (isset($data['tags'])) {
            $announcement->tags()->sync($data['tags']);
        }

        return true;
    }


    public function delete($id): bool
    {
        $announcement = Announcement::find($id);
        return $announcement ? $announcement->delete() : false;
    }
}
