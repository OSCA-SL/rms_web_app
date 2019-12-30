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
                                <th>#</th>
                                <th>Song</th>
                                <th>Singer(s)</th>
                                <th>Musician(s)</th>
                                <th>Writer(s)</th>
                                <th>Start At</th>
                                <th>End At</th>
                                <th>Channel</th>
{{--                                <th>Actions</th>--}}
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Song</th>
                                <th>Singer(s)</th>
                                <th>Musician(s)</th>
                                <th>Writer(s)</th>
                                <th>Start At</th>
                                <th>End At</th>
                                <th>Channel</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            @foreach($matches as $match)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                       {{ $match->song->title }}
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($match->song->singers as $singer)
                                                <li>
                                                    {{ $singer->user->first_name }} {{ $singer->user->last_name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($match->song->musicians as $musician)
                                                <li>
                                                    {{ $musician->user->first_name }} {{ $musician->user->last_name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach($match->song->writers as $writer)
                                                <li>
                                                    {{ $writer->user->first_name }} {{ $writer->user->last_name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $match->start }}</td>
                                    <td>{{ $match->end }}</td>
                                    <td>
                                        {{ $match->channel->name }}
                                    </td>
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
