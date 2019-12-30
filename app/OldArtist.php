<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldArtist extends Model
{
    protected $guarded = ['id'];
    protected $table = 'old_artists';
}
