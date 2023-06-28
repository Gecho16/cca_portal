<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "schedule";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<!-- BODY HEADERS -->
<div class="d-flex justify-content-between align-items-center mb-3 d-print-none">
    <div class="d-flex flex-column align-items-start w-50">
        <h1 id="page-title" class="h1">Classes Table</h1>
    </div>
    <div class="d-flex flex-column w-50">
        <div class="d-flex justify-content-end align-items-center my-2">
            <div class="d-flex align-items-center">
                <select class="form-select me-2" id="tableSelect">
                    <option value='table'>Table View</option>
                    <option value='grid'>Grid View</option>
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
                <a class='btn bg-white border border-dark d-flex' href='add'>
                    Add Entry
                </a>
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
<div id="table_container" class="card">
    <div class="card-body">
        <form class="table-responsive" id="scheduleFrom" >
            <table class="table table-striped table-sm w-100" id="schedule"></table>
        </form>
    </div>
</div>




<?php

include "grid_schedule.php";
include $baseUrl . "assets/modals/admin/schedule/schedule_modals.php";
include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<!-- TABLE SCRIPT -->
<script>

function scheduleTable(){
    $.getScript('../../assets/js/admin/schedule/schedule-table-script.js');
}

function scheduleGrid(){

}

document.getElementById("graphics_container").style.display = 'grid';
document.getElementById("table_container").style.display = 'none';

// document.getElementById("graphics_container").style.display = 'none';
scheduleTable()

$( document ).ready(function() {
    // Refresh table when academic year value is changed
    $('#academicYearFull').on('change', function() {
        acadYear = document.getElementById("academicYearFull").value;
        var table = $('#schedule').DataTable();
        table.destroy();

        $.getScript('../../assets/js/admin/schedule/schedule-table-script.js');
    });

    // Refresh table when view value is changed
    $('#tableSelect').on('change', function() {
        var table = $('#schedule').DataTable();
        var container = $('#schedule');
        table.destroy();

        if ($.fn.DataTable.isDataTable('#schedule')) {
            table.destroy();
            container.remove();
        }
            
        
        view = document.getElementById("tableSelect").value;
        if(view == 'table'){
            var parentContainer = $('#scheduleFrom');
            var newTable = $('<table class="table table-striped table-sm w-100" id="schedule"></table>');
            parentContainer.append(newTable);

            scheduleTable()

            document.getElementById("table_container").style.display = 'block';
            document.getElementById("graphics_container").style.display = 'none';
            document.getElementById("page-title").innerHTML = 'Classes Table';
        }else if(view == 'grid'){
            document.getElementById("table_container").style.display = 'none';
            document.getElementById("graphics_container").style.display = 'grid';
            document.getElementById("page-title").innerHTML = 'Classes Grid';

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