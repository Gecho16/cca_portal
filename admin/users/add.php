<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "users";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get user count
$users = "SELECT id FROM user_accounts WHERE role = 'student' OR role = 'faculty'";
$result_users = mysqli_query($conn, $users);
$user_count = mysqli_num_rows($result_users);

// Get active academic year
$acad_year = "SELECT year FROM academic_years WHERE is_active = 1";
$result_acad_year = mysqli_query($conn, $acad_year);
$row = mysqli_fetch_assoc($result_acad_year);
$academic_year = $row['year'];

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Add User</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../users">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card">
    <form class="card-body" id="form"  action="../../assets/includes/admin/users/user.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <!-- Role -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Role</label>
                            <select class="form-select form-select-lg" id="role" name="role" required>
                                <option value="VPAA" >VPAA</option>
                                <option value="Dean" >Dean</option>
                                <option value="Coordinator" >Coordinator</option>
                                <option value="Secretary" >Secretary</option>
                                <option value="Registrar" >Registrar</option>
                                <option value="HR" >HR</option>
                                <option value="Faculty" >Faculty</option>
                                <option value="Student" selected>Student</option>
                            </select>
                        </div>
                    </div> 

                    <!-- Institute -->
                    <div id="institute-container" class="col-md-4">
                        <div class="mb-3">
                            <label>Institute</label>
                            <select class="form-select form-select-lg" id="institute" name="institute">
                                <option value="IBM" selected>IBM</option>
                                <option value="ICSLIS">ICSLIS</option>
                                <option value="IEAS">IEAS</option>
                                <option id="MISSO_opt" value="MISSO">MISSO</option>
                                <option id="NTPs_opt" value="NTPs">NTPs</option>
                            </select>
                        </div>
                    </div>

                    <!-- IBM Course -->
                    <div id="IBM-course-container" class="col-md-4">
                        <div class="mb-3">
                            <label>Course</label>
                            <select class="form-select form-select-lg" id="IBM-course" name="course">
                                <option clas="IBM" value="BSA" selected>BSA</option>
                                <option clas="IBM" value="BSE">BSE</option>
                                <option clas="IBM" value="BSTM">BSTM</option>
                            </select>
                        </div>
                    </div>

                    <!-- ICSLIS Course -->
                    <div id="ICSLIS-course-container" class="col-md-4">
                        <div class="mb-3">
                            <label>Course</label>
                            <select class="form-select form-select-lg" id="ICSLIS-course" name="course">
                                <option clas="ICSLIS" value="ACT">ACT</option>
                                <option clas="ICSLIS" value="BSCS">BSCS</option>
                                <option clas="ICSLIS" value="BSIS">BSIS</option>
                                <option clas="ICSLIS" value="BLIS">BLIS</option>
                            </select>
                        </div>
                    </div>

                    <!-- IEAS Course -->
                    <div id="IEAS-course-container" class="col-md-4">
                        <div class="mb-3">
                            <label>Course</label>
                            <select class="form-select form-select-lg" id="IEAS-course" name="course">
                                <option clas="IEAS" value="BSM">BSM</option>
                                <option clas="IEAS" value="BSNE">BSNE</option>
                                <option clas="IEAS" value="BSP">BSP</option>
                                <option clas="IEAS" value="BPE">BPE</option>
                                <option clas="IEAS" value="BTVTED">BTVTED</option>
                                <option clas="IEAS" value="BAELS">BAELS</option>
                            </select>
                        </div>
                    </div>

                    <!-- <div id="course-container" class="col-md-4">
                        <div class="mb-3">
                            <label>Course</label>
                            <select class="form-select form-select-lg" id="course" name="course">
                                <option clas="IBM" value="BSA">BSA</option>
                                <option clas="IBM" value="BSE">BSE</option>
                                <option clas="IBM" value="BSTM">BSTM</option>
                                <option clas="ICSLIS" value="ACT">ACT</option>
                                <option clas="ICSLIS" value="BSCS">BSCS</option>
                                <option clas="ICSLIS" value="BSIS">BSIS</option>
                                <option clas="ICSLIS" value="BLIS">BLIS</option>
                                <option clas="IEAS" value="BLIS">BSM</option>
                                <option clas="IEAS" value="BLIS">BSNE</option>
                                <option clas="IEAS" value="BLIS">BSP</option>
                                <option clas="IEAS" value="BLIS">BPE</option>
                                <option clas="IEAS" value="BLIS">BTVTED</option>
                                <option clas="IEAS" value="BLIS">BAELS</option>
                            </select>
                        </div>
                    </div> -->
                </div>

                <div class="row">

                    <!-- Username -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Username</label>
                            <input class="form-control form-control-lg" type="text" id="username" name="username" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Password</label>
                            <input class="form-control form-control-lg" type="password" name="password" id="passwordInput" required>
                        </div>
                        <label class="form-check" id="showPassword">
                            <input class="form-check-input" type="checkbox" id="showPasswordCheckbox">
                            <span class="form-check-label">
                                Show password
                            </span>
                        </label>
                    </div>

                </div>

                <div class="row">

                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Email Address</label>
                            <input class="form-control form-control-lg" id="email" type="email" name="email" required>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-6">
                <div class="row">
                    
                    <!-- Firstname -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>First Name</label>
                            <input class="form-control form-control-lg" id="firstname" type="text" name="firstname" required>
                        </div>
                    </div>

                    <!-- Middlename -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Middle Name</label>
                            <input class="form-control form-control-lg" id="middlename" type="text" name="middlename">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Lastname -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Last Name</label>
                            <input class="form-control form-control-lg" id="lastname" type="text" name="lastname" required>
                        </div>
                    </div>

                    <!-- Suffix -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Suffix</label>
                            <input class="form-control form-control-lg" id="suffix" type="text" name="suffix">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Submit button -->
            <div class="text-end">
                <input type='hidden' name='user_count' id="user_count" value='<?= $user_count ?>'>
                <input type='hidden' name='academic_year' id="academic_year" value='<?= $academic_year ?>'>
                <button class="btn btn-primary btn-lg" id="submitButton" name="submitAddUser" type="submit">
                    Submit
                </button>
            </div>
    </form>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>



