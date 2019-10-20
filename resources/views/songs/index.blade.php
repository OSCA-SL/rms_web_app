@extends('layouts.master')

@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endsection

@section('content')
    <div class="block-header">
        <h2>SONGS</h2>
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
                    <a href="{{ route('songs.create') }}" class="btn bg-deep-orange waves-effect btn-lg">
                        <i class="material-icons">add</i> Add New Song
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
                        SONGS
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
                        <table id="songs-table" class="table table-bordered table-striped table-hover dataTable js-exportable dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Song File</th>
                                <th>Remote File</th>
                                <th>Released At</th>
                                <th>Singers</th>
                                <th>Music Directors</th>
                                <th>Song Writers</th>
                                <th>Producers</th>
                                <th>Status</th>
                                <th>Added By</th>
                                <th>Approved By</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Song File</th>
                                <th>Remote File</th>
                                <th>Released At</th>
                                <th>Singers</th>
                                <th>Music Directors</th>
                                <th>Song Writers</th>
                                <th>Producers</th>
                                <th>Status</th>
                                <th>Added By</th>
                                <th>Approved By</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            {{--@foreach($songs as $song)
                                <tr>

                                    <td>{{ $song->id }}</td>
                                    <td>{{ $song->title }}</td>
                                    <td>
                                        <audio controls preload="none">
                                            <source src="{{ $song->file_path }}" type="audio/mpeg">
                                        </audio>

                                    </td>
                                    <td>
                                        <audio controls preload="none">
                                                <source src="{{ $song->remote_file_path }}" type="audio/mpeg">
                                        </audio>
                                    </td>
                                    <td>{{ $song->released_at }}</td>

                                    <td>
                                        <ul>
                                            @foreach($song->singers() as $singer)
                                                <li>
                                                    <a href="{{ route('users.show', $singer->user->id) }}">
                                                        {{ $singer->user->first_name }} {{ $singer->user->last_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>
                                        <ul>
                                            @foreach($song->musicians() as $musician)
                                                <li>
                                                    <a href="{{ route('users.show', $musician->user->id) }}">
                                                        {{ $musician->user->first_name }} {{ $musician->user->last_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>
                                        <ul>
                                            @foreach($song->writers() as $writer)
                                                <li>
                                                    <a href="{{ route('users.show', $writer->user->id) }}">
                                                        {{ $writer->user->first_name }} {{ $writer->user->last_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>
                                        <ul>
                                            @foreach($song->producers() as $producer)
                                                <li>
                                                    <a href="{{ route('users.show', $writer->user->id) }}">
                                                        {{ $producer->user->first_name }} {{ $producer->user->last_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>


--}}{{--                                    <td>{{ $song->getStatus() }}</td>--}}{{--
                                    <td>
                                        <a href="{{ route('users.show', $song->addedUser->id) }}">
                                            {{ $song->addedUser->first_name }} {{ $song->addedUser->last_name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', $song->approvedUser->id) }}">
                                            {{ $song->approvedUser->first_name }} {{ $song->approvedUser->last_name }}
                                        </a>
                                    </td>

                                    <td>
                                            <span>
                                                <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a href="{{ route('songs.destroy', $song->id) }}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            </span>

                                    </td>
                                </tr>
                            @endforeach--}}

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

    <script>

        $(function () {



            // console.log('this is js');

            $('.js-basic-example').DataTable({
                responsive: true
            });

            //Exportable table
            let table = $('.js-exportable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                lengthMenu: [
                    [ 10, 25, 50,
                        100, 200, 500, 1000, 1500, 2000,
                        -1 ],
                    [ '10 rows', '25 rows', '50 rows',
                        '100 rows', '200 rows', '500 rows', '1000 rows', '1500 rows', '2000 rows',
                        'Show all' ]
                ],
                buttons: {
                    buttons: [
                        {
                            extend: 'copy',
                            className: 'btn btn-info'
                        },
                        {
                            extend: 'csv',
                            className: 'btn btn-info'
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-info'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: formatDate()+' Report',
                            orientation: 'landscape',
                            pageSize: 'A2',
                            className: 'btn btn-info'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-info'
                        },
                        {
                            extend: 'pageLength',
                            className: 'btn btn-info'
                        }

                    ],
                    dom: {
                        button: {
                            className: 'btn ml-2'
                        }
                    }
                },
                language: {
                    processing: '' +
                        '<div class="preloader pl-size-lg"> ' +
                        '<div class="spinner-layer pl-teal"> ' +
                        '<div class="circle-clipper left"> ' +
                        '<div class="circle"></div> ' +
                        '</div> ' +
                        '<div class="circle-clipper right"> ' +
                        '<div class="circle"></div> ' +
                        '</div> ' +
                        '</div> ' +
                        '</div>' +
                        ''
                },
                "order": [[ 0, "desc" ]],
                processing: true,


                serverSide: true,
                ajax: '{!! route('getSongs') !!}',
                columns: [
                    { data: 'id', name: 'songs.id'/*, render: function (data, type, full) {
                        console.log(data);
                        console.log("type: "+type);
                        console.log("full: ");
                        console.log(full);
                        return "<strong>"+data+"</strong>";
                            // return $("<div/>").html("<strong>"+data+"</strong>");
                        }*/ },
                    { data: 'title', name: 'songs.title' },
                    { data: 'file_path', name: 'songs.file_path', sortable: false, render:function (data, type, full) {
                            return '<audio controls preload="none">\n' +
                                '<source src="{{ url('') }}/'+data+'" type="audio/mpeg">\n' +
                                '</audio>';
                        }  },
                    { data: 'remote_file_path', name: 'songs.remote_file_path', sortable: false, render:function (data, type, full) {
                            return '<audio controls preload="none">\n' +
                                '<source src="'+data+'" type="audio/mpeg">\n' +
                                '</audio>';
                        }  },
                    { data: 'released_at', name: 'songs.released_at' },

                    { data: 'singers', name: 'songs.singers', sortable: false, searchable: false, render:function (data, type, full) {
                            let singers = "<ul>";
                            $.each(data, function (k, value) {
                                singers += "<li>" +
                                    "<a href='/users/"+value['user']['id']+"'>" +
                                    value['user']['first_name']+" "+value['user']['last_name'] +
                                    "</a>"+
                                    "</li>";
                            });
                            singers += "</ul>";

                            return singers;
                        }
                    },

                    { data: 'musicians', name: 'songs.musicians', sortable: false, searchable: false, render:function (data, type, full) {
                            let artists = "<ul>";
                            $.each(data, function (k, value) {
                                artists += "<li>" +
                                    "<a href='/users/"+value['user']['id']+"'>" +
                                    value['user']['first_name']+" "+value['user']['last_name'] +
                                    "</a>"+
                                    "</li>";
                            });
                            artists += "</ul>";

                            return artists;
                        }
                    },

                    { data: 'writers', name: 'songs.writers', sortable: false, searchable: false, render:function (data, type, full) {
                            let artists = "<ul>";
                            $.each(data, function (k, value) {
                                artists += "<li>" +
                                    "<a href='/users/"+value['user']['id']+"'>" +
                                    value['user']['first_name']+" "+value['user']['last_name'] +
                                    "</a>"+
                                    "</li>";
                            });
                            artists += "</ul>";

                            return artists;
                        }
                    },

                    { data: 'producers', name: 'songs.producers', sortable: false, searchable: false, render:function (data, type, full) {
                            let artists = "<ul>";
                            $.each(data, function (k, value) {
                                artists += "<li>" +
                                    "<a href='/users/"+value['user']['id']+"'>" +
                                    value['user']['first_name']+" "+value['user']['last_name'] +
                                    "</a>"+
                                    "</li>";
                            });
                            artists += "</ul>";

                            return artists;
                        }
                    },

                    { data: 'song_status', name: 'songs.song_status', sortable: false, searchable: false, render:function (data, type, full) {
                            let status_html = "";
                            if (full['hash_status'] < 3){
                                status_html = "<a href='/song/rehash/"+full['id']+"' class='btn btn-outline-danger'>" +
                                    "<label class='label label-danger'>" +
                                    data +
                                    "</label>" +
                                    "</a>";
                            }
                            else {
                                status_html = "<label class='label label-success'>"+data+"</label>";
                            }
                            return status_html;
                        }  },

                    { data: 'added_user', name: 'songs.added_user', sortable: false, searchable: false, render:function (data, type, full) {
                            return '<a href="/users/'+data['id']+'">'+
                                data['first_name']+" "+data['last_name']+
                                '</a>';
                        }  },

                    { data: 'approved_user', name: 'songs.approved_user', sortable: false, searchable: false, render:function (data, type, full) {
                            return '<a href="/users/'+data['id']+'">'+
                                data['first_name']+" "+data['last_name']+
                                '</a>';
                        }  },

                    { data: 'id', name: 'songs.id', sortable: false, searchable: false, render:function (data, type, full) {
                        let html = '<span>\n' +
                            '<a href="/songs/'+data+'/edit" data-id="'+data+'" class="btn btn-warning btn-circle waves-effect waves-circle waves-float btn-edit" title="Edit">' +
                            '<i class="material-icons">edit</i>\n' +
                            '</a>\n' +
                            '<button href="songs/'+data+'/delete" data-id="'+data+'" class="btn btn-danger btn-circle waves-effect waves-circle waves-float btn-delete" title="Delete">\n' +
                            '<i class="material-icons">delete</i>\n' +
                            '</button>\n' +
                            '</span>';
                            return html;
                        }  },


                ]
            });

            $('.js-exportable thead th').each( function () {
                if ($(this).hasClass('sorting_disabled') === false){
                    var title = $(this).text();
                    $(this).prepend( '<div class="search-col"><input class="form-control" type="text" placeholder="Search '+title+'" /></div>' );
                }

            } );

            table.columns().every( function () {
                let that = this;

                $( 'input', this.header() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );


            } );

            $('.search-col').on('click', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
            });

            $(document).on('click', '.btn-delete', function (e) {
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
                            url: "/songs/"+id,
                            method: "POST",
                            data:{
                                _method: "DELETE"
                            },
                            success: function (data) {
                                console.log(data);
                                window.document.location.reload();
                                /*Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );*/
                            },
                            error: function (data) {
                                console.log(data);
                            }

                        });


                    }
                });
            });


        });
    </script>

@endsection
