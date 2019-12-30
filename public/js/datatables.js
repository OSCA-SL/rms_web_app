$(function () {

    console.log('this is js');

    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    let table = $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
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
                }

            ],
            dom: {
                button: {
                    className: 'btn'
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
        "order": [[ 0, "desc" ]]
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

});
