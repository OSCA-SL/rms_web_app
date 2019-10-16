@extends('layouts.master')

@section('styles')
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
                        Add New Channel Fee
                        <small>Enter Channel Fee Data</small>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('fees.store') }}" method="post" id="channels-form">
                        @csrf

                        <div class="row clearfix">



                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="channel_id">Channel</label>
                                        <select id="channel_id" name="channel_id" class="form-control show-tick select2" required >
                                            @foreach($channels as $channel)
                                                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="fee">Fee</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">LKR</span>
                                            <input required type="text" id="fee" name="fee" class="form-control pb-2 mb-2" placeholder="100.00" />

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input name="effective_from" id="effective_from" type="text" class="form-control" placeholder="Effective From">
                                    </div>
                                    <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                    </span>
                                </div>
                            </div>



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
        });
    </script>


@endsection
