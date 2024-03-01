<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Course extends Model
{
    use HasFactory;

    public function family()
    {
        return JobFamily::find($this->family_id);
    }

    public function chapters()
    {
        $ids = explode(",",$this->chapter_ids);
        $chapters = Chapter::whereIn('id', $ids)->get();
        $arr = [];
        foreach ($ids as $id){
            foreach($chapters as $chapter){
                if($chapter->id == $id){
                    array_push($arr, $chapter);
                    break;
                }
            }
        }

        return $arr;
    }

    public function purchased()
    {
        $user = Session::get('user');
        $c = PurchasedCourse::where('user_id', $user->id)->where('course_id', $this->id)->first();
        if(!$c){
            return false;
        }

        return ($c->status == 'complete') ? true : false;
    }

    public function scopeOfType($query, $isAdmin)
    {
        return ($isAdmin) ? $query : $query->where('accessibility', 'all');
    }
}
