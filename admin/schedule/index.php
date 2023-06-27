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


<div id="graphics_container" class="card p-3">
    <div class="row" style="background-color: #6c757d; color: white;">
        <!-- Time Header -->
        <div class="col-2 p-3 text-center border border-white">
            Time
        </div>
        <!-- Automate Days Header -->
        <div class="col-10 d-flex justify-content-center align-items-center p-0">
            <?php
                $days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday");

                for ($i = 0; $i < count($days); $i++) {
            ?>
                <div class="col-2 h-100 d-flex justify-content-center align-items-center text-center border border-white">
                    <?= ucfirst($days[$i]); ?>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-2 p-0 text-center" style="background-color: #dbdddf;">
            <?php
                $hour = 6;
                $meridiem = "A.M.";
                $endmeridiem = "A.M.";
                for ($i = 1; $i < 16; $i++) {
                    $endhour = $hour+1;

                    if($hour == 12){
                        $meridiem = "P.M.";
                        $endhour = 1;
                    }

                    if($hour == 11){
                        $endmeridiem = "P.M.";
                    }
            ?>
                <div class="p-3 border border-white">
                    <?= $hour . ":00 " . $meridiem . " - " . $endhour . ":00 " . $endmeridiem; ?>
                </div>
            <?php
                    if($hour == 12){
                        $hour = 0;
                    }

                    $hour++;

                }
            ?>
        </div>
        <div class="col-10 d-flex p-0">
            <?php
                $days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday");

                for ($i = 0; $i < count($days); $i++) {
            ?>
                <div id="<?= substr($days[$i], 0, 3) . '_container'; ?>" class="col-2 text-center">
                    <?php 
                        

                        $sql_classtime_synch = "SELECT * FROM classes WHERE synch_day = '" . ucfirst($days[$i]) . "'  ORDER BY synch_time ASC";
                        $result_classtime_synch = mysqli_query($conn, $sql_classtime_synch);

                        $sql_classtime_asynch = "SELECT * FROM classes WHERE asynch_day = '" . ucfirst($days[$i]) . "'  ORDER BY asynch_time ASC";
                        $result_classtime_asynch = mysqli_query($conn, $sql_classtime_asynch);

                        // $hour = 6;
                        // $meridiem = "A.M.";
                        // $endmeridiem = "A.M.";

                        for ($j = 1; $j < 16; $j++) {
                            // echo $j;

                            $half = 100/15;
                            $whole = 100/30;
                            $startHour = 6;
                            $endHour = $startHour+1;
                            $startmeridiem = "A.M.";
                            $endmeridiem = "A.M.";

                            $timeblockcount = 0;

                            while ($row_classtime_synch = mysqli_fetch_assoc($result_classtime_synch)) {
                                $fulltime = substr($row_classtime_synch['synch_time'], 0, 5);
                                $hour = intval(substr($fulltime, 0, 2));
                                $minute = intval(substr($fulltime, 3));

                                if($startHour <= $hour){
                                    echo $hour;
                                }
                            }

                            // while ($row_classtime_asynch = mysqli_fetch_assoc($result_classtime_asynch)) {
                            //     echo $row_classtime_asynch['asynch_time'];
                            // }


                            if(0){
                                ?>
                                <div class="d-flex justify-content-center align-items-center border border-white" style="height: 6.7%; background-color: var(--green); color: white;">
                                    Subject
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="border border-white" style="background-color: #f2f2f2; height: 6.7%;">
                                    <a href="" class="d-flex justify-content-center align-items-center w-100 h-100 h1 text-decoration-none" style="color: #6c757d;">+</a>
                                </div>
                                <?php
                            }
                        }

                        // if(1){

                        // }

                        

                    ?>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>



<?php

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