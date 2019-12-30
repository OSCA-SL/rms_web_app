<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\User;
use Illuminate\Http\Request;

class ChannelController extends Controller
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
        $channels = Channel::all();
//        return $channels[0]->name;
        return view('channels.index', ['channels' => $channels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $channels = Channel::all();

        $contact_users = User::all();
        return view('channels.create', ['contact_users' => $contact_users, 'channels' => $channels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (auth()->user()->isAdmin()){
            $channel = new Channel;
            $channel->name = $request->input('name');
            $channel->logger = $request->input('logger');
            $channel->frequency = $request->input('frequency');
            $channel->contact_user = $request->input('contact_user');
            $channel->details = $request->input('details');
            $channel->added_by = auth()->user()->id;

            $channel->last_fetch_at = $request->input('last_fetch_at');
            $channel->aired_time = $request->input('aired_time');
            $channel->fetched_day = $request->input('fetched_day');
            $channel->fetched_hour = $request->input('fetched_hour');
            $channel->fetched_minute = $request->input('fetched_minute');
            $channel->fetch_status = $request->input('fetch_status');

            $channel->save();

            return redirect()->to('channels')->with('status', 'Successfully saved channel data!');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        //
    }
}
