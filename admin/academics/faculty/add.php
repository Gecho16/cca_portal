<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get institute
$institutes = "SELECT institute_code, institute_name FROM institutes WHERE institute_code != 'MISSO' AND institute_code != 'NTPs'";
$result_institutes = mysqli_query($conn, $institutes);

// Get faculty count
$faculty = "SELECT MAX(id) AS max_id FROM faculty";
$result_faculty = mysqli_query($conn, $faculty);
$row_faculty = mysqli_fetch_assoc($result_faculty);
$last_id = $row_faculty['max_id'] + 1;

// Get active academic year
$acad_year = "SELECT year FROM academic_years WHERE is_active = 1";
$result_acad_year = mysqli_query($conn, $acad_year);
$row = mysqli_fetch_assoc($result_acad_year);
$academic_year = $row['year'];

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Add Faculty</h1>

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
                            <input type="text" class="form-select form-select-lg names" id="firstname" name="firstname" required>
                            </input>
                        </div>
                    </div> 

                    <!-- Last name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Lastname</label>
                            <input type="text" class="form-select form-select-lg names" id="lastname" name="lastname" required>
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

                <div class="row">
                    <!-- Reference Number -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Reference Number</label>
                            <input type="text" class="form-control form-select-lg names" id="reference_number" name="reference_number" required>
                        </div>
                        <label class="form-check" id="userReadonly">
                            <input class="form-check-input" type="checkbox" id="userReadonlyCheckbox" checked>
                            <span class="form-check-label">
                                Autofill
                            </span>
                        </label>
                    </div> 

                    <!-- Institute -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Institute</label>
                            <select class="form-select form-select-lg" id="institute" name="institute" required>
                                <?php while ($row = mysqli_fetch_assoc($result_institutes)) { $institute_code = $row['institute_code']; ?>
                                    <option value="<?php echo $institute_code; ?>"><?php echo $institute_code; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    
                    <!-- Faculty Type -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Faculty Type</label>
                            <select class="form-select form-select-lg" id="type" name="type" required>
                                <option value="COS Full Time">COS Full Time</option>
                                <option value="COS Part Time">COS Part Time</option>
                                <option value="Plantilla Permanent">Plantilla Permanent</option>
                                <option value="Plantilla Temporary">Plantilla Temporary</option>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- Submit button -->
                <div class="text-end">
                    <!-- Values for autofill -->
                    <input type='hidden' name='user_count' id="user_count" value='<?= $last_id ?>'>
                    <input type='hidden' name='academic_year' id="academic_year" value='<?= $academic_year ?>'>

                    <button class="btn btn-primary btn-lg" name="submitAddFaculty" type="submit">
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
    function setReferenceNum(){
        var firstname = document.getElementById("firstname");
        var lastname = document.getElementById("lastname");

        var usercode = "";

        if(firstname.value == "" && lastname.value == ""){
            usercode = "??";
        }else if(firstname.value === ""){
            usercode = "?" + lastname.value.charAt(0);
        }else if(lastname.value === ""){
            usercode = firstname.value.charAt(0) + "?";
        }else{
            usercode = firstname.value.charAt(0) + lastname.value.charAt(0);
        }

        // Reference Number
        var user_count = document.getElementById("user_count").value;
        var academic_year = document.getElementById("academic_year").value;
        var institute = document.getElementById("institute").value;
        var type = document.getElementById("type").value;
        var type_short = "";

        if(type === "COS Full Time"){
            type_short = "CF";
        } else if(type === "COS Part Time"){
            type_short = "CP";
        } else if(type === "Plantilla Permanent"){
            type_short = "PP";
        } else if(type === "Plantilla Temporary"){
            type_short = "PT";
        }

        if (user_count.length < 6) {
            user_count_padded = user_count.padStart(4, '0');
        }
        academic_year_sliced = academic_year.slice(7);
        institute_sliced = institute.slice(1,2);
        usercode = (usercode).toUpperCase();

        // Reference Number
        document.getElementById("reference_number").value = "CCA" + academic_year_sliced + "_" + usercode + user_count_padded;
        
        // Reference Number Formula --->
        // "CCA" +
        // Last year of academic year ex:(23 = 2022-2023) +
        // Name Initial ex:(JD = Juan Dela Cruz) +
        // Current User Count
    }

    setReferenceNum()
    document.getElementById("reference_number").readOnly = true;

    // Auto Fill Reference Number
    $('#firstname').on('input', function() {
        setReferenceNum()
    });

    $('#lastname').on('input', function() {
        setReferenceNum()
    });

    // Read only Username
    const usernameInput = document.getElementById("reference_number");
    const userReadonlyCheckbox = document.getElementById("userReadonlyCheckbox");
    userReadonlyCheckbox.addEventListener("change", function() {
        usernameInput.readOnly = userReadonlyCheckbox.checked;
        if (userReadonlyCheckbox.checked) {
            setReferenceNum();
        }
    });
    
    // Reference Number
    var reference_number = document.getElementById('reference_number');

    reference_number.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z0-9-_-]/g, '').toUpperCase();
        if (this.value.length > 12) {
            this.value = this.value.substring(0, 12);
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
