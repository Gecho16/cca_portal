<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get faculty
if(isset($_GET["table"])){
    $table = sanitize($_GET["table"]);
}else{
    $table = "academic-year";
}

?>

<!-- BODY HEADERS -->
<div class="d-flex justify-content-between align-items-center mb-3 d-print-none">
    <div class="d-flex flex-column align-items-start w-50">
        <h1 id="page-title" class="h1">Academic Years</h1>
    </div>
    <div class="d-flex flex-column w-50">
        <div class="d-flex justify-content-end align-items-center my-2">
            <div class="d-flex align-items-center">
                <select class="form-select me-2" id="tableSelect">
                    <option value='academic-year' <?= ($table === "academic-year") ? 'selected' : '';?>r'>Academic Year</option>
                    <option value='institutes' <?= ($table === "institutes") ? 'selected' : '';?>>Institutes</option>
                    <option value='courses' <?= ($table === "courses") ? 'selected' : '';?>>Courses</option>
                    <option value='subjects' <?= ($table === "subjects") ? 'selected' : '';?>>Subjects</option>
                    <option value='sections' <?= ($table === "sections") ? 'selected' : '';?>>Sections</option>
                    <option value='faculty' <?= ($table === "faculty") ? 'selected' : '';?>>Faculty</option>
                    <option value='rooms' <?= ($table === "rooms") ? 'selected' : '';?>>Rooms</option>
                </select>
            </div>	
        </div>
        <div>
            <div class="d-flex justify-content-end w-100">
                <div class="d-none mx-2 input-buttons" id="academic-year-input-buttons">
                    <a class='btn bg-white border border-dark d-flex  mx-2' href='academic-year/add'>
                        Add Year
                    </a>
                </div>
                <div class="d-none mx-2 input-buttons" id="institute-input-buttons">
                    <a class='btn bg-white border border-dark d-flex  mx-2' href='institute/add'>
                        Add Institute
                    </a>
                </div>
                <div class="d-none mx-2 input-buttons" id="course-input-buttons">
                    <a class='btn bg-white border border-dark d-flex  mx-2' href='course/add'>
                        Add Course
                    </a>
                </div>
                <div class="d-none mx-2 input-buttons" id="section-input-buttons">
                    <a class='btn bg-white border border-dark d-flex  mx-2' href='section/add'>
                        Add Section
                    </a>
                </div>
                <div class="d-none mx-2 input-buttons" id="subject-input-buttons">
                    <a class='btn bg-white border border-dark d-flex  mx-2' href='subject/add'>
                        Add Subject
                    </a>
                </div>
                <div class="d-none mx-2 input-buttons" id="faculty-input-buttons">
                    <a class='btn bg-white border border-dark d-flex  mx-2' href='faculty/add'>
                        Add Faculty
                    </a>
                </div>
                <div class="d-none mx-2 input-buttons" id="room-input-buttons">
                    <a class='btn bg-white border border-dark d-flex  mx-2' href='room/add'>
                        Add Room
                    </a>
                </div>
            </div>
            
            <!-- <div class="d-flex mx-2">
                <a class="btn bg-white border border-dark d-flexx justify-content-center align-items-center" href="#">
                    <i class="fa-solid fa-upload me-2"></i>
                    Import
                </a>
            </div> -->
        </div>
    </div>
</div>

<!-- TABLE -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive" id="academics-container">
            <table class="table table-striped table-sm w-100" id="academics"></table>
        </div>
    </div>
</div>

<?php

