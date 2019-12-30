<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\User;
use App\OldArtist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ArtistController extends Controller
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

    public function seta()
    {
        set_time_limit(3600);
        $oldAs = OldArtist::all();

        foreach ($oldAs as $a) {
            $user = new User;
            $user->first_name = $a->first_name;
            $user->last_name = $a->last_name;

            $user->email = "osca.rms+a".str_replace(' ', '', $a->nic)."@gmail.com";

            $user->password = Hash::make($a->nic);
            $user->dob = $a->dob;
            $user->nic = $a->nic;
            $user->mobile = $a->phone;

            $user->address = $a->address;
            $user->role = 3;
            $user->added_by = auth()->user()->id;
            $user->comments = $a->comments;
            $user->save();

            if ( Str::startsWith(strtolower($a->membership_number), "s") )
            {
                $type = 1;
            }
            elseif ( Str::startsWith(strtolower($a->membership_number), "md") )
            {
                $type = 2;
            }
            elseif ( Str::startsWith(strtolower($a->membership_number), "lw") )
            {
                $type = 3;
            }
            elseif ( Str::startsWith(strtolower($a->membership_number), "mb") )
            {
                $type = 5;
            }
            else{
                $type = 6;
            }


            if ( Str::contains(strtolower($a->comments), "d") )
            {
                $status = 4;
            }
            elseif ( Str::contains(strtolower($a->comments), "D") )
            {
                $status = 4;
            }
            else{
                $status = 1;
            }


            $artist = new Artist;
            $artist->user_id = $user->id;
            $artist->membership_number = $a->membership_number;
            $artist->type = $type;
            $artist->status = $status;

            $artist->save();


        }

        return "okay";

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->isAdmin()){
            $artists = Artist::all();
        }
        else if (auth()->user()->isArtist()){
            $artists = Artist::where('user_id', auth()->user()->id)->get();
        }

        return view('artists.index', ['artists' => $artists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->isAdmin()){
            $artists = Artist::all();

            return view('artists.create', ['artists' => $artists]);
        }

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
            $user = new User;
            $user->first_name = $request->input('first_name') !=""?$request->input('first_name'):"";
            $user->last_name = $request->input('last_name') !=""?$request->input('last_name'):"";
            if ($request->input('email') !=""){
                $user->email = $request->input('email');
            }
            else{
                $user->email = str_replace(' ', '', "rmsosca+".$user->first_name."_".$user->last_name."@gmail.com");
            }
            $user->dob = $request->input('dob') !=""?$request->input('dob'):null;
            $user->nic = $request->input('nic') !=""?$request->input('nic'):null;
            $user->mobile = $request->input('mobile') !=""?$request->input('mobile'):null;
            $user->land = $request->input('land') !=""?$request->input('land'):null;
            $user->address = $request->input('address') !=""?$request->input('address'):null;
            $user->role = 3;
            $user->added_by = auth()->user()->id;
            $user->password = Hash::make($request->input('first_name'));
            $user->save();



            $artist = new Artist;
            $artist->user_id = $user->id;
            $artist->added_by = auth()->user()->id;
            $artist->membership_number = $request->input('membership_number');
            $artist->type = $request->input('type');
            $artist->status = $request->input('status');
            $artist->save();

            /*$user->setConnection('mysql_r')->save();
            $artist->setConnection('mysql_r')->save();*/


            return redirect()->route('artists.index')->with('status', 'Successfully saved user & artist data!');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        if (auth()->user()->isAdmin()){
            $artists = Artist::all();

            return view('artists.edit', [ 'artist' => $artist, 'artists' => $artists]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        if (auth()->user()->isAdmin()){

            /*$user_id = $request->input('user_id');
            $user = User::findOrFail($user_id);

            $artist->user_id = $user->id;*/
            $artist->updated_by = auth()->user()->id;
            $artist->membership_number = $request->input('membership_number');
            $artist->type = $request->input('type');
            $artist->status = $request->input('status');
            $artist->save();


            return redirect()->route('artists.index')->with('status', 'Successfully updated the artist data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        if (auth()->user()->isAdmin()){
            $artist->deleted_by = auth()->user()->id;

            $artist->save();

            $artist->delete();


            return response("Successfully deleted the user", 204);
        }
    }
}
