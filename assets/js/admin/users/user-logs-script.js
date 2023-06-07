// Table Column Headers
var checkbox = "<input id='selectAll' onclick='select_all()' type='checkbox'>";
var actionBullet = "";
    actionBullet += "<div class='btn-group d-flex justify-content-end'>";
    actionBullet += "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
    actionBullet += "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
    actionBullet += "</button>";
    actionBullet += "<div class='dropdown-menu' id='dropdown-container'>";
    actionBullet += "<button type='button' " +
                    "class='dropdown-item text-center' " +
                    "data-bs-toggle='modal' " +
                    "data-bs-target='#revert_selected_modal' " +
                    "data-bs-modal-title='Revert Action' " +
                    "data-bs-action-revert=''" +
                    "data-bs-date=''" +
                    "onclick='getCheckboxIds()'" +
                    "title='Revert action'>Revert Selected</button>";
    actionBullet += "</div>";
    actionBullet += "</div>";

// Initialize Table
$('#users').DataTable({
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
                        columns: [1, 3, 4, 6, 7, 8, 9, 10]
                }
                },
                // CSV Export Options
                {   extend: 'csv',
                    exportOptions: {
                        columns: [1, 3, 4, 6, 7, 8, 9, 10]
                    }
                },
                // Copy to Clipboard Export Options
                {   extend: 'copy',
                    exportOptions: {
                        columns: [1, 3, 4, 6, 7, 8, 9, 10]
                    }
                },
                // Print Export Options
                {   extend: 'print',
                    //Disable Auto Print
                    autoPrint: false, 
                    exportOptions: {
                        columns: [1, 3, 4, 6, 7, 8, 9, 10]
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
                        columns: [1, 3, 4, 6, 7, 8, 9, 10]
                    }
                },
            ]
        },
        // Hide / Show Columns
        // {   extend: 'colvis',
        //     text: 'Hide Columns',
        //     columns: '1, 2, 3, 4, 5',
        //     autoClose: true,
        // },
        // View Mode
        {   extend: 'colvis',
            text: 'View',
            autoClose: true,
            buttons: [
                {   extend: 'colvisGroup',
                    text: 'Compact',
                    show: [0, 2, 5, 10, 11],
                    hide: [1, 3, 4, 6, 7, 8, 9],
                },
                {   extend: 'colvisGroup',
                    text: 'User Information',
                    show: [0, 3, 4, 5, 10, 11],
                    hide: [1, 2, 6, 7, 8, 9],
                },
                {   extend: 'colvisGroup',
                    text: 'Log Information',
                    show: [0, 2, 6, 7, 8, 9, 10, 11],
                    hide: [1, 3, 4, 5],
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
            url :"../../assets/api/admin/users/user-logs.inc.php?selectUsers", 
            type: "POST",
        // Prevent error form
        error: function(){
            $("#datatable_processing").css("display","none");
        }
    },  
    // Setting column names and bool orderable
    columns: [
        { data: 0, title: checkbox, orderable: false, visible: true},
        { data: 1, title: "Id", orderable: true, visible: false},
        { data: 2, title: "User", orderable: true, visible: true},
        { data: 3, title: "User", orderable: true, visible: false},
        { data: 4, title: "Role", orderable: true, visible: false},
        { data: 5, title: "Action", orderable: true, visible: true},
        { data: 6, title: "Action", orderable: true, visible: false},
        { data: 7, title: "Item Type", orderable: true, visible: false},
        { data: 8, title: "Item", orderable: true, visible: false},
        { data: 9, title: "Details", orderable: true, visible: false},
        { data: 10, title: "Date", orderable: true, visible: true},
        { data: 11, title: actionBullet, orderable: false, visible: true}
    ],
});


