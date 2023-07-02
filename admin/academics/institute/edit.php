<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get entry info
$institute = sanitize($_GET["institute"]);
$sql = "SELECT institute_name, institute_code FROM institutes WHERE id = '$institute'";
$result_institute = mysqli_query($conn, $sql);
$row_institute = mysqli_fetch_assoc($result_institute);

// Set Variables
$institute_name = $row_institute['institute_name'];
$institute_code = $row_institute['institute_code'];

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Edit Institute</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../?table=institutes">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/institute.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Institute Information</label>
                    <!-- Institute Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Institute Name</label>
                            <input type="text" class="form-select form-select-lg" id="institute_name" name="institute_name" value="<?= $institute_name; ?>" required>
                            </input>
                        </div>
                    </div> 

                    <!-- Institute Code -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Institute Code</label>
                            <input type="text" class="form-select form-select-lg" id="institute_code" name="institute_code" value="<?= $institute_code; ?>" required>
                            </input>
                        </div>
                    </div>

                </div>
                </div>

                <!-- Submit button -->
                <div class="text-end">
                    <button class="btn btn-primary btn-lg" name="submitEditInstitute" value="<?= $institute ?>" type="submit">
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
    // Institute Name
    var institute_name = document.getElementById('institute_name');

    institute_name.addEventListener('input', function() {
        let words = institute_name.value.split(' ');

        // Capitalize the first letter of each word
        for (let i = 0; i < words.length; i++) {
            let word = words[i];
            words[i] = word.charAt(0).toUpperCase() + word.slice(1);
        }

        // Join the words back into a string
        institute_name.value = words.join(' ');
    });

    // Institute Code
    var institute_code = document.getElementById('institute_code');

    institute_code.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z]/g, '').toUpperCase();
        if (this.value.length > 8) {
            this.value = this.value.substring(0, 8);
        }
    });

    // Names
    // var names = document.querySelectorAll('.names');

    // for (var i = 0; i < names.length; i++) {
    //     names[i].addEventListener('input', function(event) {
    //         var currentValue = event.target.value;
    //         var words = currentValue.split(' ');
    //         for (var j = 0; j < words.length; j++) {
    //             words[j] = words[j].charAt(0).toUpperCase() + words[j].slice(1);
    //         }
    //         var capitalizedValue = words.join(' ');
    //         event.target.value = capitalizedValue;
    //     });
    // }
</script>
