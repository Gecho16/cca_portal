<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "schedule";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get URL info
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

if(isset($_GET["day"])){
    $day_URL = sanitize($_GET["day"]);
}else{
    $day_URL = "";
}

$timeFull = "";

if(isset($_GET["time"])){
    $time_URL = sanitize($_GET["time"]);
    if($time_URL == .5){
        $time = ($time_URL + 6);
    } else {
        $time = ($time_URL + 5);
    }
    if($time < 12){
        $meridiem = "A.M.";
    } else {
        $meridiem = "P.M.";
    }

    if($time >= 13){
        $time -= 12;
    }
    
    if (fmod($time_URL, 1) == 0.5) {
        $timeFull = substr($time, 0, 2) . ":30 " . $meridiem;
        if($time_URL < 12){
            echo $timeFull = substr($time, 0, 1) . ":30 " . $meridiem;
        }
    } else {
        $timeFull = substr($time, 0, 2) . ":00 " . $meridiem;
    }
}else{
    $time_URL = "";
}

// Get Sections
$section = "SELECT * FROM sections";
$result_section = mysqli_query($conn, $section);

// Get Subjects
$subject = "SELECT * FROM subjects";
$result_subject = mysqli_query($conn, $subject);

// Get Faculty
$faculty = "SELECT * FROM faculty";
$result_faculty = mysqli_query($conn, $faculty);

// Get Rooms
$room = "SELECT * FROM rooms";
$result_room_synch = mysqli_query($conn, $room);

