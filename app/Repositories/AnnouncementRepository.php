<?php
namespace App\Repositories;

use App\Models\Announcement;
use App\QueryFilter\AnnouncementFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function update($id, array $data): Announcement|null
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return false;
        }

        if (!empty($data['image'])) {
            Storage::disk('public')->delete($announcement->image);
            $data['image'] = $data['image']->store('announcements', 'public');
        }

        $announcement->update($data);

        if (!empty($data['attributes'])) {
            $attributes = collect($data['attributes']);

            foreach ($attributes as $attribute) {
                $announcement->attributes()->updateOrCreate(
                    ['key' => $attribute['key']],
                    ['value' => $attribute['value']]
                );
            }

            $announcement->attributes()
                ->whereNotIn('key', $attributes->pluck('key'))
                ->delete();
        } else {
            $announcement->attributes()->delete();
        }



        if (isset($data['tags'])) {
            $announcement->tags()->sync($data['tags']);
        }

        return $announcement->load(['attributes', 'tags']);
    }



    public function delete($id): bool
    {
        $announcement = Announcement::find($id);
        return $announcement ? $announcement->delete() : false;
    }
}
