<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'name', 'email', 'password',
    ];*/

    protected $guarded = ['id'];

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
    ];

    public function addedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function artists(){
        return $this->hasMany('App\Models\Artist');
    }

    public function channelContacts(){
        return $this->hasMany('App\Models\Channel', 'contact_user');
    }

    public function channelAdds(){
        return $this->hasMany('App\Models\Channel', 'added_by');
    }

    public function isArtist()
    {
        return count($this->artists) > 0;
    }

    public function isAdmin()
    {
        return $this->role < 3;
    }

    public function isTechnicalAdmin()
    {
        return $this->role < 2;
    }

    public function getRole()
    {
        // 1 - technical_admin 2 - admin, 3 - artist, 4 - client
        $roles = [
            1 => "Technical Admin",
            2 => "Admin",
            3 => "Artist",
            4 => "Client",
            5 => "Other"
        ];
        return $roles[$this->role];
    }

}
