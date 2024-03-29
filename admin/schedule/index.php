<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "schedule";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<!-- BODY HEADERS -->
<div class="d-flex justify-content-between align-items-center mb-3 d-print-none">
    <div class="d-flex flex-column align-items-start w-50">
        <h1 id="page-title" class="h1">Schedule</h1>
    </div>
    <div class="d-flex flex-column w-50">
        <div class="d-flex justify-content-end align-items-center my-2">
            <div class="d-flex align-items-center">
                <select class="form-select me-2" id="tableSelect">
                    <option value='week'>Weekly View</option>
                    <option value='table'>Table View</option>
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

                <div class='btn-group'>
                    <button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>
                        <i class='fa-solid fa-ellipsis-vertical fa-xl'></i>
                    </button>
                    <div class='dropdown-menu ' id='dropdown-container'>
                        <button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#enableModal' data-bs-name='" . $row["username"] . "' data-bs-href='#' title='enable'>
                            Option (Button)
                        </button>
                        <a class='dropdown-item' href='#' title='edit'>
                            Option (Link)
                        </a>
                    </div>
                </div>

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
        <div class="table-responsive">
            <table class="table table-striped table-sm w-100" id="schedule"></table>
        </div>
    </div>
</div>

<?php

include $baseUrl . "assets/modals/admin/schedule/schedule_modals.php";
include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<!-- TABLE SCRIPT -->
<script>

$( document ).ready(function() {
    // Initialize Table
    $.getScript('../../assets/js/admin/schedule/schedule-table-script.js');

    // Refresh table when academic year value is changed
    $('#academicYearFull').on('change', function() {
        acadYear = document.getElementById("academicYearFull").value;
        var table = $('#schedule').DataTable();
        table.destroy();
        // console.log(document.getElementById("academicYearFull").value);

        $.getScript('../../assets/js/admin/schedule/schedule-table-script.js');
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