<script> 
// Set Variables
var role = document.getElementById("role").value;
var institute = document.getElementById("institute");
var username = document.getElementById("username");
var email = document.getElementById("email");
var firstname = document.getElementById("firstname");
var lastname = document.getElementById("lastname");
var middlename = document.getElementById("middlename");
var suffix = document.getElementById("suffix");
var email_suffix = "@cca.edu.ph";

function setNames(){
    var role = document.getElementById("role").value;
    var institute = document.getElementById("institute").value;
    var email_suffix = "@cca.edu.ph";

    // console.log(course);

    if (['VPAA', 'Registrar', 'HR'].includes(role)) {
        // Personal Info
        document.getElementById("firstname").value = "CCA";
        document.getElementById("lastname").value = role;
        
        // Username
        document.getElementById("username").value = "CCA-" + role;
        
        // Email
        document.getElementById("email").value = ("CCA" + role).toLowerCase() + email_suffix;

    }else if (['Dean', 'Secretary'].includes(role)) {
        // Personal Info 
        document.getElementById("firstname").value = institute;
        document.getElementById("lastname").value = role;
        
        // Username 
        document.getElementById("username").value = institute + "-" + role;
        
        // Email 
        document.getElementById("email").value = (institute + role).toLowerCase() + email_suffix;

    }else if (role == "Coordinator") {
        var courseContainerId = institute + "-course-container";
        var courseId = institute + "-course";
        var course = document.getElementById(courseId).value;

        // Personal Info
        document.getElementById("firstname").value = course;
        document.getElementById("lastname").value = role;

        // Username
        document.getElementById("username").value = course + "-" + role;

        // Email
        document.getElementById("email").value = (course + role).toLowerCase() + email_suffix;

    }else if (['Faculty', 'Student'].includes(role)) {
        // Personal Info
        document.getElementById("firstname").value = '';
        document.getElementById("lastname").value = '';

        // Username
        var user_count = document.getElementById("user_count").value;
        var academic_year = document.getElementById("academic_year").value;
        if (user_count.length < 6) {
            user_count_padded = user_count.padStart(4, '0');
        }
        academic_year_sliced = academic_year.slice(7);
        
        document.getElementById("username").value = "CCA" + academic_year_sliced + "_" + user_count_padded;

        // Email
        document.getElementById("email").value = email_suffix;
    }

    if (!['Faculty', 'Student'].includes(role)) {
        document.getElementById("firstname").readOnly = true;
        document.getElementById("lastname").readOnly = true;
        document.getElementById("middlename").readOnly = true;
        document.getElementById("suffix").readOnly = true;
    }else{
        document.getElementById("firstname").readOnly = false;
        document.getElementById("lastname").readOnly = false;
        document.getElementById("middlename").readOnly = false;
        document.getElementById("suffix").readOnly = false;
    }

    document.getElementById("username").readOnly = true;
    document.getElementById("email").readOnly = true;
}

function setInstitute(){
    var role = document.getElementById("role").value;
    var institute = document.getElementById("institute").value;

    console.log(institute);

    if (['VPAA', 'Registrar', 'HR'].includes(role)) {
        document.getElementById("institute").value = "NTPs";
    } else {
        document.getElementById("institute").value = "IBM";
    }

    if (['VPAA', 'Registrar', 'HR'].includes(role)) {
        // document.getElementById("institute").disabled = true;
        document.getElementById("institute-container").style.display = "none";
    }else{
        document.getElementById("NTPs_opt").style.display = "none";
        document.getElementById("MISSO_opt").style.display = "none";
        document.getElementById("institute").disabled = false;
        document.getElementById("institute-container").style.display = "block";
    }
}

