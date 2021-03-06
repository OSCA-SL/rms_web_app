@extends('layouts.master')

@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endsection

@section('content')
    <div class="block-header">
        <h2>Channel Fees</h2>
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
                    <a href="{{ route('fees.create') }}" class="btn bg-deep-orange waves-effect btn-lg">
                        <i class="material-icons">playlist_add</i> Create New
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
                        Channel Fee List
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
                                <th>Channel</th>
                                <th>Fee</th>
                                <th>Effective From</th>
                                <th>Added By</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Channel</th>
                                <th>Fee</th>
                                <th>Effective From</th>
                                <th>Added By</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            @foreach($fees as $fee)
                                <tr>
                                    <td>{{ $fee->id }}</td>
                                    <td>{{ $fee->channel->name }}</td>
                                    <td>{{ $fee->fee }}</td>
                                    <td>{{ $fee->effective_from }}</td>
                                    <td>{{ $fee->addedUser->first_name }} {{ $fee->addedUser->last_name }}</td>
                                    <td>{{ $fee->created_at }}</td>
                                    <td>{{ $fee->updated_at }}</td>
                                    <td>
                                            <span>
                                                <a href="{{ route('fees.edit', $fee->id) }}" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a href="{{ route('fees.destroy', $fee->id) }}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            </span>

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
