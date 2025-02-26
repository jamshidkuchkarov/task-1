<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'user_id'     => $this->user_id,
            'category_id' => $this->category_id,
            'region_id'   => $this->region_id,
            'title'       => $this->title,
            'description' => $this->description,
            'image'       => $this->image ? asset('storage/' . $this->image) : null,
            'price'       => $this->price,
            'attributes'  => AnnouncementAttributeResource::collection($this->attributes),
            'tags'        => TagResource::collection($this->tags),
            'created_at'  => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