function setCourses(){
    var role = document.getElementById("role").value;
    var institute = document.getElementById("institute").value;
    var courseContainerId = institute + "-course-container";
    var courseId = institute + "-course";

    // console.log(institute);

    if (['VPAA', 'Registrar', 'HR', 'Dean', 'Secretary'].includes(role)) {
        document.getElementById("IBM-course").disabled = true;
        document.getElementById("ICSLIS-course").disabled = true;
        document.getElementById("IEAS-course").disabled = true;
        document.getElementById("IBM-course-container").style.display = "none";
        document.getElementById("ICSLIS-course-container").style.display = "none";
        document.getElementById("IEAS-course-container").style.display = "none";
    } else {
        document.getElementById("IBM-course").disabled = true;
        document.getElementById("ICSLIS-course").disabled = true;
        document.getElementById("IEAS-course").disabled = true;
        document.getElementById("IBM-course-container").style.display = "none";
        document.getElementById("ICSLIS-course-container").style.display = "none";
        document.getElementById("IEAS-course-container").style.display = "none";

        document.getElementById(courseId).disabled = false;
        document.getElementById(courseContainerId).style.display = "block";
    }
}

function setEmail(role){
    if (['Faculty', 'Student'].includes(role)) {
        var email = document.getElementById("email");
        var firstname = document.getElementById("firstname");
        var lastname = document.getElementById("lastname");
        var email_suffix = "@cca.edu.ph";

        email.value = (firstname.value.charAt(0) + lastname.value.replace(/\s/g, "")).toLowerCase() + email_suffix;
    }
}

setInstitute()
setNames()
setCourses()

$('#role').on('change', function() {
    setInstitute()
    setNames()
    setCourses()
})

$('#institute').on('change', function() {
    setNames()
    setCourses()
})

$('#IBM-course').on('change', function() {
    setNames()
});

$('#ICSLIS-course').on('change', function() {
    setNames()
});

$('#IEAS-course').on('change', function() {
    setNames()
});

$('#firstname').on('change', function() {
    var email = document.getElementById("email");
    var firstname = document.getElementById("firstname");
    var lastname = document.getElementById("lastname");
    var email_suffix = "@cca.edu.ph";

    var usercode = firstname.value.charAt(0) + lastname.value.charAt(0);
    var emailcode = firstname.value.charAt(0) + lastname.value.replace(/\s/g, "");

    // Username
    var user_count = document.getElementById("user_count").value;
    var academic_year = document.getElementById("academic_year").value;
    if (user_count.length < 6) {
        user_count_padded = user_count.padStart(4, '0');
    }
    academic_year_sliced = academic_year.slice(7);
    usercode = (usercode).toUpperCase();

    // Username
    document.getElementById("username").value = "CCA" + academic_year_sliced + "_" + usercode + user_count_padded;

    // Email
    email.value = (emailcode).toLowerCase() + email_suffix;
});

$('#lastname').on('change', function() {
    var email = document.getElementById("email");
    var firstname = document.getElementById("firstname");
    var lastname = document.getElementById("lastname");
    var email_suffix = "@cca.edu.ph";

    var usercode = firstname.value.charAt(0) + lastname.value.charAt(0);
    var emailcode = firstname.value.charAt(0) + lastname.value.replace(/\s/g, "");

    // Username
    var user_count = document.getElementById("user_count").value;
    var academic_year = document.getElementById("academic_year").value;
    if (user_count.length < 6) {
        user_count_padded = user_count.padStart(4, '0');
    }
    academic_year_sliced = academic_year.slice(7);
    usercode = (usercode).toUpperCase();

    // Username
    document.getElementById("username").value = "CCA" + academic_year_sliced + "_" + usercode + user_count_padded;

    // Email
    email.value = (emailcode).toLowerCase() + email_suffix;
});

// Show / hide password
const passwordInput = document.getElementById("passwordInput");
const showPasswordCheckbox = document.getElementById("showPasswordCheckbox");
showPasswordCheckbox.addEventListener("change", function () {
    passwordInput.type = this.checked ? "text" : "password";
});

passwordInput.addEventListener("input", function () {
    const password = this.value;

    const hasMinimumLength = password.length >= 8;
    const hasUppercaseLetter = /[A-Z]/.test(password);
    const hasLowercaseLetter = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);

    const isValidPassword = hasMinimumLength && hasUppercaseLetter && hasLowercaseLetter && hasNumber;
    this.setCustomValidity(isValidPassword ? "" : "Password must contain: at least 8 characters, an uppercase letter, a lowercase letter, and a number.");
})

</script>