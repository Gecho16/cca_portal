// Initialize Variables
var acadYear = document.getElementById("academicYearFull").value;

// Table Column Headers
var checkbox = "<input id='selectAll' onclick='select_all()' type='checkbox'>";
var actionBullet = "";
    actionBullet += "<div class='btn-group d-flex justify-content-end'>";
    actionBullet += "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
    actionBullet += "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
    actionBullet += "</button>";
    actionBullet += "<div class='dropdown-menu' id='dropdown-container'>";
    actionBullet += "<button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#deleteSelectedModal' data-bs-name='' data-bs-href='../assets/includes/admin/user.inc.php?deleteSelectedUser' title='deleteSelected'>Option (Button)</button>";
    actionBullet += "<a class='dropdown-item' href='' title='edit'>Option (Link)</a>";
    actionBullet += "</div>";
    actionBullet += "</div>";

// Initialize Table
$('#schedule').DataTable({
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
                        // columns: [ ':visible:not(:first-child)' ]
                        columns: [1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 18, 22]
                }
                },
                // CSV Export Options
                {   extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 18, 22]
                    }
                },
                // Copy to Clipboard Export Options
                {   extend: 'copy',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 18, 22]
                    }
                },
                // Print Export Options
                {   extend: 'print',
                    //Disable Auto Print
                    autoPrint: false, 
                    exportOptions: {
                        columns: [1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 18, 22]
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
                        columns: [1, 2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 13, 14, 18, 22]
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
                    show: [0, 3, 4, 5, 11, 12, 13, 14, 18, 19, 20, 21, 22, 23, 24],
                    hide: [1, 2, 6, 7, 8, 9, 10, 15, 16, 17, 19, 20, 21],
                },
                {   extend: 'colvisGroup',
                    text: 'Subject Information',
                    show: [0, 6, 7, 8, 9, 10, 11, 12, 13, 14, 18, 22, 23, 24],
                    hide: [1, 2, 3, 4, 5, 15, 16, 17, 19, 20, 21],
                },
                {   extend: 'colvisGroup',
                    text: 'Synchronous Information',
                    show: [0, 5, 11, 12, 13, 15, 16, 17, 18, 22, 23, 24],
                    hide: [1, 2, 3, 4, 6, 7, 8, 9, 10, 14, 19, 20, 21],
                },
                {   extend: 'colvisGroup',
                    text: 'Asynchronous Information',
                    show: [0, 5, 11, 12, 13, 14, 19, 20, 21, 22, 23, 24],
                    hide: [1, 2, 3, 4, 6, 7, 8, 9, 10, 15, 16, 17, 18],
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
            url :"../../assets/api/admin/schedule/schedule.inc.php?selectYear="+acadYear, 
            type: "POST",
        // Prevent error form
        error: function(){
            $("#datatable_processing").css("display","none");
        }
    },
    // Setting column names and bool orderable
    columns: [
        // Checkbox column
        { data: 0, title: checkbox, orderable: false, visible: true},
        
        // Class Info
        { data: 1, title: "Id", orderable: true, visible: false },
        { data: 2, title: "Semester", orderable: true, visible: false },
        { data: 3, title: "Institute", orderable: true, visible: true },
        { data: 4, title: "Course", orderable: true, visible: true },
        { data: 5, title: "Subject", orderable: true, visible: true },
        { data: 6, title: "Subject Code", orderable: true, visible: false },
        { data: 7, title: "Subject Title", orderable: true, visible: false },
        { data: 8, title: "Lecture Hours", orderable: true, visible: false },
        { data: 9, title: "Laboratory Hours", orderable: true, visible: false },
        { data: 10, title: "Credited Units", orderable: true, visible: false },
        { data: 11, title: "Class Code", orderable: true, visible: true },
        { data: 12, title: "Section", orderable: true, visible: true },
        { data: 13, title: "Instructor", orderable: true, visible: true },

        // Synchronous Info
        { data: 14, title: "Synchronous", orderable: true, visible: true },
        { data: 15, title: "Synchronous Day", orderable: true, visible: false },
        { data: 16, title: "Synchronous Time", orderable: true, visible: false },
        { data: 17, title: "Synchronous Room", orderable: true, visible: false },

        // Asynchronous Info
        { data: 18, title: "Asynchronous", orderable: true, visible: true },
        { data: 19, title: "Asynchronous Day", orderable: true, visible: false },
        { data: 20, title: "Asynchronous Time", orderable: true, visible: false },
        { data: 21, title: "Asynchronous Room", orderable: true, visible: false },

        // Entry Info
        { data: 22, title: "Status", orderable: true, visible: true },
        { data: 23, title: "Remarks", orderable: true, visible: true },

        // Action Command column
        { data: 24, title: actionBullet, orderable: false, visible: true }


    ],
    // Setting column width
    columnDefs: [
        // // Checkbox column
        // { width: '2%', targets: 0 },

        // // Class Info
        // { width: '2%', targets: 1 },
        // { width: '15%', targets: 2 },
        // { width: '5%', targets: 3 },
        // { width: '5%', targets: 4 },
        // { width: '15%', targets: 5 },
        // { width: '5%', targets: 6 },
        // { width: '5%', targets: 7 },
        // { width: '2%', targets: 8 },
        // { width: '2%', targets: 9 },
        // { width: '2%', targets: 10 },
        // { width: '5%', targets: 11 },
        // { width: '5%', targets: 12 },
        // { width: '30%', targets: 13 },

        // // Synchronous Info
        // { width: '10%', targets: 14 },
        // { width: '5%', targets: 15 },
        // { width: '5%', targets: 16 },
        // { width: '5%', targets: 17 },

        // // Asynchronous Info
        // { width: '10%', targets: 18 },
        // { width: '5%', targets: 19 },
        // { width: '5%', targets: 20 },
        // { width: '5%', targets: 21 },

        // // Entry Info
        // { width: '5%', targets: 22 },
        // { width: '2%', targets: 23 },

        // // Action Command column
        // { width: '2%', targets: 24 }
    ]    
});