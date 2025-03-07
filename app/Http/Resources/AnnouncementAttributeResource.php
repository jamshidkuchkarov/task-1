<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementAttributeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'key'   => $this->key,
            'value' => $this->value,
        ];
    }
}
