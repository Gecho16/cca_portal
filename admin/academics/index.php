<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

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
                    <option value='academic-year'>Academic Year</option>
                    <option value='institutes'>Institutes</option>
                    <option value='courses'>Courses</option>
                    <option value='subjects'>Subjects</option>
                    <option value='sections'>Sections</option>
                    <option value='faculty'>Faculty</option>
                    <option value='rooms'>Rooms</option>
                </select>
                <select class="form-select me-2" id="academicYearFull">

                    <?php

                    $sql = "SELECT * FROM academic_years ORDER BY CONCAT(year, ' ', semester) DESC";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $academicYear = $row["year"];
                            $semester = $row["semester"];

                            $semesterFull = $semester;

                            if ($semester != "Summer") {
                                $semesterFull .= " Semester";
                            }

                            echo "<option value='" . $row["id"] . "'>A.Y. " . $academicYear . ", " . $semesterFull . "</option>";
                        }
                    } else {
                        echo "<option value=''>No Academic Years available</option>";
                    }

                    if (mysqli_num_rows($result) > 1) {
                        echo "<option value='All'>All</option>";
                    }

                    ?>
                    
                </select>
            </div>	
        </div>
        <div class="d-flex justify-content-end">
            <div class="d-flex mx-2">
                <a class='btn bg-white border border-dark d-flex' href='#'>
                    Add Entry
                </a>
            </div>
            <div class="d-flex mx-2">
                <a class="btn bg-white border border-dark d-flexx justify-content-center align-items-center" href="#">
                    <i class="fa-solid fa-upload me-2"></i>
                    Import
                </a>
            </div>
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

<!-- ENABLE MODAL -->
<div class="modal fade" id="activateModal" tabindex="-1" aria-labelledby="activateModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="activateModalLabel">Activate Academic Year</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to activete <strong class="name"></strong>?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<a href="#" class="btn btn-success href">Confirm</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	let activateModal = document.getElementById("activateModal");

	activateModal.addEventListener("show.bs.modal", function (event) {
		let button = event.relatedTarget;

		let name = button.getAttribute("data-bs-name");
		let modalBodyName = activateModal.querySelector(".modal-body .name");
		modalBodyName.innerHTML = name;

		let href = button.getAttribute("data-bs-href");
		let modalFooterHref = activateModal.querySelector(".modal-footer .href");
		modalFooterHref.href = href;
	});
</script>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<!-- TABLE SCRIPT -->
<script>
function academicTable(){
    view = document.getElementById("tableSelect").value;
    $.getScript('../../assets/js/admin/academics/'+ view +'-table-script.js');
}

academicTable()

// Refresh table when view value is changed
$( document ).ready(function() {
    // Refresh table when view value is changed
    $('#tableSelect').on('change', function() {
        view = document.getElementById("tableSelect").value;
        var table = $('#academics').DataTable();
        var container = $('#academics');

        // console.log(view);

        if ($.fn.DataTable.isDataTable('#academics')) {
            table.destroy();
            container.remove();
        }

        var parentContainer = $('#academics-container');
        var newTable = $('<table class="table table-striped table-sm w-100" id="academics"></table>');
        parentContainer.append(newTable);

        academicTable()
        // Set page title depending of selected table
        if(view == 'academic-year'){
            document.getElementById("page-title").innerHTML = 'Academic Years';
        }else if(view == 'institutes'){
            document.getElementById("page-title").innerHTML = 'Institutes';
        }else if(view == 'courses'){
            document.getElementById("page-title").innerHTML = 'Courses';
        }else if(view == 'subjects'){
            document.getElementById("page-title").innerHTML = 'Subjects';
        }else if(view == 'sections'){
            document.getElementById("page-title").innerHTML = 'Sections';
        }else if(view == 'faculty'){
            document.getElementById("page-title").innerHTML = 'Faculty';
        }else if(view == 'rooms'){
            document.getElementById("page-title").innerHTML = 'Rooms';
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