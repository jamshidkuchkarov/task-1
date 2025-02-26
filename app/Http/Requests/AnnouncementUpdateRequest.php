<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Announcement;

class AnnouncementUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {

        $announcement = Announcement::find($this->route('announcement'));

        return $announcement && $announcement->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'sometimes|exists:categories,id',
            'region_id' => 'sometimes|exists:regions,id',
            'attributes' => 'sometimes|array',
            'attributes.*.key' => 'required_with:attributes|string|max:255',
            'attributes.*.value' => 'required_with:attributes|string|max:255',
            'tags' => 'sometimes|array',
            'tags.*' => 'exists:tags,id',
        ];
    }
}
