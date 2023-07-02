<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get institute
$institutes = "SELECT institute_code FROM institutes WHERE institute_code != 'MISSO' AND institute_code != 'NTPs'";
$result_institutes = mysqli_query($conn, $institutes);

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">   
    <h1 class="h3 mb-0">Add Course</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../?table=courses">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/course.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Course Information</label>
                    <!-- Course Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Course Name</label>
                            <input type="text" class="form-select form-select-lg" id="course_name" name="course_name" required>
                            </input>
                        </div>
                    </div>

                    <!-- Course Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Course Code</label>
                            <input type="text" class="form-select form-select-lg" id="course_code" name="course_code" required>
                            </input>
                        </div>
                    </div> 

                    <!-- Institute -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Institute</label>
                            <select class="form-select form-select-lg" id="institute" name="institute" required>
                                <?php while ($row = mysqli_fetch_assoc($result_institutes)) { $institute_code = $row['institute_code']; ?>
                                    <option value="<?php echo $institute_code; ?>"><?php echo $institute_code; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="text-end">
                    <button class="btn btn-primary btn-lg" name="submitAddCourse" type="submit">
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
    // Course Name
    var course_name = document.getElementById('course_name');

    course_name.addEventListener('input', function() {
        let words = course_name.value.split(' ');

        // Capitalize the first letter of each word
        for (let i = 0; i < words.length; i++) {
            let word = words[i];
            words[i] = word.charAt(0).toUpperCase() + word.slice(1);
        }

        // Join the words back into a string
        course_name.value = words.join(' ');
    });

    // Course Code
    var course_code = document.getElementById('course_code');

    course_code.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z]/g, '').toUpperCase();
        if (this.value.length > 8) {
            this.value = this.value.substring(0, 8);
        }
    });
</script>
