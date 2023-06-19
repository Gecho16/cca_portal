<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get Academic Year
$course = "SELECT * FROM courses";
$result_course = mysqli_query($conn, $course);

// Get Academic Year
$acad_year = "SELECT * FROM academic_years";
$result_acad_year = mysqli_query($conn, $acad_year);

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Add Section</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/academic.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Section Information</label>
                    <!-- Section -->
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label>Section</label>
                            <input type="text" class="form-select form-select-lg" id="section" name="section" required>
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
                                ?>
                                    <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Year Level -->
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label>Year Level</label>
                            <select class="form-select form-select-lg" id="year" name="year" required>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
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
                                    <option value="<?php echo $academic_yearId; ?>"><?php echo $academic_year; ?></option>
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
                            <input type="text" class="form-select form-select-lg names" name="firstname" required>
                            </input>
                        </div>
                    </div> 

                    <!-- Last name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Lastname</label>
                            <input type="text" class="form-select form-select-lg names" name="lastname" required>
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
                    <button class="btn btn-primary btn-lg" name="submitAddInstitute" type="submit">
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
    // Section
    var section = document.getElementById('section');

    section.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
        if (this.value.length > 8) {
            this.value = this.value.substring(0, 8);
        }
    });

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
</script>
