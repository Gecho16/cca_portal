<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get entry info
$acad_year = sanitize($_GET["acad_year"]);
$sql = "SELECT year, semester FROM academic_years WHERE id = '$acad_year'";
$result_acad_year = mysqli_query($conn, $sql);
$row_acad_year = mysqli_fetch_assoc($result_acad_year);

// Set Variables
$year_db = $row_acad_year['year'];
$semester_db = $row_acad_year['semester'];

$year_start = range(2020, 2098);

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Edit Acacdemic Year</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../?table=academic-year">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/academic-year.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Academic Year Information</label>
                    <!-- Year -->
                    <div class="col-md-6">
                        <label>Year</label>
                        <select class="form-control form-control-lg" id="year" name="year" required>
                            <?php foreach($year_start as $year) : ?>
                                <?php $year_end = $year + 1; ?>
                                <option value="<?= $year . '-' . $year_end; ?>" <?= ($year . '-' . $year_end === $year_db) ? 'selected' : '';?>><?= $year . '-' . $year_end; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Semester</label>
                            <select class="form-select form-select-lg" id="semester" name="semester" required>
                                <option value="1st" <?= ($semester_db === "1st") ? 'selected' : '';?>>1st</option>
                                <option value="2nd" <?= ($semester_db === "2nd") ? 'selected' : '';?>>2nd</option>
                                <option value="Summer" <?= ($semester_db === "Summer") ? 'selected' : '';?>>Summer</option>
                            </select>
                        </div>
                    </div> 

            </div>

            <!-- Submit button -->
            <div class="text-end">
                <button class="btn btn-primary btn-lg" name="submitEditYear" value="<?= $acad_year ?>" type="submit">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>
