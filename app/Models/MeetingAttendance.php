<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingAttendance extends Model
{
    use HasFactory;

    public function user()
    {
        return User::find($this->user_id);
    }


    public function guest()
    {
        return Participant::find($this->user_id);
    }
}
