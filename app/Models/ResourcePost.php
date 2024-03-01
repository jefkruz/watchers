<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourcePost extends Model
{
    use HasFactory;

    public function comments()
    {
        return ResourceComment::where('resource_id', $this->id)->get();
    }

    public function scopeOfType($query, $isTeamHead)
    {
        return ($isTeamHead) ? $query : $query->where('accessibility', 'all');
    }
}
