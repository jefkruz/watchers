<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    public function attendances()
    {
        return $this->hasMany(MeetingAttendance::class, 'meeting_id');
    }

    public function getAttendanceCount()
    {
        return $this->attendances()->count();
    }

    public function attending()
    {
        return MeetingAttendance::where('user_id', session('user')->user_id)->where('meeting_id', $this->id)->exists();
    }

    public function isAvailable()
    {
        return $this->end_date >= date('Y-m-d H:i:s');
    }

    public function isLive()
    {
        return $this->end_date >= date('Y-m-d H:i:s') && $this->start_date <= date('Y-m-d H:i:s');
    }

    public function scopeOfType($query, $isTeamHead)
    {
        return ($isTeamHead) ? $query : $query->where('accessibility', 'all');
    }
}
