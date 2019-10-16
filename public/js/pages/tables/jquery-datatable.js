$(function () {

    console.log('this is js');

    $('.js-basic-example').DataTable({
        responsive: true
    });

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy',
            'csv',
            'excel',
            {
                extend: 'pdfHtml5',
                title: formatDate()+' Report',
                orientation: 'landscape',
                pageSize: 'A2'
            },
            'print'
        ],
        "order": [[ 0, "desc" ]]
    });
});
