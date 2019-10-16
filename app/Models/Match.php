<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel', 'channel_id');
    }

    public function song()
    {
        return $this->belongsTo('App\Models\Song', 'song_id');
    }
}
