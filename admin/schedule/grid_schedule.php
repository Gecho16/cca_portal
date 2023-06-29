<?php
if(isset($_GET["section"])){
    $section_URL = sanitize($_GET["section"]);
}else{
    $section_URL = "";
}

if(isset($_GET["faculty"])){
    $faculty_URL = sanitize($_GET["faculty"]);
}else{
    $faculty_URL = "";
}

if(isset($_GET["room"])){
    $room_URL = sanitize($_GET["room"]);
}else{
    $room_URL = "";
}

?>
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
                    <?= $hour . ":00 " . $meridiem . " - " . $endhour . ":00 " . $endmeridiem;?>
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

                // Check if number is whole
                function is_whole($var) {
                    // Check if the variable is numeric
                    if (is_numeric($var)) {
                        // Convert the variable to an integer using intval
                        $integerValue = intval($var);
                        // Check if the integer value is equal to the original value
                        if ($var == $integerValue) {
                            return true; // The variable is a whole number
                        }
                    }
                    return false; // The variable is not a whole number
                }

                $section = $section_URL;
                $faculty = $faculty_URL;
                $room = $room_URL;

                for ($i = 0; $i < count($days); $i++) {
            ?>
                <div id="<?= substr($days[$i], 0, 3) . '_container'; ?>" class="col-2 text-center">
                    <?php 
                        $tilecount = 1;
                        
                        if(isset($_GET["section"])){
                            $sql_classtime_synch = "SELECT * FROM classes WHERE `section` = $section AND synch_day = '" . ucfirst($days[$i]) . "'  ORDER BY synch_time ASC";
                            
                        }else if(isset($_GET["faculty"])){
                            $sql_classtime_synch = "SELECT * FROM classes WHERE `faculty` = $faculty AND synch_day = '" . ucfirst($days[$i]) . "'  ORDER BY synch_time ASC";
                            
                        }else if(isset($_GET["room"])){
                            $sql_classtime_synch = "SELECT * FROM classes WHERE `synch_room` = $room AND synch_day = '" . ucfirst($days[$i]) . "'  ORDER BY synch_time ASC";
                            
                        }else{
                            $sql_classtime_synch = "SELECT * FROM classes WHERE `section` = 1 AND synch_day = '" . ucfirst($days[$i]) . "'  ORDER BY synch_time ASC";
                        }

                        if(isset($_GET["section"])){
                            $sql_classtime_asynch = "SELECT * FROM classes WHERE `section` = '$section' AND asynch_day = '" . ucfirst($days[$i]) . "'  ORDER BY asynch_time ASC";
                            
                        }else if(isset($_GET["faculty"])){
                            $sql_classtime_asynch = "SELECT * FROM classes WHERE `faculty` = '$faculty' AND asynch_day = '" . ucfirst($days[$i]) . "'  ORDER BY asynch_time ASC";
                            
                        }else if(isset($_GET["room"])){
                            $sql_classtime_asynch = "SELECT * FROM classes WHERE `asynch_room` = '$room' AND asynch_day = '" . ucfirst($days[$i]) . "'  ORDER BY asynch_time ASC";
                            
                        }else{
                            $sql_classtime_asynch = "SELECT * FROM classes WHERE `section` = 1 AND asynch_day = '" . ucfirst($days[$i]) . "'  ORDER BY asynch_time ASC";
                        }

                        $result_classtime_synch = mysqli_query($conn, $sql_classtime_synch);

                        $result_classtime_asynch = mysqli_query($conn, $sql_classtime_asynch);

                        $half = 100/30;
                        $whole = 100/15;
                        $startHour = 6;
                        $startmeridiem = "A.M.";
                        $endmeridiem = "A.M.";

                        $prevblock = "vacantblock";
                        $prevheight = "whole";
                        $timeblock = 0;
                        $minuteblock = 0;

                        for ($j = 1; $j < 16; $j++) {
                            $endHour = $startHour+1;
                            

                            
                            $hour = 0;
                            $minute = 0;
                            $duration = 0;

                            $subject = '';

                            $class_type = '';
                            $block_color = '';

                            // $sql_classtime_synch = "SELECT * FROM classes WHERE synch_day = '" . ucfirst($days[$i]) . "'  ORDER BY synch_time ASC";
                            $result_classtime_synch = mysqli_query($conn, $sql_classtime_synch);
                            while ($row_classtime_synch = mysqli_fetch_assoc($result_classtime_synch)) {
                                $fulltime = substr($row_classtime_synch['synch_time'], 0, 5);
                                // echo "a" . 
                                $duration = $row_classtime_synch['synch_duration'];
                                // echo "b" . 
                                $hour = intval(substr($fulltime, 0, 2));
                                // echo "c" . 
                                $minute = intval(substr($fulltime, 3));

                                // echo "d" . 
                                $startHour;


                                // echo "</br>";

                                // Set Variables
                                $subject_id = $row_classtime_synch['subject'];
                                $sql_subject_synch = "SELECT * FROM subjects WHERE id = $subject_id";
                                $result_subject_synch = mysqli_query($conn, $sql_subject_synch);
                                $row_subject_synch = mysqli_fetch_assoc($result_subject_synch);

                                $subject = $row_subject_synch['subject_code'];
                                $class_type = "synch";

                                if($startHour >= $hour && $startHour < $hour + $duration){
                                    $timeblock = 1;
                                    if($minute != 0){
                                        $minuteblock = 1;
                                    }
                                    $height = $whole * $duration;
                                    break;
                                }
                            }

                            if(!$timeblock){
                                // $sql_classtime_asynch = "SELECT * FROM classes WHERE asynch_day = '" . ucfirst($days[$i]) . "'  ORDER BY asynch_time ASC";
                                $result_classtime_asynch = mysqli_query($conn, $sql_classtime_asynch);
                                while ($row_classtime_asynch = mysqli_fetch_assoc($result_classtime_asynch)) {
                                    $fulltime = substr($row_classtime_asynch['asynch_time'], 0, 5);
                                    // echo "a" . 
                                    $duration = $row_classtime_asynch['asynch_duration'];
                                    // echo "b" . 
                                    $hour = intval(substr($fulltime, 0, 2));
                                    // echo "c" . 
                                    $minute = intval(substr($fulltime, 3));
    
                                    // echo "d" . 
                                    $startHour;
    
    
                                    // echo "</br>";
    
                                    // Set Variables
                                    $subject_id = $row_classtime_asynch['subject'];
                                    $sql_subject_asynch = "SELECT * FROM subjects WHERE id = $subject_id";
                                    $result_subject_asynch = mysqli_query($conn, $sql_subject_asynch);
                                    $row_subject_asynch = mysqli_fetch_assoc($result_subject_asynch);

                                    $subject = $row_subject_asynch['subject_code'];
                                    $class_type = "asynch";
    
                                    if($startHour >= $hour && $startHour < $hour + $duration){
                                        $timeblock = 1;
                                        if($minute != 0){
                                            $minuteblock = 1;
                                        }
                                        $height = $whole * $duration;
                                        break;
                                    }
                                }
                            }

                            if($class_type == "synch"){
                                $block_color = "c6e0b4";
                            }else if($class_type == "asynch"){
                                $block_color = "bdd7ee";
                            }else{
                                $block_color = "";
                            }

                            if($timeblock){
                                // Vacant Slots
                                if($startHour == $hour && $minuteblock && $prevblock == "vacantblock" && $prevheight == "whole"){
                                    ?>
                                    <div class="border border-white" style="background-color: #f2f2f2; height: <?= $half; ?>%;">
                                        <a href='add?section=<?= $section?>&faculty=<?= $faculty?>&room=<?= $room?>&day=<?= $days[$i]?>&time=<?= $j?>' class="d-flex justify-content-center align-items-center w-100 h-100 h1 text-decoration-none d-print-none schedule_add_link" style="color: #f2f2f2;">+</a>
                                    </div>
                                    <?php
                                    $prevblock = "vacantblock";
                                    $prevheight = "half";
                                    $minuteblock = 0;
                                    $j = $j - .5;
                                }else if($startHour == $hour && $minuteblock && $prevblock == "vacantblock" && $prevheight == "half"){
                                    $j = $j - .5;
                                    ?>
                                    <div class="border border-white" style="background-color: #f2f2f2; height: <?= $whole; ?>%;">
                                        <a href='add?section=<?= $section?>&faculty=<?= $faculty?>&room=<?= $room?>&day=<?= $days[$i]?>&time=<?= $j?>' class="d-flex justify-content-center align-items-center w-100 h-100 h1 text-decoration-none d-print-none schedule_add_link" style="color: #f2f2f2;">+</a>
                                    </div>
                                    <?php
                                    $prevblock = "vacantblock";
                                    $prevheight = "half";
                                    $minuteblock = 0;
                                }
                                
                                // Occupied Slots
                                if($startHour == $hour + $duration - 1 && $prevblock == "vacantblock"){
                                    $j -= 1;
                                    ?>
                                    <div class="d-flex justify-content-center align-items-center border border-white" style="height: <?= $height; ?>%; background-color: #<?= $block_color; ?>;">
                                        <?= $subject;?>
                                    </div>
                                    <?php
                                    
                                    $prevblock = "timeblock";
                                    $prevheight = "custom";
                                    $j += 2;
                                }else if($startHour == $hour + $duration - 1 && $prevblock == "timeblock"){
                                    $j -= 2;
                                    ?>
                                    <div class="d-flex justify-content-center align-items-center border border-white" style="height: <?= $height; ?>%; background-color: #<?= $block_color; ?>;">
                                        <?= $subject;?>
                                    </div>
                                    <?php
                                    
                                    $prevblock = "timeblock";
                                    $prevheight = "custom";
                                    $j += 2;
                                }
                                
                                $timeblock = 0;
                            }else{
                                if($j > 15){
                                    $j = $j - .5;
                                    ?>
                                    <div class="border border-white" style="background-color: #f2f2f2; height: <?= $whole; ?>%;">
                                        <a href='add?section=<?= $section?>&faculty=<?= $faculty?>&room=<?= $room?>&day=<?= $days[$i]?>&time=<?= $j?>' class="d-flex justify-content-center align-items-center w-100 h-100 h1 text-decoration-none d-print-none schedule_add_link" style="color: #f2f2f2;">+</a>
                                    </div>
                                    <?php
                                    $prevblock = "vacantblock";
                                    $prevheight = "whole";
                                }else if($prevblock == "timeblock" && !is_whole($j)){
                                    ?>
                                    <div class="border border-white" style="background-color: #f2f2f2; height: <?= $half; ?>%;">
                                        <a href='add?section=<?= $section?>&faculty=<?= $faculty?>&room=<?= $room?>&day=<?= $days[$i]?>&time=<?= $j?>' class="d-flex justify-content-center align-items-center w-100 h-100 h1 text-decoration-none d-print-none schedule_add_link" style="color: #f2f2f2;">+</a>
                                    </div>
                                    <?php
                                    $prevblock = "vacantblock";
                                    $prevheight = "half";

                                }else if($prevblock == "timeblock" && is_whole($j)){
                                    ?>
                                    <div class="border border-white" style="background-color: #f2f2f2; height: <?= $whole; ?>%;">
                                        <a href='add?section=<?= $section?>&faculty=<?= $faculty?>&room=<?= $room?>&day=<?= $days[$i]?>&time=<?= $j?>' class="d-flex justify-content-center align-items-center w-100 h-100 h1 text-decoration-none d-print-none schedule_add_link" style="color: #f2f2f2;">+</a>
                                    </div>
                                    <?php
                                    $prevblock = "vacantblock";
                                    $prevheight = "half";

                                }else if($prevblock == "vacantblock" && $prevheight == "half"){
                                    $j = $j - .5;
                                    ?>
                                    <div class="border border-white" style="background-color: #f2f2f2; height: <?= $whole; ?>%;">
                                        <a href='add?section=<?= $section?>&faculty=<?= $faculty?>&room=<?= $room?>&day=<?= $days[$i]?>&time=<?= $j?>' class="d-flex justify-content-center align-items-center w-100 h-100 h1 text-decoration-none d-print-none schedule_add_link" style="color: #f2f2f2;">+</a>
                                    </div>
                                    <?php
                                    $prevblock = "vacantblock";
                                    $prevheight = "whole";

                                }else{
                                    ?>
                                    <div class="border border-white" style="background-color: #f2f2f2; height: <?= $whole; ?>%;">
                                        <a href='add?section=<?= $section?>&faculty=<?= $faculty?>&room=<?= $room?>&day=<?= $days[$i]?>&time=<?= $j?>' class="d-flex justify-content-center align-items-center w-100 h-100 h1 text-decoration-none d-print-none schedule_add_link" style="color: #f2f2f2;">+</a>
                                    </div>
                                    <?php
                                    $prevblock = "vacantblock";
                                    $prevheight = "whole";
                                }
                        
                            }
                            $startHour++;
                        }                        
                    ?>
                </div>
            <?php

                }
            ?>
        </div>
    </div>
</div>
