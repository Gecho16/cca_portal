// Table Column Headers
var checkbox = "<input id='selectAll' onclick='select_all()' type='checkbox'>";
var actionBullet = "";
    actionBullet += "<div class='btn-group d-flex justify-content-end'>";
    actionBullet += "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
    actionBullet += "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
    actionBullet += "</button>";
    actionBullet += "<div class='dropdown-menu' id='dropdown-container'>";
    actionBullet += "<button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#deleteSelectedModal' data-bs-name='' data-bs-href='../../../assets/includes/admin/users/user.inc.php?deleteSelectedUser' title='deleteSelected'>Delete Selected</button>";
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
                        columns: [1, 4, 5, 6, 7, 9, 10 ,11, 12, 13, 14]
                }
                },
                // CSV Export Options
                {   extend: 'csv',
                    exportOptions: {
                        columns: [1, 4, 5, 6, 7, 9, 10 ,11, 12, 13, 14]
                    }
                },
                // Copy to Clipboard Export Options
                {   extend: 'copy',
                    exportOptions: {
                        columns: [1, 4, 5, 6, 7, 9, 10 ,11, 12, 13, 14]
                    }
                },
                // Print Export Options
                {   extend: 'print',
                    //Disable Auto Print
                    autoPrint: false, 
                    exportOptions: {
                        columns: [1, 4, 5, 6, 7, 9, 10 ,11, 12, 13, 14]
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
                        columns: [1, 4, 5, 6, 7, 9, 10 ,11, 12, 13, 14]
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
                    show: [0, 2, 3, 8, 11, 12, 13, 14, 15],
                    hide: [1, 4, 5, 6, 7, 9, 10],
                },
                {   extend: 'colvisGroup',
                    text: 'Personal Information',
                    show: [0, 2, 4, 5, 6, 7, 8, 11, 12, 13, 14, 15],
                    hide: [1, 3, 9, 10],
                },
                {   extend: 'colvisGroup',
                    text: 'Account Information',
                    show: [0, 2, 3, 8, 10, 11, 12, 13, 14, 15],
                    hide: [1, 4, 5, 6, 7, 9],
                }
            ],
        },
        // Page length options
        'pageLength',
    ],
    "bProcessing": true,
    "serverSide": true,
    // JSON datasource
    "ajax":{
        url :"../../assets/api/admin/users/user.inc.php?selectUsers", 
        type: "POST",
    // Prevent error form
    error: function(){
        $("#datatable_processing").css("display","none");
        }
    },
    // Setting column names and bool orderable
    columns: [
        { data: 0, title: checkbox, orderable: false, visible: true  },
        { data: 1, title: 'Id', orderable: true, visible: false },
        { data: 2, title: 'Avatar', orderable: false, visible: true },
        { data: 3, title: 'Fullname', orderable: true, visible: true },
        { data: 4, title: 'Lastname', orderable: true, visible: false },
        { data: 5, title: 'Firstname', orderable: true, visible: false },
        { data: 6, title: 'Middlename', orderable: true, visible: false },
        { data: 7, title: 'Suffix', orderable: true, visible: false },
        { data: 8, title: 'Institute', orderable: true, visible: true },
        { data: 9, title: 'Institute', orderable: true, visible: false },
        { data: 10, title: 'Email', orderable: true, visible: false },
        { data: 11, title: 'Username', orderable: true, visible: true },
        { data: 12, title: 'Role', orderable: true, visible: true },
        { data: 13, title: 'Last Login', orderable: true, visible: true },
        { data: 14, title: 'Status', orderable: true, visible: true },
        { data: 15, title: actionBullet, orderable: false }
    ],
    // Setting column width
    columnDefs: [
        // { width: '5%', targets: 0 },
        // { width: '5%', targets: 1 },
        // { width: '5%', targets: 2 },
        // { width: '5%', targets: 3 },
        // { width: '20%', targets: 4 },
        // { width: '25%', targets: 5 },
        // { width: '5%', targets: 6 },
        // { width: '5%', targets: 7 },
        // { width: '5%', targets: 8 },
    ],
});