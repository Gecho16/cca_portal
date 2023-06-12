<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_GET["selectYear"])) {
	if($_GET["selectYear"] !== "All"){
		$acadYearId = $_GET["selectYear"];
		$sql = "SELECT * FROM academic_years WHERE id = $acadYearId";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

		$acadYear = $row['year']. ' ' .$row['semester'];
	}
	
	// initialize all variables
	$request = $columns = $totalRecords = $data = array();
	$request = $_REQUEST;

	// define index of column
	$columns = array( 
		0 => 'student.id',
		1 => 'student.id',

	);
	
	$where = $sqlTot = $sqlRec = "";

	// getting total number records without any search
	$sql = "SELECT 	clearance.id AS id,
					clearance.academics AS academics,
					clearance.library AS library,
					clearance.registrar AS registrar,
					clearance.remarks AS remarks,
					clearance.status AS status,
					student.id AS student_id,
					student.reference_number AS reference_number,
					student.firstname AS firstname,
					student.lastname AS lastname,
					student.middlename AS middlename,
					student.suffix AS suffix,
					student.course AS course,
					student.section AS section,
					acad_year.id AS acad_year_id,
					acad_year.year AS year,
					acad_year.semester AS semester
			FROM 	clearance AS clearance 
					INNER JOIN students AS student ON clearance.student = student.id
					INNER JOIN academic_years AS acad_year ON student.academic_year = acad_year.id";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE ";
		$where .= " institute LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR reference_number LIKE '%" . $request["search"]["value"] . "%' ";
	}

	// Set academic year
	if (!empty($request["search"]["value"] && $_GET["selectYear"] !== "All")) {
		$where .= " AND";
	}
	if($_GET["selectYear"] !== "All"){
		$where .= " WHERE student.academic_year = '$acadYearId'";	
	}

	$sqlTot .= $sql;
	$sqlRec .= $sql;

	// concatenate search sql if value exists
	if(isset($where) && $where != '') {
		$sqlTot .= $where;
		$sqlRec .= $where;
	}

	// Specify row order
	$sqlRec .=  " ORDER BY ". $columns[$request['order'][0]['column']]."   ".$request['order'][0]['dir'];

	// Limit number of rows
	if(intval($request['length']) !== -1){
		$sqlRec .= " LIMIT ".$request['start']." ,".$request['length'];
	}else{
		$sqlRec .= " LIMIT 0, 100000";
	}

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));
	$totalRecords = mysqli_num_rows($queryTot);

	// Fetch records
	$sqlRec .=  ";";

	$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch data");

	if (mysqli_num_rows($queryRecords) > 0) {
		while ($row = mysqli_fetch_assoc($queryRecords)) {

			// Variable transfer
			$id = $row["id"];
			$academics = $row["academics"];
			$library = $row["library"];
			$registrar = $row["registrar"];
			$remarks = $row["remarks"];
			$status = $row["status"];
			$reference_number = $row["reference_number"];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$middlename = $row["middlename"];
			$suffix = $row["suffix"];
			$course = $row["course"];
			$section = $row["section"];
			$academic_year = $row["year"];
			$semester = $row["semester"];

			// Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

			// Fullname
			if ($middlename === null || $middlename === "") {
				$fullname = $lastname . " " . $suffix . ", " . $firstname;
			}else if($suffix === null || $suffix === ""){
				$fullname = $lastname . ", " . $firstname . " " . $middlename;
			}else if(($middlename === null || $middlename === "") || ($suffix === null || $suffix === "")){
				$fullname = $lastname . ", " . $firstname;
			}else{
				$fullname = $lastname . " " . $suffix . ", " . $firstname . " " . $middlename;
			}

			// Academics
			if($academics == 1){
				$academics =	"<button type='button' class='btn btn-success btn-sm' title='activated'>
								<i class='fa-solid fa-toggle-on'></i>
							</button>";
			}else{
				$academics =	"<button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#activateModal' data-bs-name='academics" . $id ."' data-bs-href='../assets/includes/admin/academic-year.inc.php?activateAcademicYear&id=" . $row["id"] . "' title='activate'>
								<i class='fa-solid fa-toggle-off'></i>
							</button>";
			}

			// Library
			if($library == 1){
				$library =	"<button type='button' class='btn btn-success btn-sm' title='activated'>
								<i class='fa-solid fa-toggle-on'></i>
							</button>";
			}else{
				$library =	"<button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#activateModal' data-bs-name='library" . $id ."' data-bs-href='../assets/includes/admin/academic-year.inc.php?activateAcademicYear&id=" . $row["id"] . "' title='activate'>
								<i class='fa-solid fa-toggle-off'></i>
							</button>";
			}

			// Registrar
			if($registrar == 1){
				$registrar =	"<button type='button' class='btn btn-success btn-sm' title='activated'>
								<i class='fa-solid fa-toggle-on'></i>
							</button>";
			}else{
				$registrar =	"<button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#activateModal' data-bs-name='registrar" . $id ."' data-bs-href='../assets/includes/admin/academic-year.inc.php?activateAcademicYear&id=" . $row["id"] . "' title='activate'>
								<i class='fa-solid fa-toggle-off'></i>
							</button>";
			}

			// Remarks
			if ($remarks === null || $remarks === ""){
				$remarks = "- - -";
			}

			// Academic Year
			if($semester != "Summer"){
                $semester .= " Semester";
            }
			$academic_year = "A.Y. " . $academic_year . " " . $semester; 
			
			// Status
			if ($status == 0){
			    $status = "<span class='badge bg-warning'>Pending</span>";

			} else{
				$status = "<span class='badge bg-sucess'>Completed</span>";
			}

			//Action Bullet 
			$actionBullet = "";
			$actionBullet .= "<div class='btn-group d-flex justify-content-end'>";
			$actionBullet .= "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
			$actionBullet .= "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
			$actionBullet .= "</button>";
			$actionBullet .= "<div class='dropdown-menu' id='dropdown-container'>";
			$actionBullet .= "<button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#deleteSelectedModal' data-bs-name='' data-bs-href='../assets/includes/admin/user.inc.php?deleteSelectedUser' title='deleteSelected'>Option (Button)</button>";
			$actionBullet .= "<a class='dropdown-item' href='#' title='edit'>Option (Link)</a>";
			$actionBullet .= "</div>";
			$actionBullet .= "</div>";

			$subdata = array();

			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $fullname;
			$subdata[] = $reference_number;
			$subdata[] = $course;
			$subdata[] = $section;
			$subdata[] = $academic_year;
			$subdata[] = $academics;
			$subdata[] = $library;
			$subdata[] = $registrar;
			$subdata[] = $status;
			$subdata[] = $remarks;
			$subdata[] = $actionBullet;

			$data[] = $subdata;
		}
	}

	$jsonData = array(
		"draw"				=> intval($request['draw']),
		"recordsTotal"    	=> intval( $totalRecords ),  
		"recordsFiltered" 	=> intval($totalRecords),
		"data"            	=> $data   // total data array
		);

	echo json_encode($jsonData);  // send data as json format
}