// Initialize Table
var acadYear = document.getElementById("academicYearFull").value;
var view = document.getElementById("tableSelect").value;

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

$('#reports').DataTable({
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
                        columns: [1, 2]
                }
                },
                // CSV Export Options
                {   extend: 'csv',
                    exportOptions: {
                        columns: [1, 2]
                    }
                },
                // Copy to Clipboard Export Options
                {   extend: 'copy',
                    exportOptions: {
                        columns: [1, 2]
                    }
                },
                // Print Export Options
                {   extend: 'print',
                    //Disable Auto Print
                    autoPrint: false, 
                    exportOptions: {
                        columns: [1, 2]
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
                        columns: [1, 2]
                    }
                },
            ]
        },
        // Page length options
        'pageLength',
        ],
        "pageLength": 10,
        "bProcessing": true,
        "serverSide": true,
        // JSON datasource
        "ajax":{
            url :"../../assets/api/admin/reports/"+view+".inc.php?selectYear="+acadYear, 
            type: "POST",
        // Prevent error form
        error: function(){
            $("#datatable_processing").css("display","none");
        }
    },  
    // Setting column names and bool orderable
    columns: [
        { data: 0, title: checkbox, orderable: false, visible: true},
        { data: 1, title: "Id", orderable: true, visible: true},
        { data: 2, title: "Faculty", orderable: true, visible: true},
        { data: 3, title: "Reference Number", orderable: true, visible: true},
        { data: 4, title: "VPAA", orderable: true, visible: true},
        { data: 5, title: "Dean", orderable: true, visible: true},
        { data: 6, title: "Coordinator", orderable: true, visible: true},
        { data: 7, title: "Student", orderable: true, visible: true},
        { data: 8, title: "Peer", orderable: true, visible: true},
        { data: 9, title: "Self", orderable: true, visible: true},
        { data: 10, title: "Overall", orderable: true, visible: true},
        { data: 11, title: "Remarks", orderable: true, visible: true},
        { data: 12, title: "Academic Year", orderable: true, visible: true},
        { data: 13, title: "View", orderable: false, visible: true},
        { data: 14, title: actionBullet, orderable: false, visible: true},
    ],
    // Setting column width
    columnDefs: [
        // { width: '5%', targets: 0 }
    ]
});