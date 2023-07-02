<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get subject
$section_id = sanitize($_GET["section"]);
$section = "SELECT * FROM sections WHERE id = $section_id";
$result_section = mysqli_query($conn, $section);
$row_section = mysqli_fetch_assoc($result_section);

// Set Variables
$section_db = $row_section["section"];
$course_db = $row_section["course"];
$year_level_db = $row_section["year_level"];
$academic_year_db = $row_section["academic_year"];

// Get Courses
$course = "SELECT * FROM courses";
$result_course = mysqli_query($conn, $course);

// Get Academic Year
$acad_year = "SELECT * FROM academic_years";
$result_acad_year = mysqli_query($conn, $acad_year);

// Get Active Academic Year
$acad_year_active = "SELECT id FROM academic_years WHERE is_active = 1";
$result_acad_year_active = mysqli_query($conn, $acad_year_active);
$row_acad_year_active = mysqli_fetch_assoc($result_acad_year_active);

// Set Variables
$acad_year_active_id = $row_acad_year_active['id'];


?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Edit Section</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../?table=sections">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/section.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Section Information</label>
                    <!-- Section -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Section</label>
                            <input type="text" class="form-select form-select-lg" id="section_display">
                            <input type="text" class="form-select form-select-lg" id="section_hidden" name="section" hidden>
                            </input>
                        </div>
                    </div> 

                    <!-- Course -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Course</label>
                            <select class="form-select form-select-lg" id="course" name="course" required>
                                <?php while ($row = mysqli_fetch_assoc($result_course)) {
                                    $course = $row['course_code'];
                                    $institute = $row['institute'];
                                    $prefix = $row['section_prefix'];

                                    // Get number of each section
                                    $section_number1 = "SELECT COUNT(*) as count FROM `sections` WHERE `course` = '$course' AND year_level = 1";
                                    $result_section_number1 = mysqli_query($conn, $section_number1);
                                    $row_section_number1 = mysqli_fetch_assoc($result_section_number1);

                                    $section_number2 = "SELECT COUNT(*) as count FROM `sections` WHERE `course` = '$course' AND year_level = 2";
                                    $result_section_number2 = mysqli_query($conn, $section_number2);
                                    $row_section_number2 = mysqli_fetch_assoc($result_section_number2);

                                    $section_number3 = "SELECT COUNT(*) as count FROM `sections` WHERE `course` = '$course' AND year_level = 3";
                                    $result_section_number3 = mysqli_query($conn, $section_number3);
                                    $row_section_number3 = mysqli_fetch_assoc($result_section_number3);

                                    $section_number4 = "SELECT COUNT(*) as count FROM `sections` WHERE `course` = '$course' AND year_level = 4";
                                    $result_section_number4 = mysqli_query($conn, $section_number4);
                                    $row_section_number4 = mysqli_fetch_assoc($result_section_number4);

                                    $count1 = $row_section_number1['count'];
                                    $count2 = $row_section_number2['count'];
                                    $count3 = $row_section_number3['count'];
                                    $count4 = $row_section_number4['count'];
                                    
                                ?>
                                    <option id="<?= $course; ?>" value="<?= $course; ?>" <?= ($course === $course_db) ? 'selected' : '';?>><?php echo "(" . $institute . ") " . $course; ?></option>
                                    <option id="<?= $course . '_1'; ?>" value="<?= $count1 ?>" hidden><?= $prefix ?></option>
                                    <option id="<?= $course . '_2'; ?>" value="<?= $count2 ?>" hidden><?= $prefix ?></option>
                                    <option id="<?= $course . '_3'; ?>" value="<?= $count3 ?>" hidden><?= $prefix ?></option>
                                    <option id="<?= $course . '_4'; ?>" value="<?= $count4 ?>" hidden><?= $prefix ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Year Level -->
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label>Year Level</label>
                            <select class="form-select form-select-lg" id="year" name="year" required>
                                    <option value="1" <?= ($year_lelve_db = 1) ? 'selected' : '';?>>1st Year</option>
                                    <option value="2" <?= ($year_lelve_db = 2) ? 'selected' : '';?>>2nd Year</option>
                                    <option value="3" <?= ($year_lelve_db = 3) ? 'selected' : '';?>>3rd Year</option>
                                    <option value="4" <?= ($year_lelve_db = 4) ? 'selected' : '';?>>4th Year</option>
                            </select>
                        </div>
                    </div>

                    <!-- Academic Year -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Academic Year</label>
                            <select class="form-select form-select-lg" id="acad_year" name="acad_year" required>
                                <?php while ($row = mysqli_fetch_assoc($result_acad_year)) {
                                    $academic_yearId = $row['id'];
                                    $academic_year_status = $row['is_active'];
                                    $academic_year = "A.Y. " . $row['year'] . " " . $row['semester'];
                                    if($row['semester'] != "Summer"){
                                        $academic_year .= " Semester";
                                    };

                                    if($row['is_active'] == 1){
                                        $academic_year .= " (Active)";
                                    };
                                ?>
                                    <option value="<?php echo $academic_yearId; ?>"  <?= ($academic_yearId === $academic_year_db) ? 'selected' : '';?>><?php echo $academic_year; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <label class="h3" >Adviser</label>
                    <!-- First name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Firstname</label>
                            <input type="text" class="form-select form-select-lg names" name="firstname">
                            </input>
                        </div>
                    </div> 

                    <!-- Last name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Lastname</label>
                            <input type="text" class="form-select form-select-lg names" name="lastname">
                            </input>
                        </div>
                    </div> 

                    <!-- Middle name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Middlename</label>
                            <input type="text" class="form-select form-select-lg names" name="middlename">
                            </input>
                        </div>
                    </div> 

                    <!-- Suffix -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Suffix</label>
                            <input type="text" class="form-select form-select-lg names" name="suffix">
                            </input>
                        </div>
                    </div> 

                </div>

                <!-- Submit button -->
                <div class="text-end">
                    <input type="text" value="<?= $course_db ?>" id="course_holder" hidden>
                    <input type="text" value="<?= $year_level_db ?>" id="year_holder" hidden>
                    <input type="text" value="<?= $section_db ?>" id="section_holder" hidden>
                    <button class="btn btn-primary btn-lg" name="submitEditSection"  value="<?= $section_id ?>" type="submit">
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
    // Names
    var names = document.querySelectorAll('.names');

    for (var i = 0; i < names.length; i++) {
        names[i].addEventListener('input', function(event) {
            var currentValue = event.target.value;
            var words = currentValue.split(' ');
            for (var j = 0; j < words.length; j++) {
                words[j] = words[j].charAt(0).toUpperCase() + words[j].slice(1);
            }
            var capitalizedValue = words.join(' ');
            event.target.value = capitalizedValue;
        });
    }

    // Automatically Set Section
    var section_display = document.getElementById('section_display');
    var section_hidden = document.getElementById('section_hidden');
    var course = document.getElementById('course');
    var year = document.getElementById('year');


    function setSection(){
        section_display.disabled = true;

        var number_id = course.value + '_' + year.value;

        console.log(number_id);

        var sectionNum = document.getElementById(number_id).value;
        var prefix = document.getElementById(number_id).innerHTML;
        var course_holder = document.getElementById('course_holder').value;
        var year_holder = document.getElementById('year_holder').value;
        var section_holder = document.getElementById('section_holder').value;

        sectionNum++;

        section_display.value = prefix + year.value + "0" + sectionNum;
        section_hidden.value = prefix + year.value + "0" + sectionNum;

        if(course_holder == course.value && year_holder == year.value){
            section_display.value = section_holder;
            section_hidden.value = section_holder; 
        }
    }

    setSection();

    course.addEventListener('input', function() {
        setSection()
    });

    year.addEventListener('input', function() {
        setSection()
    });
</script>
