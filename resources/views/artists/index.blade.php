@extends('layouts.master')

@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
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

            <div class="card">
                <div class="body">
                    <a href="{{ route('artists.create') }}" class="btn bg-deep-orange waves-effect btn-lg">
                        <i class="material-icons">person_add</i> Create New
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
                        ARTISTS TABLE
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Membership Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>NIC</th>
                                <th>Date of Birth</th>
                                <th title="Mobile"><i class="material-icons">smartphone</i></th>
                                <th title="Land Phone"><i class="material-icons">phone</i></th>
                                <th>Address</th>
                                <th>Type</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Membership Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>NIC</th>
                                <th>Date of Birth</th>
                                <th title="Mobile"><i class="material-icons">smartphone</i></th>
                                <th title="Land Phone"><i class="material-icons">phone</i></th>
                                <th>Address</th>
                                <th>Type</th>
                                <th>Added By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>

                                @foreach($artists as $artist)
                                    <tr>
                                        <td>{{ $artist->id }}</td>
                                        <td>{{ $artist->membership_number }}</td>
                                        <td>{{ $artist->user->first_name }}</td>
                                        <td>{{ $artist->user->last_name }}</td>
                                        <td>{{ $artist->user->email }}</td>
                                        <td>{{ $artist->user->nic }}</td>
                                        <td>{{ $artist->user->dob }}</td>
                                        <td>{{ $artist->user->mobile }}</td>
                                        <td>{{ $artist->user->land }}</td>
                                        <td>{{ $artist->user->address }}</td>
                                        <td>{{ $artist->getType() }}</td>
                                        <td>{{ $artist->user->added_by }}</td>
                                        <td>{{ $artist->getStatus() }}</td>
                                        <td>
                                            <span>
                                                <a href="{{ route('artists.edit', $artist->id) }}" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button data-id="{{ $artist->id }}" href="{{ route('artists.destroy', $artist->id) }}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float btn_delete" title="Delete">
                                                <i class="material-icons">delete</i>
                                            </button>
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

    <script>
        $(function () {
           $(document).on('click', '.btn_delete', function (e) {
               e.preventDefault();
               let id = $(this).attr('data-id');
               Swal.fire({
                   title: 'Are you sure you want to delete this?',
                   text: "You won't be able to revert this!",
                   type: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Yes, delete it!'
               }).then((result) => {
                   if (result.value) {

                       $.ajax({
                           url: "/artists/"+id,
                           method: "POST",
                           data:{
                               _method: "DELETE"
                           },
                           success: function (data) {
                               console.log(data);
                               window.document.location.reload();
                           },
                           error: function (data) {
                               console.log(data);
                           }

                       });


                   }
               });
           })
        });
    </script>

@endsection
