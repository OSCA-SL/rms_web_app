@extends('layouts.master')

@section('styles')
    <!-- Wait Me Css -->
    <link href="/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />


    <!-- Bootstrap DatePicker Css -->
    <link href="/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

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
        <h2>Channels</h2>
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
                        Add New Channel
                        <small>Enter Channel Data</small>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('channels.store') }}" method="post" id="channels-form">
                        @csrf

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="title">Name</label>
                                        <input required type="text" id="name" name="name" autofocus class="form-control typeahead pb-2 mb-2" placeholder="Channel Name" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="logger">Logger</label>
                                        <select name="logger" id="logger" class="form-control">
                                            @for($i = 1; $i <= 32; $i++)
                                                @php($loggerUsed = false)
                                                @foreach($channels as $channel)
                                                    @if($channel->logger == $i)
                                                        @php($loggerUsed = true)
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if($loggerUsed)
                                                    @continue
                                                @endif
                                                <option value="{{ $i }}">Logger {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                            <div class="input-group">
                                                <label for="frequency">Frequency</label>
                                                <input required type="text" id="frequency" name="frequency" class="form-control pb-2 mb-2" placeholder="108.56" />
                                                <span class="input-group-addon">MHz</span>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="contact_user">Contact Person</label>
                                        <select id="contact_user" name="contact_user" class="form-control show-tick select2" required >
                                            @foreach($contact_users as $contact_user)
                                                <option value="{{ $contact_user->id }}">{{ $contact_user->first_name }} {{ $contact_user->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="details">Details (optional)</label>
                                        <input type="text" id="details" name="details" autofocus class="form-control pb-2 mb-2" placeholder="Channel Details (optional)" />
                                    </div>
                                </div>
                            </div>

                            @auth
                                @if(auth()->user()->isAdmin())
                                    <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-warning btn-lg" data-toggle="collapse" data-target="#advanced-options">
                                            Advanced Options
                                        </button>

                                        <div id="advanced-options" class="collapse">
                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="last_fetch_at">Last Fetched At:</label>
                                                        <input required type="text" id="last_fetch_at" name="last_fetch_at" autofocus class="form-control pb-2 mb-2" placeholder="2019-09-08 17:30:00" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="aired_time">Aired Time:</label>
                                                        <input required type="text" id="aired_time" name="aired_time" autofocus class="form-control pb-2 mb-2" placeholder="2019-09-08 17:30:00" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="fetched_day">Last Fetched Day (from the logger):</label>
                                                        <input required type="text" id="fetched_day" name="fetched_day" autofocus class="form-control pb-2 mb-2" placeholder="38" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="fetched_hour">Last Fetched Hour (from the logger):</label>
                                                        <input required type="text" id="fetched_hour" name="fetched_hour" autofocus class="form-control pb-2 mb-2" placeholder="17" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="fetched_minute">Last Fetched Minute (from the logger):</label>
                                                        <input required type="text" id="fetched_minute" name="fetched_minute" autofocus class="form-control pb-2 mb-2" placeholder="9" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="fetch_status">Last Fetch Status:</label>
                                                        <div class="card row">
                                                            <div class="col">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item">0 - first clip failed</li>
                                                                    <li class="list-group-item">1 - first clip ok</li>
                                                                    <li class="list-group-item">2 - second clip failed</li>
                                                                    <li class="list-group-item">3 - second clip ok</li>
                                                                    <li class="list-group-item">4 - merging failed</li>
                                                                    <li class="list-group-item">5 - merging ok</li>
                                                                    <li class="list-group-item">6 - Match Request Failed</li>
                                                                    <li class="list-group-item">7 - Match Request Ok</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <input required type="text" id="fetch_status" name="fetch_status" autofocus class="form-control pb-2 mb-2" placeholder="7" />

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @endif
                            @endauth
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary">
                                </div>
                            </div>
                        </div>




                    </form>

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

    <script>
        $(function () {
            $('.select2').select2();

            $('#last_fetch_at').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm:00'
            });

            $('#aired_time').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm:00'
            });


        });
    </script>


@endsection
