@extends('layouts.master')

@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endsection

@section('content')
    <div class="block-header">
        <h2>REPORT</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <div class="body">
                    <a href="{{ route('reports.index') }}" class="btn bg-deep-orange waves-effect btn-lg">
                        {{--<i class="material-icons">playlist_add</i>--}} BACK
                    </a>
                </div>

            </div>


        </div>

    </div>


    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        REPORT
                    </h2>
                    <ul class="header-dropdown m-r--5">
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
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Start At</th>
                                <th>End At</th>
                                <th>Channel</th>
                                <th>Song</th>
                                <th>Artists</th>
                                <th>Created At</th>
                                <th>Updated At</th>
{{--                                <th>Actions</th>--}}
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Start At</th>
                                <th>End At</th>
                                <th>Channel</th>
                                <th>Song</th>
                                <th>Artists</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            @foreach($matches as $match)
                                <tr>
                                    <td>{{ $match->id }}</td>
                                    <td>{{ $match->start }}</td>
                                    <td>{{ $match->end }}</td>
                                    <td>
                                        <strong>ID: </strong> {{ $match->channel->id }}, <strong>NAME: </strong> {{ $match->channel->name }}
                                    </td>
                                    <td>
                                        <strong>ID: </strong> {{ $match->song->id }}, <strong>NAME: </strong> {{ $match->song->name }}
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($match->song->artists as $artist)
                                                <li>
                                                    ARTIST ID: {{ $artist->id }}, ARTIST NAME: {{ $artist->user->first_name }} {{ $artist->user->last_name }}
                                                </li>
                                            @endforeach
                                        </ul>

                                    </td>
                                    <td>{{ $match->created_at }}</td>
                                    <td>{{ $match->updated_at }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->




@endsection


@section('scripts')
    <!-- Jquery DataTable Plugin Js -->
    <script src="/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    {{--    <script src="/js/admin.js"></script>--}}
    {{--    <script src="/js/pages/tables/jquery-datatable.js"></script>--}}

    <script src="/js/datatables.js"></script>

@endsection
