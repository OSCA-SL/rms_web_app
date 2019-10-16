<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function contactUser(){
        return $this->belongsTo('App\Models\User', 'contact_user');
    }

    public function addedUser(){
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function fee()
    {
        return $this->hasMany('App\Models\Fee', 'channel_id');
    }


    /*
     * Methods for file processing
     * */

    public function isFirstClipFailed()
    {
        return $this->fetch_status <= 0;
    }

    public function setFirstClipFailed()
    {
        $this->attributes['fetch_status'] = 0;
    }

    public function isFirstClipOk()
    {
        return $this->fetch_status >= 1;
    }

    public function setFirstClipOk()
    {
        $this->attributes['fetch_status'] = 1;
    }

    public function isSecondClipFailed()
    {
        return $this->fetch_status <= 2;
    }

    public function setSecondClipFailed()
    {
        $this->attributes['fetch_status'] = 2;
    }

    public function isSecondClipOk()
    {
        return $this->fetch_status >= 3;
    }

    public function setSecondClipOk()
    {
        $this->attributes['fetch_status'] = 3;
    }


    public function isMergingFailed()
    {
        return $this->fetch_status <= 4;
    }

    public function setMergingFailed()
    {
        $this->attributes['fetch_status'] = 4;
    }

    public function isMergingOk()
    {
        return $this->fetch_status >= 5;
    }

    public function setMergingOk()
    {
        $this->attributes['fetch_status'] = 5;
    }

    public function isMatchRequestFailed()
    {
        return $this->fetch_status <= 6;
    }

    public function setMatchRequestFailed()
    {
        $this->attributes['fetch_status'] = 6;
    }

    public function isMatchRequestOk()
    {
        return $this->fetch_status >= 7;
    }

    public function setMatchRequestOk()
    {
        $this->attributes['fetch_status'] = 7;
    }

    public function getPreviousFetch()
    {
        $day = $this->fetched_day == null?0:$this->fetched_day;
        $hour = $this->fetched_hour == null?0:$this->fetched_hour;
        $minute = $this->fetched_minute == null?0:$this->fetched_minute;

        if ($minute <= 0){
            if ($hour <= 0){
                $hour = ($hour + 23) % 24;
                if ($day <= 0){
                    $day = ($day + 59) % 60;
                }

            }
        }

        $minute = ($minute + 59) % 60;

        return ['day' => $day, 'hour' => $hour, 'minute' => $minute];

    }

    public function getCurrentFetch()
    {
        $day = $this->fetched_day == null?0:$this->fetched_day;
        $hour = $this->fetched_hour == null?0:$this->fetched_hour;
        $minute = $this->fetched_minute == null?0:$this->fetched_minute;

        return ['day' => $day, 'hour' => $hour, 'minute' => $minute];

    }

    public function getNextFetch()
    {
        $day = $this->fetched_day == null?0:$this->fetched_day;
        $hour = $this->fetched_hour == null?0:$this->fetched_hour;
        $minute = $this->fetched_minute == null?0:$this->fetched_minute;

        if ($minute >= 59){
            if ($hour >= 23){
                $hour = ($hour + 1) % 24;
                if ($day >= 59){
                    $day = ($day + 1) % 60;
                }
            }
        }

        $minute = ($minute + 1) % 60;

        return ['day' => $day, 'hour' => $hour, 'minute' => $minute];
    }

    public function setFetched($fetch)
    {
        $this->fetched_day = $fetch['fetched_day'];
        $this->fetched_hour = $fetch['fetched_hour'];
        $this->fetched_minute = $fetch['fetched_minute'];
    }




}
