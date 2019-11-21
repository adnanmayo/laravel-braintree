<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Billable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','referral_link','referred_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'subscribed_at' => 'datetime'
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    public function isSubscribed()
    {
        return $this->newQuery()
            ->where('id', $this->id)
            ->whereRaw('NOW() < ( subscribed_at + INTERVAL 1 MONTH)')
            ->first();
    }

    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function parent()
    {
        $this->belongsTo(self::class, 'referred_by');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'referred_by');
    }

}
