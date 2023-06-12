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
        // Page length options
        'pageLength',
    ],
        "bProcessing": true,
        "serverSide": true,
        // JSON datasource
        "ajax":{
            url :"../../assets/api/admin/academics/subjects.inc.php?selectYear", 
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
        { data: 1, title: "Id", orderable: true, visible: false},
        { data: 2, title: "Subject Code", orderable: true, visible: true },
        { data: 3, title: "Subject Title", orderable: true, visible: true },
        { data: 4, title: "Lecture Hours", orderable: true, visible: true },
        { data: 5, title: "Laboratory Hours", orderable: true, visible: true },
        { data: 6, title: "Credited Units", orderable: true, visible: true },
        { data: 7, title: "Prerequisite(s)", orderable: true, visible: true },
        { data: 8, title: "Year Level", orderable: true, visible: true },
        { data: 9, title: actionBullet, orderable: false, visible: true }
    ],
    // Setting column width
    columnDefs: [
        // { width: '5%', targets: 0 },
        // { width: '10%', targets: 1 },
        // { width: '40%', targets: 2 },
        // { width: '30%', targets: 3 },
        // { width: '30%', targets: 4 },
        // { width: '5%', targets: 5 },
    ],
});