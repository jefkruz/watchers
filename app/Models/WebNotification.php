<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class WebNotification extends Model
{
    use HasFactory;

    public function isNew()
    {
        $staff = Session::get('user');
        return !ViewedNotification::where('notification_id', $this->id)->where('user_id', $staff->id)->exists();
    }
}
