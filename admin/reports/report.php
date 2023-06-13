<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "reports";

include $baseUrl . "assets/templates/admin/header.inc.php";

if(isset($_POST['submitbutton'])){
    $id = $_POST['submitbutton'];
}

// Get Info
$sql = "SELECT 	reports.*,
                faculty.id AS faculty_id,
                faculty.firstname AS firstname,
                faculty.lastname AS lastname,
                faculty.middlename AS middlename,
                faculty.suffix AS suffix,
                acad_year.year AS year,
                acad_year.semester AS semester
        FROM 	evaluation_reports AS reports
                INNER JOIN faculty AS faculty ON reports.faculty = faculty.id
                INNER JOIN academic_years AS acad_year ON reports.academic_year = acad_year.id
        WHERE   reports.id = $id";
$result= mysqli_query($conn, $sql);
$row= mysqli_fetch_assoc($result);

// Set Variables
$id = $row['id'];
$faculty = $row["faculty"];
$reference_number = $row["reference_number"];
$vpaa = $row["vpaa"];
$dean = $row["dean"];
$coordinator = $row["coordinator"];
$student = $row["student"];
$peer = $row["peer"];
$self = $row["self"];
$overall = $row["overall"];
$remarks = $row["remarks"];
$firstname = $row["firstname"];
$lastname = $row["lastname"];
$middlename = $row["middlename"];
$suffix = $row["suffix"];
$academic_year = $row["year"];
$semester = $row["semester"];

// Faculty Name
if ($middlename === null || $middlename === "") {
    $fullname = $lastname . " " . $suffix . ", " . $firstname;
}else if($suffix === null || $suffix === ""){
    $fullname = $lastname . ", " . $firstname . " " . $middlename;
}else if(($middlename === null || $middlename === "") || ($suffix === null || $suffix === "")){
    $fullname = $lastname . ", " . $firstname;
}else{
    $fullname = $lastname . " " . $suffix . ", " . $firstname . " " . $middlename;
}

// Academic Year
if($semester != "Summer"){
    $semester .= " Semester";
}
$academic_year = "A.Y. " . $academic_year . " " . $semester; 

?>

<!-- BODY HEADERS -->
<div class="d-flex flex-column justify-content-between align-items-center mb-3">
    <div class="d-flex flex-row justify-content-end w-100 d-print-none">
        <a class="btn btn-secondary d-flex justify-content-between align-items-center m-2"  href="../reports">
            <i class="fa-solid fa-chevron-left me-2"></i>
            Back
        </a>
        <button class="btn btn-primary d-flex justify-content-between align-items-center m-2" onclick="window.print();">
            <i class="fa-solid fa-print me-2"></i>
            Print
        </button>
    </div>
    <div class="d-flex flex-column align-items-center w-100">
        <div class="card d-flex flex-column align-items-center w-100">
            <div class="card-header ">
                <img src="../../assets/images/photos/cca-logo.png" alt="CCA-logo" style="width: 5rem;">
            </div>
            <div class="card-body d-flex flex-column align-items-center w-100 text-center">
                <h1 class="card-title">Faculty Performance Evaluation</h1>
                <p class="card-text"><?= $academic_year ?></p>
                <table class="table table-bordered" style="border-bottom: 2px solid var(--green);">
                    <thead>
                        <tr class="bg-secondary"  style="color: white;">
                            <th rowspan = 2>Name</th>
                            <th colspan = 3>Classroom Observations</th>
                            <th rowspan = 2>Student Evaluation</th>
                            <th colspan = 2>Peer Evaluation</th>
                            <th rowspan = 2>Self Evaluation</th>
                            <th rowspan = 2>Overall Rating</th>
                            <th rowspan = 2>Remarks</th>
                        </tr>
                        <tr class="bg-secondary"  style="color: white;">
                            <th>VPAA</th>
                            <th>Dean</th>
                            <th>Coordinator</th>
                            <th>Peer 1</th>
                            <th>Peer 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $fullname ?></td>
                            <td><?= $vpaa ?></td>
                            <td><?= $dean ?></td>
                            <td><?= $coordinator ?></td>
                            <td><?= $student ?></td>
                            <td><?= $peer ?></td>
                            <td><?= $peer ?></td>
                            <td><?= $self ?></td>
                            <td><?= $overall ?></td>
                            <td><?= $remarks ?></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>