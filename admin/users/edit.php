<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "users";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get user info
$userId = sanitize($_GET["userId"]);
$sql = "SELECT role, institute, course, username, firstname, lastname, middlename, suffix FROM user_accounts WHERE id = '$userId'";
$result_userId = mysqli_query($conn, $sql);
$row_userId = mysqli_fetch_assoc($result_userId);

// Set Variables
$role = $row_userId['role'];
$institute = $row_userId['institute'];
$course = $row_userId['course'];
$username = $row_userId['username'];
$firstname = $row_userId['firstname'];
$lastname = $row_userId['lastname'];
$middlename = $row_userId['middlename'];
$suffix = $row_userId['suffix'];
?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Edit User</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center"  href="../users">
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
                                <option value="Faculty" <?= ($role === 'Faculty') ? 'selected' : '';?>>Faculty</option>
                                <option value="Student" <?= ($role === 'Student') ? 'selected' : '';?>>Student</option>
                            </select>
                        </div>
                    </div> 

                    <!-- Institute -->
                    <div id="institute-container" class="col-md-4">
                        <div class="mb-3">
                            <label>Institute</label>
                            <select class="form-select form-select-lg" id="institute" name="institute">
                                <option value="IBM" <?= ($institute === 'IBM') ? 'selected' : '';?>>IBM</option>
                                <option value="ICSLIS" <?= ($institute === 'ICSLIS') ? 'selected' : '';?>>ICSLIS</option>
                                <option value="IEAS" <?= ($institute === 'IEAS') ? 'selected' : '';?>>IEAS</option>
                            </select>
                        </div>
                    </div>

                    <!-- IBM Course -->
                    <div id="IBM-course-container" class="col-md-4">
                        <div class="mb-3">
                            <label>Course</label>
                            <select class="form-select form-select-lg" id="IBM-course" name="course">
                                <option clas="IBM" value="BSA" <?= ($course === 'BSA') ? 'selected' : '';?>>BSA</option>
                                <option clas="IBM" value="BSE" <?= ($course === 'BSE') ? 'selected' : '';?>>BSE</option>
                                <option clas="IBM" value="BSTM" <?= ($course === 'BSTM') ? 'selected' : '';?>>BSTM</option>
                            </select>
                        </div>
                    </div>

                    <!-- ICSLIS Course -->
                    <div id="ICSLIS-course-container" class="col-md-4">
                        <div class="mb-3">
                            <label>Course</label>
                            <select class="form-select form-select-lg" id="ICSLIS-course" name="course">
                                <option clas="ICSLIS" value="ACT" <?= ($course === 'ACT') ? 'selected' : '';?>>ACT</option>
                                <option clas="ICSLIS" value="BSCS" <?= ($course === 'BSCS') ? 'selected' : '';?>>BSCS</option>
                                <option clas="ICSLIS" value="BSIS" <?= ($course === 'BSIS') ? 'selected' : '';?>>BSIS</option>
                                <option clas="ICSLIS" value="BLIS" <?= ($course === 'BLIS') ? 'selected' : '';?>>BLIS</option>
                            </select>
                        </div>
                    </div>

                    <!-- IEAS Course -->
                    <div id="IEAS-course-container" class="col-md-4">
                        <div class="mb-3">
                            <label>Course</label>
                            <select class="form-select form-select-lg" id="IEAS-course" name="course">
                                <option clas="IEAS" value="BSM" <?= ($course === 'BSM') ? 'selected' : '';?>>BSM</option>
                                <option clas="IEAS" value="BSNE" <?= ($course === 'BSNE') ? 'selected' : '';?>>BSNE</option>
                                <option clas="IEAS" value="BSP" <?= ($course === 'BSP') ? 'selected' : '';?>>BSP</option>
                                <option clas="IEAS" value="BPE" <?= ($course === 'BPE') ? 'selected' : '';?>>BPE</option>
                                <option clas="IEAS" value="BTVTED" <?= ($course === 'BTVTED') ? 'selected' : '';?>>BTVTED</option>
                                <option clas="IEAS" value="BAELS" <?= ($course === 'BAELS') ? 'selected' : '';?>>BAELS</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Username -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Username</label>
                            <input class="form-control form-control-lg" type="text" id="username" name="username" value="<?= $username ?>" required>
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
                            <input class="form-control form-control-lg" id="firstname" type="text" name="firstname"  value="<?= $firstname ?>" required>
                        </div>
                    </div>

                    <!-- Middlename -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Middle Name</label>
                            <input class="form-control form-control-lg" id="middlename" type="text" name="middlename"  value="<?= $middlename ?>">
                        </div>
                    </div>

                </div>

                <div class="row">

                    <!-- Lastname -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Last Name</label>
                            <input class="form-control form-control-lg" id="lastname" type="text" name="lastname"  value="<?= $lastname ?>" required>
                        </div>
                    </div>

                    <!-- Suffix -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Suffix</label>
                            <input class="form-control form-control-lg" id="suffix" type="text" name="suffix" value="<?= $suffix ?>">
                        </div>
                    </div>

                </div>
            </div>

            <div class="text-end">
                <!-- Hide restricted fields -->
                <input type='hidden' name='userId' value='<?= $userId ?>'>
                <input type='hidden' name='role' value='<?= $role ?>'>

                <!-- Submit button -->
                <button class="btn btn-primary btn-lg" id="submitButton" name="submitEditUser" type="submit">
                    Submit
                </button>
            </div>
    </form>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<script> 
function setCourses(){
    var role = document.getElementById("role").value;
    var institute = document.getElementById("institute").value;
    var courseContainerId = institute + "-course-container";
    var courseId = institute + "-course";

    document.getElementById("IBM-course").disabled = true;
    document.getElementById("ICSLIS-course").disabled = true;
    document.getElementById("IEAS-course").disabled = true;
    document.getElementById("IBM-course-container").style.display = "none";
    document.getElementById("ICSLIS-course-container").style.display = "none";
    document.getElementById("IEAS-course-container").style.display = "none";

    document.getElementById(courseId).disabled = false;
    document.getElementById(courseContainerId).style.display = "block";
    
}

setCourses();

$('#institute').on('change', function() {
    setCourses()
})

// Disable role selection
document.getElementById("role").disabled = true;
</script>