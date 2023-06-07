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

$('#student-info').DataTable({
    dom: 'Bfrtip',
    lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ],
    buttons: [
        // View Mode
        {   extend: 'colvis',
            text: 'View',
            autoClose: true,
            buttons: [
                {   extend: 'colvisGroup',
                    text: 'Compact',
                    show: [0, 1, 2, 3, 4, 11, 12],
                    hide: [5, 6, 7, 8, 9, 10],
                },
                {   extend: 'colvisGroup',
                    text: 'Subject Details',
                    show: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12],
                    hide: [4],
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
            url :"../../assets/api/admin/student-information/"+view+".inc.php?selectYear="+acadYear, 
            type: "POST",
        // Prevent error form
        error: function(){
            $("#datatable_processing").css("display","none");
        }
    },  
    // Setting column names and bool orderable
    columns: [
        { data: 0, title: "Instructor", orderable: true, visible: true},
        { data: 1, title: "Course", orderable: true, visible: true},
        { data: 2, title: "Section", orderable: true, visible: true},
        { data: 3, title: "Class Code", orderable: true, visible: true},
        { data: 4, title: "Subject", orderable: true, visible: true},
        { data: 5, title: "Subject Code", orderable: true, visible: false},
        { data: 6, title: "Subject Title", orderable: true, visible: false},
        { data: 7, title: "Lecture Hours", orderable: true, visible: false},
        { data: 8, title: "Laboratory Hours", orderable: true, visible: false},
        { data: 9, title: "Credited Units", orderable: true, visible: false},
        { data: 10, title: "Pre-requisite(s)", orderable: true, visible: false},
        { data: 11, title: "Status", orderable: true, visible: true},
        { data: 12, title: "Action", orderable: false, visible: true},
    ],
    // Setting column width
    columnDefs: [
        // { width: '5%', targets: 0 }
    ]
});