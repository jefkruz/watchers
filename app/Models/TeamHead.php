<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamHead extends Model
{
    use HasFactory;

    public function profile()
    {
        return User::find($this->user_id);
    }
}
