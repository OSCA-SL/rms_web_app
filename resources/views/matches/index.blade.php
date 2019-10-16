@extends('layouts.master')

@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Wait Me Css -->
    <link href="/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />


    <!-- Bootstrap DatePicker Css -->
    <link href="/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

@endsection

@section('content')

    <div class="block-header">
        <h2>Reports</h2>
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
                        Generate Report
                        <small>Enter Report Data</small>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('reports.generate') }}" method="post" id="match-form">
                        @csrf
                        {{--<div class="ui-widget">
                            <label for="tags">Tags: </label>
                            <input id="tags">
                        </div>--}}

{{--                        <h2 class="card-inside-title">Song Related Data</h2>--}}
                        <div class="row clearfix">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="from">From Date</label>
                                        <input required type="text" id="from" name="from" class="form-control pb-2 mb-2" placeholder="2019-09-08 00:00:00" />
                                    </div>


                                </div>

                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="to">To Date</label>
                                        <input required type="text" id="to" name="to" class="form-control pb-2 mb-2" placeholder="2019-09-08 23:59:59" />
                                    </div>


                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="artist">Artist</label>
                                        <select id="artist" name="artist" class="form-control show-tick select2" required>
                                            <option value="-1" selected>All</option>
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
                                        <label for="channel">Channel</label>
                                        <select id="channel" name="channel" class="form-control show-tick select2" required >
                                            <option value="-1" selected>All</option>
                                            @foreach($channels as $channel)
                                                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 pull-right">
                                <button id="submit" type="submit" class="btn btn-primary btn-block btn-lg pull-right">Generate Report</button>
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

    <script>
        $(function () {
            $('.select2').select2();

            $('#from').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD 00:00:00'
            });

            $('#to').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD 23:59:59'
            });

        });
    </script>


@endsection
