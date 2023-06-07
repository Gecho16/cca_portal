// Initialize Table
var acadYear = document.getElementById("academicYearFull").value;

$('#schedule').DataTable({
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
    buttons: [
        // Excel Export Options
        {   extend: 'excel',
            exportOptions: {
                // columns: [ ':visible:not(:first-child)' ]
                columns: [ ':visible:not(:lt(1)):not(:last-child):not(:nth-last-child(-n+2))' ]
            }
        },
        // CSV Export Options
        {   extend: 'csv',
            exportOptions: {
                columns: [ ':visible:not(:lt(1)):not(:last-child)' ]
            }
        },
        // Copy to Clipboard Export Options
        {   extend: 'copy',
            exportOptions: {
                columns: [ ':visible:not(:lt(1)):not(:last-child)' ]
            }
        },
        // Print Export Options
        {   extend: 'print',
            //Disable Auto Print
            autoPrint: false, 
            exportOptions: {
                columns: [ ':visible:not(:lt(1)):not(:last-child)' ]
            },
            // Custom Styling on Print
            customize: function ( win ) {
                $(win.document.head).append('<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">');

                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( 'font-size', 'inherit' );
            }
        },
        // Hide / Show Columns
        {   extend: 'colvis',
            text: 'Hide Columns',
            columns: '1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 21, 25, 26',
            autoClose: true,
        },
        // View Mode
        {   extend: 'colvis',
            text: 'View Mode',
            autoClose: true,
            buttons: [ 
                {   extend: 'colvisGroup',
                    text: 'Editing View',
                    show: [ 0, 5, 7, 10, 12, 13, 14, 15, 16, 17, 21, 25, 27],
                    hide: [ 1, 2, 3, 4, 6, 8, 9, 11, 18, 19, 20, 22, 23, 24, 26],
                },
                {   extend: 'colvisGroup',
                    text: 'Compact View',
                    show: [ 5, 7, 10, 12, 13, 14, 15, 16, 17, 21, 25],
                    hide: [ 0, 1, 2, 3, 4, 6, 8, 9, 11, 18, 19, 20, 22, 23, 24, 26, 27],
                },
                {   extend: 'colvisGroup',
                    text: 'Full View',
                    show: [ 0, 1, 3, 4, 5, 6, 7, 10, 11, 12, 13, 14, 15, 16, 18, 19, 20, 22, 23, 24, 25, 26, 27],
                    hide: [ 2, 17, 21],
                },
            ],
        },
        // Page length options
        'pageLength',
        ],
        "pageLength": 10,
        "bProcessing": true,
        "serverSide": true,
        // JSON datasource
        "ajax":{
            url :"../assets/api/admin/schedule/schedule.inc.php?selectYear="+acadYear, 
            type: "POST",
        // Prevent error form
        error: function(){
            $("#datatable_processing").css("display","none");
        }
    },
    // Setting column names and bool orderable
    columns: [
        { data: 0, title: "<input id='selectAll' onclick='select_all()' type='checkbox'>", orderable: false, visible: true},
        { data: 1, title: "Id", orderable: true, visible: false},
        { data: 2, title: "Academic Year", orderable: true, visible: false},
        { data: 3, title: "Academic Year", orderable: true, visible: false},
        { data: 4, title: "Semester", orderable: true, visible: false},
        { data: 5, title: "Institute", orderable: true, visible: true},
        { data: 6, title: "Reference Number", orderable: true, visible: false},
        { data: 7, title: "Instructor", orderable: true, visible: true},
        { data: 8, title: "Substitute Reference Number", orderable: true, visible: false},
        { data: 9, title: "Substitute Instructor", orderable: true, visible: false},
        { data: 10, title: "Section", orderable: true, visible: true},
        { data: 11, title: "Class code", orderable: true, visible: false},
        { data: 12, title: "Subject Code", orderable: true, visible: true},
        { data: 13, title: "Subject Title", orderable: true, visible: true},
        { data: 14, title: "Lecture Hours", orderable: true, visible: true},
        { data: 15, title: "Laboratory Hours", orderable: true, visible: true},
        { data: 16, title: "Units", orderable: true, visible: true},
        { data: 17, title: "Synchronous", orderable: true, visible: true},
        { data: 18, title: "Synchronous Day", orderable: true, visible: false},
        { data: 19, title: "Synchronous Time", orderable: true, visible: false},
        { data: 20, title: "Synchronous Room", orderable: true, visible: false},
        { data: 21, title: "Asynchronous", orderable: true, visible: true},
        { data: 22, title: "Asynchronous Day", orderable: true, visible: false},
        { data: 23, title: "Asynchronous Time", orderable: true, visible: false},
        { data: 24, title: "Asynchronous Room", orderable: true, visible: false},
        { data: 25, title: "Status", orderable: true, visible: true},
        { data: 26, title: "Remarks", orderable: false, visible: true},
        { data: 27, title: "", orderable: false, visible: true}
    ],
    // Setting column width
    columnDefs: [
        // { width: '5%', targets: 0 }
    ]
});