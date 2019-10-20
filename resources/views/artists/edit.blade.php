@extends('layouts.master')

@section('styles')

    <link rel="stylesheet" href="/css/autocomplete.css">

    <!-- Wait Me Css -->
    <link href="/plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />


    <!-- Bootstrap DatePicker Css -->
    <link href="/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

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
        <h2>ARTISTS</h2>
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
                        Edit Artist - {{ $artist->user->first_name }} {{ $artist->user->last_name }}
                        <small>Update Artist Data</small>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('artists.update', $artist->id) }}" method="post">
                        @csrf
                        @method("PUT")

                        <input type="hidden" name="user_id" value="{{ $artist->user->id }}">
                        <h2 class="card-inside-title">Artist Related Data</h2>
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="membership_number">Membership Number</label>
                                        <input value="{{ $artist->membership_number }}" type="text" id="membership_number" name="membership_number" class="form-control pb-2 mb-2" placeholder="Membership Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="type">Artist Type</label>
                                        <select id="type" name="type" class="form-control show-tick select2" required>
                                            <option {{ $artist->type == '0'?"selected":"" }} value="0" disabled>-- Please select --</option>
                                            <option {{ $artist->type == '1'?"selected":"" }} value="1">Singer</option>
                                            <option {{ $artist->type == '2'?"selected":"" }} value="2">Music Director</option>
                                            <option {{ $artist->type == '3'?"selected":"" }} value="3">Song Writer</option>
                                            <option {{ $artist->type == '4'?"selected":"" }} value="4">Producer</option>
                                            <option {{ $artist->type == '5'?"selected":"" }} value="5">Unknown</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="status">Artist Status</label>
                                        <select id="status" name="status" class="form-control show-tick select2" required>
                                            <option {{ $artist->status == '0'?"selected":"" }} value="0" disabled>-- Please select --</option>
                                            <option {{ $artist->status == '1'?"selected":"" }} value="1">Active Member</option>
                                            <option {{ $artist->status == '2'?"selected":"" }} value="2">Consented Member</option>
                                            <option {{ $artist->status == '3'?"selected":"" }} value="3">Non Member</option>
                                            <option {{ $artist->status == '4'?"selected":"" }} value="4">Deceased now, but was Active</option>
                                            <option {{ $artist->status == '5'?"selected":"" }} value="5">Deceased now, but Consent Given</option>
                                            <option {{ $artist->status == '6'?"selected":"" }} value="6">Deceased now, and non member</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix">
                            <div class="col-sm-6 pull-right">
                                <button type="submit" class="btn btn-primary btn-block btn-lg pull-right">Update</button>
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

    <script src="/js/autocomplete.js"></script>

    <script>
        /*An array containing all the country names in the world:*/
        var name_tags = [
            @foreach($artists as $artist)
                "{{ $artist->user->first_name." ".$artist->user->last_name }}",
            @endforeach
                ""
        ];
        name_tags.pop();

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("first_name"), name_tags);

        autocomplete(document.getElementById("last_name"), name_tags);

        var membership_number_tags = [
            @foreach($artists as $artist)
                "{{ $artist->membership_number }}",
            @endforeach
                ""
        ];
        autocomplete(document.getElementById("membership_number"), membership_number_tags);

    </script>

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


    <script>
        var data = [];
        var i = 0;
        @foreach($artists as $artist)
            data[i++] = "{{ $artist->membership_number }}";
        @endforeach
        $(document).ready(function() {
            $('.select2').select2();

            $('.typeahead').typeahead({ source: data, autoSelect: false});
        });
    </script>

@endsection
