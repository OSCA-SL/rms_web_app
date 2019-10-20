<?php

namespace App\Http\Controllers;

use App\Error;
use App\Events\SongUploaded;
use App\Models\Artist;
use App\Models\Song;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Yajra\DataTables\DataTables;

class SongController extends Controller
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


    public function reHash(Song $song)
    {

        $file_name = $song->fileName();

//        $file_name = pathinfo(public_path($song->file_path))['basename'];

        /*$error = new Error;
        $error->message = "Request SENDING OK: {$song->id},  FILENAME: {$file_name}";
        $error->save();*/

        event(new SongUploaded($song, $file_name));

        return redirect()->route('songs.index')->with('status', 'Rehash request sent!');
    }

    public function getSongs()
    {
//        $songs = Song::with(['artists', 'singers'])->get();



        $songs = Song::with([
            /*'artists' => function($artist){
            return $artist->with('user');
        },*/
            'addedUser', 'approvedUser',
            'singers' => function($artist){
                return $artist->with('user');
            },
            'musicians' => function($artist){
                return $artist->with('user');
            },
            'writers' => function($artist){
                return $artist->with('user');
            },
            'producers' => function($artist){
                return $artist->with('user');
            },
            ])
            ->select("songs.*");
//        return $songs;

        return DataTables::of($songs)->make(true);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
//        return config('app.radio_username')." ".config('app.radio_password');
        /*$songs = Song::all();
        return view('songs.index', ['songs' => $songs]);*/
        return view('songs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $songs = Song::all();
        $artists = Artist::all();
        return view('songs.create', ['songs' => $songs, 'artists' => $artists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('song')){

            $song = new Song;
            $song->title = $request->input('title');
            $song->details = $request->input('details');
            $song->released_at = $request->input('released_at');
            $song->added_by = auth()->user()->id;
            if (auth()->user()->isAdmin()){
                $song->approved_by = auth()->user()->id;
            }
            $song->save();

            $song->artists()->attach($request->input('singers'), ['type' => 1]);
            $song->artists()->attach($request->input('music_directors'), ['type' => 2]);

            $song->artists()->attach($request->input('song_writers'), ['type' => 3]);

            $song->artists()->attach($request->input('producers'), ['type' => 4]);

            $artists = array();
            $artists['singers'] = $request->input('singers');
            $artists['music_directors'] = $request->input('music_directors');
            $artists['song_writers'] = $request->input('song_writers');
            $artists['producers'] = $request->input('producers');



            $file = $request->file('song');
            $file_name = $song->id.".".$file->getClientOriginalExtension();
            $file->storeAs('songs', $file_name, 'public');

            $song->file_path = "/storage/songs/".$file_name;

            $song->save();

            event(new SongUploaded($song, $file_name));

            /*$song->setConnection('mysql_r');
            $song->save();*/

            /*$song->artists()->attach($request->input('singers'), ['type' => 1]);
            $song->artists()->attach($request->input('music_directors'), ['type' => 2]);

            $song->artists()->attach($request->input('song_writers'), ['type' => 3]);

            $song->artists()->attach($request->input('producers'), ['type' => 4]);*/

            /*$status = $request->getStatusCode();
            $response = $request->getBody();*/

            return response("Successfully Uploaded the song", 200);
        }

        else{
            return response("Please add a valid song file", 401);
        }





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        if (auth()->user()->isAdmin()){
            $songs = Song::all();
            $artists = Artist::all();
            return view('songs.edit', ['song' => $song, 'songs' => $songs, 'artists' => $artists]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        if (auth()->user()->isAdmin()){
            if ($request->hasFile('song')){

                $song->title = $request->input('title');
                $song->details = $request->input('details');
                $song->released_at = $request->input('released_at');
                $song->updated_by = auth()->user()->id;
                if (auth()->user()->isAdmin()){
                    $song->approved_by = auth()->user()->id;
                }
                $song->save();

                if($request->has('singers') && count($request->input('singers')) > 0) {
                    $song->artists()->sync(array_fill_keys($request->input('singers'), ['type' => 1]));
                }
                if($request->has('music_directors') && count($request->input('music_directors')) > 0) {
                    $song->artists()->attach(array_fill_keys($request->input('music_directors'), ['type' => 2]));
                }

                if($request->has('song_writers') && count($request->input('song_writers')) > 0) {
                    $song->artists()->attach(array_fill_keys($request->input('song_writers'), ['type' => 3]));
                }

                if($request->has('producers') && count($request->input('producers')) > 0) {
                    $song->artists()->attach(array_fill_keys($request->input('producers'), ['type' => 4]));
                }


                $artists = array();
                $artists['singers'] = $request->input('singers');
                $artists['music_directors'] = $request->input('music_directors');
                $artists['song_writers'] = $request->input('song_writers');
                $artists['producers'] = $request->input('producers');



                $file = $request->file('song');
                $file_name = $song->id.".".$file->getClientOriginalExtension();
                $file->storeAs('songs', $file_name, 'public');

                $song->file_path = "/storage/songs/".$file_name;

                $song->save();

                event(new SongUploaded($song, $file_name));

                return response("Successfully Uploaded the song", 200);
            }

            else{
                return response("Please add a valid song file", 401);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        if (auth()->user()->isAdmin()){
            $song->deleted_by = auth()->user()->id;
            $song->save();
            $song->matches()->delete();
            DB::connection('mysql_system')
                ->table('fingerprints')
                ->where('song_id', '=', $song->id)
                ->delete();

            $song->delete();

            $file_name = pathinfo(public_path($song->file_path))['basename'];
            if (Storage::disk('public')->exists("songs/{$file_name}")){
                Storage::disk('public')->delete("songs/{$file_name}");
            }

            return response("Successfully deleted the song", 204);
        }
    }
}
