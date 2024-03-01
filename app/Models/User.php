<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function level()
    {
        $id = Auth::user()->id;
        $referral = User::where('referral_id',$id)->get();
        $referrals = $referral->count();
        if ($referrals >= '10000')
            return  'VIP';
        elseif ($referrals >= '5000')
            return  'STAR';

        elseif ($referrals >= '1000')
            return  'GALAXY';
        elseif ($referrals >= '500')
            return  'LUMINARY';

        elseif( $referrals >= '100')
            return  'PREMIUM';

        elseif  ($referrals >= '10')
            return 'GEM';
        else return  'NEW';

    }

    public function color()
    {
        $id = Auth::user()->id;
        $referral = User::where('referral_id',$id)->get();
        $referrals = $referral->count();
        if ($referrals >= '10000')
            return  'gold';
        elseif ($referrals >= '5000')
            return  'purple';

        elseif ($referrals >= '1000')
            return  'blue';
        elseif ($referrals >= '500')
            return  'green';

        elseif( $referrals >= '100')
            return  'orange';

        elseif  ($referrals >= '10')
            return 'grey';
        else return  'brown';

    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isTeamHead()
    {
        return TeamHead::where('user_id', $this->id)->exists();
    }
}
