@extends('layouts.master')

@section('styles')

    {{--<link rel="stylesheet" href="/css/jquery-ui.css">--}}

    <link rel="stylesheet" href="/css/autocomplete.css">
    <!-- Wait Me Css -->
    <link href="/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />


    <!-- Bootstrap DatePicker Css -->
    <link href="/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="/css/dropzone.css" rel="stylesheet">

    <style>
        .typeahead .dropdown-menu{
            top: 100px !important;
        }
    </style>

    <!-- Bootstrap Select Css -->
    {{--    <link href="/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />--}}
@endsection

@section('content')
    <div class="block-header">
        <h2>SONGS</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Add New Songs
                        <small>Enter Song Data</small>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('songs.store') }}" method="post" id="song-form">
                        @csrf
                        {{--<div class="ui-widget">
                            <label for="tags">Tags: </label>
                            <input id="tags">
                        </div>--}}

                        <h2 class="card-inside-title">Song Related Data</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line ui-widget">
                                        <label for="title">Title</label>
                                        <input type="text" id="title" name="title" class="form-control typeahead pb-2 mb-2" placeholder="Song Title" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input name="released_at" id="released_at" type="text" class="form-control" placeholder="Released Date">
                                    </div>
                                    <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="details">Details</label>
                                        <input required type="text" id="details" name="details" class="form-control typeahead pb-2 mb-2" placeholder="Details about this song (optional)" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div id="pic-area" class=" mx-auto">

                                    <div class="row">
                                        <div class="col">
                                            <div class="dropzone-previews" style="display: inline-block;"></div>
                                            <div class="file-field dropzone" id="drop-image">
                                                <div class="fallback">
                                                    <div class="btn">
                                                        <span>Song</span>
                                                        <input type="file" id="song" name="song" accept="audio/*">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" placeholder="This will be the song file that will be uploaded">
                                                    </div>
                                                </div>
                                                <div class="input-field"></div>
                                                <div id="fileDisplayArea"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>


                        <h2 class="card-inside-title">Artist Data</h2>
                        <div class="row clearfix">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="singers">Singer(s)</label>
                                        <select id="singers" name="singers[]" class="form-control show-tick select2" required multiple="multiple">
                                            @foreach($artists as $artist)
                                                <option value="{{ $artist->id }}">{{ $artist->user->first_name }} {{ $artist->user->last_name }} - {{ $artist->membership_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="music_directors">Music Director(s)</label>
                                        <select id="music_directors" name="music_directors[]" class="form-control show-tick select2" required multiple="multiple">
                                            @foreach($artists as $artist)
                                                <option value="{{ $artist->id }}">{{ $artist->user->first_name }} {{ $artist->user->last_name }} - {{ $artist->membership_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="song_writers">Song Writers(s)</label>
                                        <select id="song_writers" name="song_writers[]" class="form-control show-tick select2" required multiple="multiple">
                                            @foreach($artists as $artist)
                                                <option value="{{ $artist->id }}">{{ $artist->user->first_name }} {{ $artist->user->last_name }} - {{ $artist->membership_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="producers">Producers(s)</label>
                                        <select id="producers" name="producers[]" class="form-control show-tick select2" required multiple="multiple">
                                            @foreach($artists as $artist)
                                                <option value="{{ $artist->id }}">{{ $artist->user->first_name }} {{ $artist->user->last_name }} - {{ $artist->membership_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>



                        <div class="row clearfix">
                            <div class="col-sm-12">
                                    <div id="progress-bar-div" class="hidden">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 100%">
                                                <span class="sr-only">Uploading</span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-sm-6 pull-right">
                                <button id="submit" type="submit" class="btn btn-primary btn-block btn-lg pull-right">Add</button>
                            </div>

                        </div>
                    </form>


                    {{--<div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-4" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-4" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-4" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-3" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-3" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-3" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-3" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="card-inside-title">Different Sizes</h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group form-group-lg">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Large Input" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Default Input" />
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Small Input" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="card-inside-title">Floating Label Examples</h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control">
                                    <label class="form-label">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float form-group-lg">
                                <div class="form-line">
                                    <input type="text" class="form-control" />
                                    <label class="form-label">Large Input</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" />
                                    <label class="form-label">Default Input</label>
                                </div>
                            </div>
                            <div class="form-group form-float form-group-sm">
                                <div class="form-line">
                                    <input type="text" class="form-control" />
                                    <label class="form-label">Small Input</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="card-inside-title">Input Status</h2>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line focused">
                                    <input type="text" class="form-control" value="Focused" placeholder="Statu Focused" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line disabled">
                                    <input type="text" class="form-control" placeholder="Disabled" disabled />
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

@endsection

@section('scripts')

    <!-- Autosize Plugin Js -->
    <script src="/plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="/plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="/js/pages/forms/basic-form-elements.js"></script>

    <script src="/js/bootstrap3-typeahead.min.js"></script>

    <!-- Dropzone Plugin Js -->
    <script src="/plugins/dropzone/dropzone.js"></script>


    <script src="/js/autocomplete.js"></script>

    <script>
        /*An array containing all the country names in the world:*/
        var availableSongs = [
            @foreach($songs as $song)
                "{{ $song->title }}",
            @endforeach
                ""
        ];
        availableSongs.pop();

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("title"), availableSongs);
    </script>

    {{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {

            var date = $('#released_at').datepicker({ dateFormat: 'dd-mm-yyyy' }).val();

            var availableTags = [
                @foreach($songs as $song)
                    "{{ $song->title }}",
                @endforeach
                ""
            ];
            availableTags.pop();
            $( "#title" ).autocomplete({
                source: availableTags
            });
        } );
    </script>--}}


    <script>
        var data = [];
        var i = 0;
        @foreach($songs as $song)
            data[i++] = "{{ $artist->title }}";
        @endforeach

        var myDropzone;

        $(document).ready(function() {
            $('.select2').select2();

            $('.typeahead').typeahead({ source: data, autoSelect: false});


            //Dropzone
            // jQuery

            Dropzone.options.dropImage = {
                dictDefaultMessage: "Drag and drop or click to upload the song file",
                autoProcessQueue: false,
                uploadMultiple: false,
                parallelUploads: 100,
                maxFiles: 1,
                url: $('#song-form').attr('action'),
                method: 'post' ,
                paramName: "song", // The name that will be used to transfer the file
                maxFilesize: 9000, // MB,
                filesizeBase: 1024,
                addRemoveLinks: true,
                clickable: true,
                acceptedFiles: 'audio/*',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                init: function() {
                    myDropzone = this;

                    myDropzone.on("sending", function(file, xhr, formData) {

                        $('#progress-bar-div').removeClass('hidden');

                        var data = $('#song-form').serializeArray();
                        $.each(data, function(key, el) {
                            formData.append(el.name, el.value);
                        });
                    });

                    myDropzone.on("complete", function(file) {
                        myDropzone.removeFile(file);

                        $('#progress-bar-div').addClass('hidden');
                    });
                    myDropzone.on("success", function(file, serverMessage) {

                        console.log(serverMessage);
                        $.toast({
                            heading: 'Success',
                            text: serverMessage,
                            showHideTransition: 'fade',
                            icon: 'success'
                        });

                        setTimeout(function () {
                            window.location.href = '{{ route('songs.index') }}';
                        }, 3100);
//
                    });
                    myDropzone.on("error", function(file, errorMessage) {

                        console.log(errorMessage);
                        $.toast({
                            heading: 'Error',
                            text: errorMessage,
                            showHideTransition: 'fade',
                            icon: 'error'
                        });
                    });
                }
            };


            $('#submit').click(function (e) {
                e.preventDefault();
                myDropzone.processQueue();
            });
        });



    </script>

@endsection
