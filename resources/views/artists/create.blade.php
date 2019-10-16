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
                        Add New Artists
                        <small>Enter Artist Data</small>
                    </h2>
                    {{--<ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>--}}
                </div>
                <div class="body">
                    <form action="{{ route('artists.store') }}" method="post">
                        @csrf

                        <h2 class="card-inside-title">Artist Related Data</h2>
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="membership_number">Membership Number</label>
                                        <input type="text" id="membership_number" name="membership_number" class="form-control pb-2 mb-2" placeholder="Membership Number" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="type">Artist Type</label>
                                        <select id="type" name="type" class="form-control show-tick select2" required>
                                            <option value="0">-- Please select --</option>
                                            <option value="1">Singer</option>
                                            <option value="2">Music Director</option>
                                            <option value="3">Song Writer</option>
                                            <option value="4">Producer</option>
                                            <option value="5">Unknown</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="status">Artist Status</label>
                                        <select id="status" name="status" class="form-control show-tick select2" required>
                                            <option value="0">-- Please select --</option>
                                            <option value="1">Active Member</option>
                                            <option value="2">Consented Member</option>
                                            <option value="3">Non Member</option>
                                            <option value="4">Deceased now, but was Active</option>
                                            <option value="5">Deceased now, but Consent Given</option>
                                            <option value="6">Deceased now, and non member</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h2 class="card-inside-title">Basic User Data</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input required type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input required type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" name="email" class="form-control" placeholder="Email (optional)" />
                                    </div>
                                </div>

                                <div class="input-group date">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input name="dob" type="text" class="form-control" placeholder="Date of Birth (Optional)">

                                    </div>
                                    <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                    </span>
                                </div>


                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="nic" class="form-control" placeholder="NIC (Optional)" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="mobile" class="form-control" placeholder="Mobile (Optional)" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="land" class="form-control" placeholder="Land Phone (Optional)" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="address" class="form-control" placeholder="Address (Optional)" />
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row clearfix">
                            <div class="col-sm-6 pull-right">
                                <button type="submit" class="btn btn-primary btn-block btn-lg pull-right">Add</button>
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
