<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

// Get subject code
$subject_code1 = "SELECT subject_code FROM subjects WHERE year = 1";
$result_subject_code1 = mysqli_query($conn, $subject_code1);

$subject_code2 = "SELECT subject_code FROM subjects WHERE year = 2";
$result_subject_code2 = mysqli_query($conn, $subject_code2);

$subject_code3 = "SELECT subject_code FROM subjects WHERE year = 3";
$result_subject_code3 = mysqli_query($conn, $subject_code3);

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">   
    <h1 class="h3 mb-0">Add Subject</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../?table=subjects">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/subject.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Subject Information</label>
                    <!-- Subject Name -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Subject Name</label>
                            <input type="text" class="form-select form-select-lg" id="subject_title" name="subject_title" required>
                            </input>
                        </div>
                    </div>
                    
                    <!-- Subject Code-->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Subject Code</label>
                            <input type="text" class="form-select form-select-lg" id="subject_code" name="subject_code" required>
                            </input>
                        </div>
                    </div>

                    <!-- Year Level -->
                    <div class="col-md-4">
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
                </div>

                <div class="row">
                    <!-- Lecture Hours -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Lecture Hours</label>
                            <select class="form-select form-select-lg hours-units" id="lecture_hours" name="lecture_hours" required>
                                <option value="0">None</option>
                                <?php
                                $maxHours = 16;
                                for ($i = 1; $i <= $maxHours; $i++) {
                                    ?>
                                    <option value="<?= $i ?>"> <?= $i ?>  Hour<?= ($i > 1) ? 's' : '';?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Laboratory Hours -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Laboratory Hours</label>
                            <select class="form-select form-select-lg hours-units" id="laboratory_hours" name="laboratory_hours" required>
                                <option value="0">None</option>
                                <?php
                                $maxHours = 16;
                                for ($i = 1; $i <= $maxHours; $i++) {
                                    ?>
                                    <option value="<?= $i ?>"> <?= $i ?>  Hour<?= ($i > 1) ? 's' : '';?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Credited Units -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Credited Units</label>
                            <select class="form-select form-select-lg hours-units" id="credited_units" name="credited_units" required>
                                <option value="0">None</option>
                                <?php
                                $masUnits = 16;
                                for ($i = 1; $i <= $masUnits; $i++) {
                                    ?>
                                    <option value="<?= $i ?>"> <?= $i ?>  Unit<?= ($i > 1) ? 's' : '';?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <!-- Pre-requisite -->
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label>Pre-requisite</label>
                            <select class="form-select form-select-lg" id="prerequisite" name="prerequisite" required>
                                <option value="">None</option>
                                <?php while ($row = mysqli_fetch_assoc($result_subject_code1)) { $subject_code1 = $row['subject_code']; ?>
                                    <option value="<?php echo $subject_code1; ?>" class="subject_year subject_year1 d-none"><?php echo $subject_code1; ?></option>
                                <?php } ?>

                                <?php while ($row = mysqli_fetch_assoc($result_subject_code2)) { $subject_code2 = $row['subject_code']; ?>
                                    <option value="<?php echo $subject_code2; ?>" class="subject_year subject_year2 d-none"><?php echo $subject_code2; ?></option>
                                <?php } ?>

                                <?php while ($row = mysqli_fetch_assoc($result_subject_code3)) { $subject_code3 = $row['subject_code']; ?>
                                    <option value="<?php echo $subject_code3; ?>" class="subject_year subject_year3 d-none"><?php echo $subject_code3; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="text-end">
                        <button class="btn btn-primary btn-lg" name="submitAddSubject" type="submit">
                            Submit
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<script>
    // Subject Name
    var subject_title = document.getElementById('subject_title');

    subject_title.addEventListener('input', function() {
        let words = subject_title.value.split(' ');

        // Capitalize the first letter of each word
        for (let i = 0; i < words.length; i++) {
            let word = words[i];
            words[i] = word.charAt(0).toUpperCase() + word.slice(1);
        }

        // Join the words back into a string
        subject_title.value = words.join(' ');
    });

    // Subject Code
    var subject_code = document.getElementById('subject_code');

    subject_code.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
        if (this.value.length > 10) {
            this.value = this.value.substring(0, 10);
        }
    });

    // Subject Code
    var year = document.getElementById('year');
    var prerequisite = document.getElementById('prerequisite');

    function setPreRequisite(){
        var subject_year = document.querySelectorAll('.subject_year');

        var subject_year1 = document.querySelectorAll('.subject_year1');
        var subject_year2 = document.querySelectorAll('.subject_year2');
        var subject_year3 = document.querySelectorAll('.subject_year3');

        if(year.value == 1){
            prerequisite.value= "";
            prerequisite.disabled = true;

        } else  if(year.value == 2){
            prerequisite.disabled = false;
            prerequisite.value = subject_year[0].value;

            for (var i = 0; i < subject_year.length; i++) {
                subject_year[i].classList.remove('d-block');
                subject_year[i].classList.add('d-none');
            }

            for (var i = 0; i < subject_year1.length; i++) {
                subject_year1[i].classList.remove('d-none');
                subject_year1[i].classList.add('d-block');
            }

        } else  if(year.value == 3){
            prerequisite.disabled = false;
            prerequisite.value = subject_year[0].value;

            for (var i = 0; i < subject_year.length; i++) {
                subject_year[i].classList.remove('d-block');
                subject_year[i].classList.add('d-none');
            }

            for (var i = 0; i < subject_year1.length; i++) {
                subject_year1[i].classList.remove('d-none');
                subject_year1[i].classList.add('d-block');
            }
            
            for (var i = 0; i < subject_year2.length; i++) {
                subject_year2[i].classList.remove('d-none');
                subject_year2[i].classList.add('d-block');
            }

        } else  if(year.value == 4){
            prerequisite.disabled = false;
            prerequisite.value = subject_year[0].value;

            for (var i = 0; i < subject_year.length; i++) {
                subject_year[i].classList.remove('d-none');
                subject_year[i].classList.add('d-block');
            }
        }
    }

    setPreRequisite();

    year.addEventListener('input', function() {
        setPreRequisite()
    });
</script>
