<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    public function materials()
    {
        return CourseMaterial::where('chapter_id', $this->id)->get();
    }
}
