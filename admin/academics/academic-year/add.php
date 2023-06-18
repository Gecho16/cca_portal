<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

$year_start = range(strftime("%Y", time()), 2098);

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Add Acacdemic Year</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/academic-year.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <!-- Year -->
                    <div class="col-md-6">
                        <label>Year</label>
                        <select class="form-control form-control-lg" id="year" name="year" required>
                            <?php foreach($year_start as $year) : ?>
                                <?php $year_end = $year + 1; ?>
                                <option value="<?= $year . '-' . $year_end; ?>"><?= $year . '-' . $year_end; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Semester</label>
                            <select class="form-select form-select-lg" id="semester" name="semester" required>
                                <option value="1st" >1st</option>
                                <option value="2nd" >2nd</option>
                                <option value="Summer" >Summer</option>
                            </select>
                        </div>
                    </div> 

            </div>

            <!-- Submit button -->
            <div class="text-end">
                <button class="btn btn-primary btn-lg" name="submitAddYear" type="submit">
                    Submit
                </button>
            </div>
        </div>
    </form>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>
