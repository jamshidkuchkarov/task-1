<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'category_id', 'region_id', 'title', 'description', 'price','image'];
    public function attributes()
    {
        return $this->hasMany(AnnouncementAttribute::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'announcement_tag');
    }
}
