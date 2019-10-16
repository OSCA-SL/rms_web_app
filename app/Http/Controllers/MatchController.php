<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Channel;
use App\Models\Match;
use Illuminate\Http\Request;

class MatchController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::all();
        $channels = Channel::all();
        return view('matches.index', ['artists' => $artists, 'channels' => $channels]);
    }

    public function generate(Request $request)
    {
//        return $request->all();
        $from = $request->input('from');
        $to = $request->input('to');
        $artist_id = $request->input('artist');
        $channel_id = $request->input('channel');


        $artists = Artist::all();
        if ($artist_id == "-1"){
            $artists = Artist::all();
        }
        else{
            $artists = Artist::find([$artist_id]);
        }

        $where_artist_ids = [];
        $song_ids = [];
        foreach ($artists as $artist) {
            $where_artist_ids[] = $artist->id;
            $songs = $artist->songs;
            foreach ($songs as $song) {
                if (!in_array($song->id, $song_ids)){
                    $song_ids[] = $song->id;
                }
            }

        }

        $channels = Channel::all();
        if ($channel_id == "-1"){
            $channels = Channel::all();
        }
        else{
            $channels = Channel::find([$channel_id]);
        }

        $where_channel_ids = [];
        foreach ($channels as $channel) {
            $where_channel_ids[] = $channel->id;
        }

        $matches = Match::whereIn('song_id', $song_ids)
            ->whereIn('channel_id', $where_channel_ids)
            ->whereBetween('start', [$from, $to])
            ->get();


        return view('matches.view', ['matches' => $matches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Match  $match
     * @return \Illuminate\Http\Response
     */
    public function destroy(Match $match)
    {
        //
    }
}
