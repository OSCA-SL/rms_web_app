<?php

namespace App\Listeners;

use App\Error;
use App\Events\SongUploaded;
use App\Models\Fingerprint;
use Illuminate\Contracts\Queue\ShouldQueue;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

class SendUploadedSong implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SongUploaded  $event
     * @return void
     */
    public function handle(SongUploaded $event)
    {
        $song = $event->song;
        $file_name = $event->filename;

        /*$ftp_path = $request->file('song')->storeAs('', $file_name, 'ftp');
        $ftp = Storage::disk('ftp')->exists($file_name);*/

//        $file_path = storage_path('app/public/songs/'.$file_name);

        $error = new Error;
        $error->message = "Request: SEND EVENT CALLED. STARTING FTP";
        $error->save();

        $local_file  = Storage::disk('public')->get("/songs/{$file_name}");

        $ftp = Storage::disk('ftp')->put($file_name, $local_file);

        $ftp_exists = Storage::disk('ftp')->exists($file_name);

        /*$ftp_exists = true;
        $ftp = true;*/

        $error = new Error;
        $error->message = "Request: SEND EVENT CALLED. FTP: {$ftp}, FTP_EXIST: {$ftp_exists}";
        $error->save();

        if ($ftp_exists == true){


            $error = new Error;
            $error->message = "Request: SEND EVENT FTP OK, SONG: {$song->id}, F: {$file_name} SENDING TO: ".config('app.radio_server');
            $error->save();

            $song->hash_status = 1;
            $song->save();

            $server_url = config('app.radio_server');
//            $file_path = "/var/www/html/osca/storage/app/public/songs/".$file_name;

            $client = new Client();

            $promise = $client->postAsync($server_url, [

                /*'json' => [
                    'songId' => $song->id,
                    'path' => "/var/www/html/osca/storage/app/public/songs/".$file_name,
                    'username' => config('app.radio_username'),
                    'password' => config('app.radio_password'),
                ]*/

                'multipart' => [
                    [
                        'name' => 'username',
                        'contents' => config('app.radio_username'),
                    ],
                    [
                        'name' => 'password',
                        'contents' => config('app.radio_password'),
                    ],
                    [
                        'name' => 'id',
                        'contents' => $song->id,
                    ],
                    [
                        'name' => 'file_name',
                        'contents' => $file_name,
                    ],
                    [
                        'name' => 'ftp',
                        'contents' => $ftp_exists,
                    ],
                    /*[
                        'name' => 'song_file',
                        'contents' => fopen(storage_path('app/public/songs/').$file_name, 'r'),
                    ],*/
                ]
            ])->then(
                function (ResponseInterface $res) use ($song){
                    $song->refresh();

                    $error = new Error;
                    $error->message = "Request: SEND EVENT RESPONSE OK";
                    $error->save();

                    /**/$response_status = $res->getStatusCode();
                    $fp_count = Fingerprint::connection('mysql_system')
                        ->where('song_id', $song->id)
                        ->count();
                    if ($response_status >= 200 && $response_status < 300 && $fp_count > 0){
                        $song->hash_status = 3;
                    }
                    else{
                        $song->hash_status = 2;
                    }

                    $song->save();
                },
                function (RequestException $e) use ($song){
                    $song->refresh();
                    if ($song->hash_status > 2){
                        $song->hash_status = 2;
                        $song->save();
                    }


                    $message = $e->getMessage();
                    $method = $e->getRequest()->getMethod();
                    $error = new Error;
                    $error->message = "CLOUD:HTTP: ".$message.", METHOD: ".$method.", BODY: ".$e->getRequest()->getBody();
                    $error->save();

                }
            );

            $res = $promise->wait();



            $song->remote_file_path = "http://song-hash.osca.lk/storage/songs/".$file_name;
        }
        else{
            $song->hash_status = 0;
            $song->save();
        }



        $song->save();

    }

    /**
     * Handle a job failure.
     *
     * @param  \App\Events\SongUploaded  $event
     * @param  \Exception  $exception
     * @return void
     */

    public function failed(SongUploaded $event, $exception)
    {
        $song = $event->song;

        $error = new Error;
        $error->message = "CLOUD:EVENT: SONG_ID:{$song->id}, ERROR_CODE: {$exception->getCode()}, ERROR: {$exception->getMessage()}, ERROR_TRACE: {$exception->getTraceAsString()}, ERROR_FILE: {$exception->getFile()}, ERROR_LINE: {$exception->getLine()}";
        $error->save();
    }

/*
    public function saveSong(Song $song)
    {
        DB::connection('mysql_r')->table('songs')->insert(
            $song->toArray()
        );
    }*/

}
