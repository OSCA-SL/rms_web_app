<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\ChannelFee;
use Illuminate\Http\Request;

class ChannelFeeController extends Controller
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
        $fees = ChannelFee::all();
        return view('fees.index', ['fees' => $fees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $channels = Channel::all();
        return view('fees.create', ['channels' => $channels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $channelFee = new ChannelFee;
        $channelFee->channel_id = $request->input('channel_id');
        $channelFee->effective_from = $request->input('effective_from');
        $channelFee->fee = $request->input('fee');
        $channelFee->added_by = auth()->user()->id;
        $channelFee->save();

        return redirect()->to('fees')->with('status', 'Successfully saved channel fee data!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChannelFee  $channelFee
     * @return \Illuminate\Http\Response
     */
    public function show(ChannelFee $channelFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChannelFee  $channelFee
     * @return \Illuminate\Http\Response
     */
    public function edit(ChannelFee $channelFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChannelFee  $channelFee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChannelFee $channelFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChannelFee  $channelFee
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChannelFee $channelFee)
    {
        //
    }
}