include $baseUrl . "assets/modals/admin/academics/academics_modals.php";
include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<!-- TABLE SCRIPT -->
<script>
function academicTable(){
    view = document.getElementById("tableSelect").value;
    $.getScript('../../assets/js/admin/academics/'+ view +'-table-script.js');

    // Set page title depending of selected table
    if(view == 'academic-year'){
        document.getElementById("page-title").innerHTML = 'Academic Years';
        document.getElementById("academic-year-input-buttons").classList.remove('d-none');
        document.getElementById("academic-year-input-buttons").classList.add('d-flex');
    }else if(view == 'institutes'){
        document.getElementById("page-title").innerHTML = 'Institutes';
        document.getElementById("institute-input-buttons").classList.remove('d-none');
        document.getElementById("institute-input-buttons").classList.add('d-flex');
    }else if(view == 'courses'){
        document.getElementById("page-title").innerHTML = 'Courses';
        document.getElementById("course-input-buttons").classList.remove('d-none');
        document.getElementById("course-input-buttons").classList.add('d-flex');
    }else if(view == 'subjects'){
        document.getElementById("page-title").innerHTML = 'Subjects';
        document.getElementById("subject-input-buttons").classList.remove('d-none');
        document.getElementById("subject-input-buttons").classList.add('d-flex');
    }else if(view == 'sections'){
        document.getElementById("page-title").innerHTML = 'Sections';
        document.getElementById("section-input-buttons").classList.remove('d-none');
        document.getElementById("section-input-buttons").classList.add('d-flex');
    }else if(view == 'faculty'){
        document.getElementById("page-title").innerHTML = 'Faculty';
        document.getElementById("faculty-input-buttons").classList.remove('d-none');
        document.getElementById("faculty-input-buttons").classList.add('d-flex');
    }else if(view == 'rooms'){
        document.getElementById("page-title").innerHTML = 'Rooms';
        document.getElementById("room-input-buttons").classList.remove('d-none');
        document.getElementById("room-input-buttons").classList.add('d-flex');
    }
}


// Refresh table when view value is changed
$( document ).ready(function() {
    academicTable()
    // Refresh table when view value is changed
    $('#tableSelect').on('change', function() {
        view = document.getElementById("tableSelect").value;
        // var table = $('#academics').DataTable();
        // var container = $('#academics');

        // // console.log(view);

        // if ($.fn.DataTable.isDataTable('#academics')) {
        //     table.destroy();
        //     container.remove();
        // }

        // var parentContainer = $('#academics-container');
        // var newTable = $('<table class="table table-striped table-sm w-100" id="academics"></table>');
        // parentContainer.append(newTable);

        // academicTable()

        // var input_buttons = document.querySelectorAll('.input-buttons');

        // for (var i = 0; i < input_buttons.length; i++) {
        //     input_buttons[i].classList.remove('d-flex');
        //     input_buttons[i].classList.add('d-none');
        // }

        // Set page title depending of selected table
        if(view == 'academic-year'){
            window.location.href = "?table=academic-year";
            // document.getElementById("page-title").innerHTML = 'Academic Years';
            // document.getElementById("academic-year-input-buttons").classList.remove('d-none');
            // document.getElementById("academic-year-input-buttons").classList.add('d-flex');
        }else if(view == 'institutes'){
            window.location.href = "?table=institutes";
            // document.getElementById("page-title").innerHTML = 'Institutes';
            // document.getElementById("institute-input-buttons").classList.remove('d-none');
            // document.getElementById("institute-input-buttons").classList.add('d-flex');
        }else if(view == 'courses'){
            window.location.href = "?table=courses";
            // document.getElementById("page-title").innerHTML = 'Courses';
            // document.getElementById("course-input-buttons").classList.remove('d-none');
            // document.getElementById("course-input-buttons").classList.add('d-flex');
        }else if(view == 'subjects'){
            window.location.href = "?table=subjects";
            // document.getElementById("page-title").innerHTML = 'Subjects';
            // document.getElementById("subject-input-buttons").classList.remove('d-none');
            // document.getElementById("subject-input-buttons").classList.add('d-flex');
        }else if(view == 'sections'){
            window.location.href = "?table=sections";
            // document.getElementById("page-title").innerHTML = 'Sections';
            // document.getElementById("section-input-buttons").classList.remove('d-none');
            // document.getElementById("section-input-buttons").classList.add('d-flex');
        }else if(view == 'faculty'){
            window.location.href = "?table=faculty";
            // document.getElementById("page-title").innerHTML = 'Faculty';
            // document.getElementById("faculty-input-buttons").classList.remove('d-none');
            // document.getElementById("faculty-input-buttons").classList.add('d-flex');
        }else if(view == 'rooms'){
            window.location.href = "?table=rooms";
            // document.getElementById("page-title").innerHTML = 'Rooms';
            // document.getElementById("room-input-buttons").classList.remove('d-none');
            // document.getElementById("room-input-buttons").classList.add('d-flex');
        }else{
            window.location.href = "?table=academic-year";
        }
    });
});

// Select all checkbox
function select_all(){
	if(jQuery('#selectAll').prop("checked")){
		jQuery('input[type=checkbox]').each(function(){
			jQuery('#'+this.id).prop('checked',true);
            // console.log(this.id);
		});
	}else{
		jQuery('input[type=checkbox]').each(function(){
			jQuery('#'+this.id).prop('checked',false);
            // console.log(this.id);
		});
	}
}
</script>