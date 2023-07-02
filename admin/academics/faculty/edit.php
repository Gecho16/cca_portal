<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get faculty
$faculty_id = sanitize($_GET["faculty"]);
$faculty = "SELECT * FROM faculty WHERE id = $faculty_id";
$result_faculty = mysqli_query($conn, $faculty);
$row_faculty = mysqli_fetch_assoc($result_faculty);

// Set Variables
$firstname = $row_faculty['firstname'];
$lastname = $row_faculty['lastname'];
$middlename = $row_faculty['middlename'];
$suffix = $row_faculty['suffix'];
$institute = $row_faculty['institute'];
$reference_number = $row_faculty['reference_number'];
$type = $row_faculty['type'];

// Get institute
$institutes = "SELECT institute_code, institute_name FROM institutes WHERE institute_code != 'MISSO' AND institute_code != 'NTPs'";
$result_institutes = mysqli_query($conn, $institutes);

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Edit Faculty</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../?table=faculty">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/faculty.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Faculty Information</label>
                    <!-- First name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Firstname</label>
                            <input type="text" class="form-select form-select-lg names" id="firstname" name="firstname" value='<?= $firstname ?>' required>
                            </input>
                        </div>
                    </div> 

                    <!-- Last name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Lastname</label>
                            <input type="text" class="form-select form-select-lg names" id="lastname" name="lastname" value='<?= $lastname ?>' required>
                            </input>
                        </div>
                    </div> 

                    <!-- Middle name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Middlename</label>
                            <input type="text" class="form-select form-select-lg names" name="middlename" value='<?= $middlename ?>'>
                            </input>
                        </div>
                    </div> 

                    <!-- Suffix -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Suffix</label>
                            <input type="text" class="form-select form-select-lg names" name="suffix" value='<?= $suffix ?>'>
                            </input>
                        </div>
                    </div> 

                </div>

                <div class="row">
                    <!-- Reference Number -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Reference Number</label>
                            <input type="text" class="form-control form-select-lg names" id="reference_number" name="reference_number" value='<?= $reference_number ?>' readonly required>
                        </div>
                    </div> 

                    <!-- Institute -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Institute</label>
                            <select class="form-select form-select-lg" id="institute" name="institute" required>
                                <?php while ($row = mysqli_fetch_assoc($result_institutes)) { $institute_code = $row['institute_code']; ?>
                                    <option value="<?php echo $institute_code; ?>" <?= ($institute === $institute_code) ? 'selected' : '';?>><?php echo $institute_code; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    
                    <!-- Faculty Type -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Faculty Type</label>
                            <select class="form-select form-select-lg" id="type" name="type" required>
                                <option value="COS Full Time" <?= ($type === "COS Full Time") ? 'selected' : '';?>>COS Full Time</option>
                                <option value="COS Part Time" <?= ($type === "COS Part Time") ? 'selected' : '';?>>COS Part Time</option>
                                <option value="Plantilla Permanent" <?= ($type === "Plantilla Permanent") ? 'selected' : '';?>>Plantilla Permanent</option>
                                <option value="Plantilla Temporary" <?= ($type === "Plantilla Temporary") ? 'selected' : '';?>>Plantilla Temporary</option>
                            </select>
                            <!-- <input type="hidden" class="form-control" id="type_input" name="type" value='<?= $type ?>' required> -->
                        </div>
                    </div>

                </div>

                <!-- Submit button -->
                <div class="text-end">
                    <button class="btn btn-primary btn-lg" name="submitEditFaculty" type="submit" value='<?= $faculty_id ?>'>
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
    // Reference Number
    var reference_number = document.getElementById('reference_number');

    reference_number.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z0-9-_]/g, '').toUpperCase();
        if (this.value.length > 15) {
            this.value = this.value.substring(0, 15);
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
