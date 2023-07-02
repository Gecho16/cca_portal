// Initialize Table
$('#academics').DataTable({
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
    buttons: [
        {
            extend: 'collection',
            text: 'Export',
            buttons: [
                // Excel Export Options
                {   extend: 'excel',
                    exportOptions: {
                        columns: [2, 3, 4]
                }
                },
                // CSV Export Options
                {   extend: 'csv',
                    exportOptions: {
                        columns: [2, 3, 4]
                    }
                },
                // Copy to Clipboard Export Options
                {   extend: 'copy',
                    exportOptions: {
                        columns: [2, 3, 4]
                    }
                },
                // Print Export Options
                {   extend: 'print',
                    //Disable Auto Print
                    autoPrint: false, 
                    exportOptions: {
                        columns: [2, 3, 4]
                    },
                    // Custom Styling on Print
                    customize: function ( win ) {
                        $(win.document.head).append('<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">');

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                },
                // Copy to Clipboard Export Options
                {   extend: 'pdf',
                    exportOptions: {
                        columns: [2, 3, 4]
                    }
                },
            ]
        },
        // View Mode
        {   extend: 'colvis',
            text: 'View',
            autoClose: true,
            buttons: [
                {   extend: 'colvisGroup',
                    text: 'Compact',
                    show: [0, 1, 4, 5],
                    hide: [2, 3],
                },
                {   extend: 'colvisGroup',
                    text: 'Full View',
                    show: [0, 2, 3, 4, 5],
                    hide: [1],
                },
            ],
        },
        // Page length options
        'pageLength',
    ],
        "bProcessing": true,
        "serverSide": true,
        // JSON datasource
        "ajax":{
            url :"../../assets/api/admin/academics/academic-year.inc.php?selectYear", 
            type: "POST",
        // Prevent error form
        error: function(){
            $("#datatable_processing").css("display","none");
        }
    },
    // Setting column names and bool orderable
    columns: [
        // Checkbox column
        { data: 0, title: "Id", orderable: true, visible: true},
        { data: 1, title: "Academic Year", orderable: true, visible: true },
        { data: 2, title: "Year", orderable: true, visible: false },
        { data: 3, title: "Semester", orderable: true, visible: false },
        { data: 4, title: "Status", orderable: true, visible: true },
        { data: 5, title: "", orderable: false, visible: true },
    ],
    // Setting column width
    columnDefs: [
        // { width: '5%', targets: 0 },
        // { width: '85%', targets: 1 },
        // { width: '10%', targets: 2 },
        // { width: '75%', targets: 3 },
        // { width: '5%', targets: 4 },
        // { width: '5%', targets: 5 },
    ],
});