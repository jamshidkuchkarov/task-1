<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementAttribute extends Model
{
    use HasFactory;
    protected $fillable = ['announcement_id', 'key', 'value'];
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }
}