// Get Rooms
$room = "SELECT * FROM rooms";
$result_room_asynch = mysqli_query($conn, $room);

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">   
    <h1 class="h3 mb-0">Add Class</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../schedule">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/course.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Class Information</label>
                    <!-- Section -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Section</label>
                            <select class="form-select form-select-lg" id="section" name="section" required>
                                <?php while ($row = mysqli_fetch_assoc($result_section)) {
                                    $section = $row['section'];
                                    $id = $row['id'];
                                    $course_section = " (" . $row['course'] . ") " . $row['section'];
                                ?>
                                    <option id="" value="<?= $id ?>" <?= ($id === $section_URL) ? 'selected' : '';?>><?= $course_section ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Subject</label>
                            <select class="form-select form-select-lg" id="subject" name="subject" required>
                                <?php while ($row = mysqli_fetch_assoc($result_subject)) {
                                    $subject = $row['subject_code'];
                                ?>
                                    <option id="" value="<?= $subject ?>"><?= $subject ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Faculty -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Faculty</label>
                            <select class="form-select form-select-lg" id="faculty" name="faculty">
                                <option id="" value="">None</option>
                                <?php while ($row = mysqli_fetch_assoc($result_faculty)) {
                                    $faculty = $row['firstname'] . " " . $row['lastname'];
                                    $id = $row['id'];
                                ?>
                                    <option id="" value="<?= $id ?>" <?= ($id === $faculty_URL) ? 'selected' : '';?>><?= $faculty ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <label class="h3" >Synchronous Information</label>
                    <!-- Synchronous Time -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Time</label>
                            <select class="form-select form-select-lg" id="synch_time" name="synch_time">
                                <option id="" value="">None</option>
                                <?php 
                                    $startHour = 6;
                                    $endHour = 20;
                                    $meridiem = "A.M.";

                                    $i = 0;
                                    while ($i + $startHour <= $endHour){
                                        
                                        $time = ($startHour + $i);

                                        if($i + $startHour >= 12){
                                            $meridiem = "P.M.";
                                        }

                                        if($i + $startHour > 12){
                                            $time = $time - 12;
                                        }

                                        echo $timeSelect = $time . ":00 " . $meridiem;
                                        echo $timeSelectHalf = $time . ":30 " . $meridiem;

                                        ?>
                                            <option id="" value=""<?= ($timeSelect === $timeFull) ? 'selected' : '';?>><?= $timeSelect;  ?></option>
                                            <option id="" value=""<?= ($timeSelectHalf === $timeFull) ? 'selected' : '';?>><?= $timeSelectHalf;  ?></option>
                                        <?php
                                        $i++;
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Synchronous Duration -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Duration</label>
                            <select class="form-select form-select-lg" id="synch_duration" name="synch_duration">
                                <option id="" value="">None</option>
                                <?php 
                                    $maxHours = 8;

                                    $i = 1;
                                    while ($i <= $maxHours){
                                        
                                        $time = ($startHour + $i);

                                        if($i + $startHour >= 12){
                                            $meridiem = "P.M.";
                                        }

                                        if($i + $startHour > 12){
                                            $time = $time - 12;
                                        }

                                        ?>
                                            <option id="" value=""><?= $i . " Hours"  ?></option>
                                        <?php
                                        $i += .5;
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Synchronous Day -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Day</label>
                            <select class="form-select form-select-lg" id="synch_day" name="synch_day">
                                <option id="" value="">None</option>
                                <option id="" value="Monday" <?= (ucfirst($day_URL) === "Monday") ? 'selected' : '';?>>Monday</option>
                                <option id="" value="Tuesday" <?= (ucfirst($day_URL) === "Tuesday") ? 'selected' : '';?>>Tuesday</option>
                                <option id="" value="Wednesday" <?= (ucfirst($day_URL) === "Wednesday") ? 'selected' : '';?>>Wednesday</option>
                                <option id="" value="Thursday" <?= (ucfirst($day_URL) === "Thursday") ? 'selected' : '';?>>Thursday</option>
                                <option id="" value="Friday" <?= (ucfirst($day_URL) === "Friday") ? 'selected' : '';?>>Friday</option>
                                <option id="" value="Saturday" <?= (ucfirst($day_URL) === "Saturday") ? 'selected' : '';?>>Saturday</option>
                            </select>
                        </div>
                    </div>

                    <!-- Synchronous Room -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Room</label>
                            <select class="form-select form-select-lg" id="synch_room" name="synch_room">
                                <option id="" value="">None</option>
                                <?php while ($row = mysqli_fetch_assoc($result_room_synch)) {
                                    $room = $row['room_code'];
                                    $id = $row['id'];
                                ?>
                                    <option id="" value="<?= $id ?>" <?= ($id === $room_URL) ? 'selected' : '';?>><?= $room ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="h3" >Asynchronous Information</label>
                    <!-- Asynchronous Time -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Time</label>
                            <select class="form-select form-select-lg" id="asynch_time" name="asynch_time">
                                <option id="" value="">None</option>
                                <?php 
                                    $startHour = 6;
                                    $endHour = 20;
                                    $meridiem = "A.M.";

                                    $i = 0;
                                    while ($i + $startHour <= $endHour){
                                        
                                        $time = ($startHour + $i);

                                        if($i + $startHour >= 12){
                                            $meridiem = "P.M.";
                                        }

                                        if($i + $startHour > 12){
                                            $time = $time - 12;
                                        }

                                        echo $timeSelect = $time . ":00 " . $meridiem;
                                        echo $timeSelectHalf = $time . ":30 " . $meridiem;

                                        ?>
                                            <option id="" value=""<?= ($timeSelect === $timeFull) ? 'selected' : '';?>><?= $timeSelect;  ?></option>
                                            <option id="" value=""<?= ($timeSelectHalf === $timeFull) ? 'selected' : '';?>><?= $timeSelectHalf;  ?></option>
                                        <?php
                                        $i++;
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Asynchronous Duration -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Duration</label>
                            <select class="form-select form-select-lg" id="asynch_duration" name="asynch_duration">
                                <option id="" value="">None</option>
                                <?php 
                                    $maxHours = 8;

                                    $i = 1;
                                    while ($i <= $maxHours){
                                        
                                        $time = ($startHour + $i);

                                        if($i + $startHour >= 12){
                                            $meridiem = "P.M.";
                                        }

                                        if($i + $startHour > 12){
                                            $time = $time - 12;
                                        }

                                        ?>
                                            <option id="" value=""><?= $i . " Hours"  ?></option>
                                        <?php
                                        $i += .5;
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Asynchronous Day -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Day</label>
                            <select class="form-select form-select-lg" id="asynch_day" name="asynch_day">
                                <option id="" value="">None</option>
                                <option id="" value="Monday" <?= (ucfirst($day_URL) === "Monday") ? 'selected' : '';?>>Monday</option>
                                <option id="" value="Tuesday" <?= (ucfirst($day_URL) === "Tuesday") ? 'selected' : '';?>>Tuesday</option>
                                <option id="" value="Wednesday" <?= (ucfirst($day_URL) === "Wednesday") ? 'selected' : '';?>>Wednesday</option>
                                <option id="" value="Thursday" <?= (ucfirst($day_URL) === "Thursday") ? 'selected' : '';?>>Thursday</option>
                                <option id="" value="Friday" <?= (ucfirst($day_URL) === "Friday") ? 'selected' : '';?>>Friday</option>
                                <option id="" value="Saturday" <?= (ucfirst($day_URL) === "Saturday") ? 'selected' : '';?>>Saturday</option>
                            </select>
                        </div>
                    </div>

                    <!-- Asynchronous Room -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Room</label>
                            <select class="form-select form-select-lg" id="asynch_room" name="asynch_room">
                                <option id="" value="">None</option>
                                <?php while ($row = mysqli_fetch_assoc($result_room_asynch)) {
                                    $room = $row['room_code'];
                                    $id = $row['id'];
                                ?>
                                    <option id="" value="<?= $id ?>" <?= ($id === $room_URL) ? 'selected' : '';?>><?= $room ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="h3" >Virtual Meeting Information</label>
                    <!-- Asynchronous Link -->
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label>Virtual Link</label>
                            <input class="form-select form-select-lg" id="meeting_link_input" name="meeting_link">
                            <p id="link_warning" class="text-danger d-none">*Not a valid google meet link</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3 d-flex align-items-center justify-content-center h-100 w-100">
                            <a href="" target="_blank" id="meeting_link" class="btn btn-success align-items-center justify-content-center d-none"><i class="m-2 fa-solid fa-video fa-sm"></i>Try link</a>
                        </div>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="text-end">
                    <button class="btn btn-primary btn-lg" name="submitAddClass" type="submit">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<script>
    function isGoogleMeetLink(link) {
    // var meetLinkRegex = /^https?:\/\/meet\.google\.com\/[a-z-]+$/i;
    var meetLinkRegex = /^https?:\/\/meet\.google\.com\/[a-z]{3,4}-[a-z]{4}-[a-z]{3}$/i;
    return meetLinkRegex.test(link);
    }

    function checkLink() {
        var link = document.getElementById('meeting_link_input').value;
        validLink = isGoogleMeetLink(link);

        if(link === ""){
            // Hide Try Link Button
            document.getElementById('meeting_link').classList.add("d-none");
            document.getElementById('meeting_link').classList.remove("d-flex");
            
        }else if(validLink){
            // Transfer Link to Button
            document.getElementById('meeting_link').href = link;
            
            // Show Warning Text
            document.getElementById('link_warning').classList.add("d-none");
            document.getElementById('link_warning').classList.remove("d-block");

            // Show Try Link Button
            document.getElementById('meeting_link').classList.add("d-flex");
            document.getElementById('meeting_link').classList.remove("d-none");

        }else {
            // Transfer Link to Button
            document.getElementById('meeting_link').href = link;

            // Show Warning Text
            document.getElementById('link_warning').classList.add("d-block");
            document.getElementById('link_warning').classList.remove("d-none");

            // Hide Try Link Button
            document.getElementById('meeting_link').classList.add("d-none");
            document.getElementById('meeting_link').classList.remove("d-flex");
        }
    }

    checkLink();
    $( document ).ready(function() {
        var link = document.getElementById('meeting_link').value;
        $('#meeting_link_input').on('input', function() {
            checkLink();
        });
    });    
</script>
