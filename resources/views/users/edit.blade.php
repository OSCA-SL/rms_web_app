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
        <h2>USERS</h2>
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
                        Edit User
                        <small>Update User Data</small>
                    </h2>
                </div>
                <div class="body">
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        @csrf

                        @method("PUT")

                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input value="{{ $user->first_name }}" required type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input value="{{ $user->last_name }}" required type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input value="{{ $user->email }}"  required type="email" name="email" class="form-control" placeholder="Email" />
                                    </div>
                                </div>

                                <div class="input-group date">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input value="{{ $user->dob }}" name="dob" type="text" class="form-control" placeholder="Date of Birth (Optional)">

                                    </div>
                                    <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                    </span>
                                </div>


                                <div class="form-group">
                                    <div class="form-line">
                                        <input value="{{ $user->nic }}"  required type="text" name="nic" class="form-control" placeholder="NIC" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input value="{{ $user->mobile }}"  type="text" name="mobile" class="form-control" placeholder="Mobile (Optional)" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input value="{{ $user->land }}"  type="text" name="land" class="form-control" placeholder="Land Phone (Optional)" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input value="{{ $user->address }}"  type="text" name="address" class="form-control" placeholder="Address (Optional)" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-inline">
                                        <select name="role" id="role" class="form-control" required>
                                            <option disabled {{ $user->role == 0?"selected":"" }}>Select User Role</option>
                                            <option value="2" {{ $user->role == 2?"selected":"" }}>Admin</option>
                                            <option value="3" {{ $user->role == 3?"selected":"" }}>Artist</option>
                                            <option value="4" {{ $user->role == 4?"selected":"" }}>Client (FM Channel Representative)</option>
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
        let name_tags = [
            @foreach($users as $user)
                "{{ $user->first_name." ".$user->last_name }}",
            @endforeach
                ""
        ];
        name_tags.pop();

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("first_name"), name_tags);

        autocomplete(document.getElementById("last_name"), name_tags);


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


    {{--<script>
        var data = [];
        var i = 0;
        @foreach($artists as $artist)
            data[i++] = "{{ $artist->membership_number }}";
        @endforeach
        $(document).ready(function() {
            $('.select2').select2();

            $('.typeahead').typeahead({ source: data, autoSelect: false});
        });
    </script>--}}

@endsection
