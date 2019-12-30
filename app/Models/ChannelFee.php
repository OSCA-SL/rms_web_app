<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelFee extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel', 'channel_id');
    }

    public function addedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }
}
