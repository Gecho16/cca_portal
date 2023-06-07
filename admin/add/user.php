<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "users";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Add User</h1>

    <a class="btn btn-primary d-flex justify-content-between align-items-center" href="../users">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card">
    <form class="card-body" id="form"  action="../../assets/includes/admin/user.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Institute</label>
                            <select class="form-select form-select-lg" name="institute">
                                <option value="ICSLIS" selected>ICSLIS</option>
                                <option value="IBM">IBM</option>
                                <option value="IEAS">IEAS</option>
                            </select>
                        </div>
                    </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>Role</label>
                                    <select class="form-select form-select-lg" name="role" required>                             
                                        <option value="faculty" >faculty</option>
                                        <option value="student" selected>student</option>
                                    </select>
                                </div>
                            </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Username</label>
                            <input class="form-control form-control-lg" type="text" name="username" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Email Address</label>
                            <input class="form-control form-control-lg" type="email" name="emailAddress" required>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>First Name</label>
                            <input class="form-control form-control-lg" type="text" name="firstname" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Middle Name</label>
                            <input class="form-control form-control-lg" type="text" name="middlename">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Last Name</label>
                            <input class="form-control form-control-lg" type="text" name="lastname" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-success btn-lg" id="submitButton" name="submitAddUser" type="submit">
                    Submit
                </button>
            </div>
    </form>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>