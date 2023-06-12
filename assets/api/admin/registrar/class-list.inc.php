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
		2 => 'student.reference_number',
		3 => 'student.lastname',
		4 => 'student.firstname',
		5 => 'student.lastname',
		6 => 'student.middlename',
		7 => 'student.suffix',
		8 => 'student.course',
		9 => 'student.section',
		10 => 'student.year_level',
		11 => 'student.type',
		12 => 'student.academic_year',
		13 => '',

	);
	
	$where = $sqlTot = $sqlRec = "";

	// getting total number records without any search
	$sql = "SELECT 	student.id AS id,
					student.reference_number AS reference_number,
					student.firstname AS firstname,
					student.lastname AS lastname,
					student.middlename AS middlename,
					student.suffix AS suffix,
					student.course AS course,
					student.section AS section,
					student.year_level AS year_level,
					student.type AS type,
					student.academic_year AS academic_year,
					acad_year.id AS acad_year_id,
					acad_year.year AS year,
					acad_year.semester AS semester
			FROM 	students AS student
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
		$where .= " WHERE student.academic_year = " . $acadYearId;	
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
			$reference_number = $row["reference_number"];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$middlename = $row["middlename"];
			$suffix = $row["suffix"];
			$course = $row["course"];
			$section = $row["section"];
			$year_level = $row["year_level"];
			$type = $row["type"];
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

			// Middlename
			if ($middlename === null || $middlename === "") {
				$middlename = "- - -";
			}

			// Suffix
			if ($suffix === null || $suffix === "") {
				$suffix = "- - -";
			}

			// Year Level
			if ($year_level == 1) {
				$year_level = $year_level . "<sup>st</sup> Year";
			}else if ($year_level == 2) {
				$year_level = $year_level . "<sup>nd</sup> Year";
			}else if ($year_level == 3) {
				$year_level = $year_level . "<sup>rd</sup> Year";
			}else if ($year_level == 4) {
				$year_level = $year_level . "<sup>th</sup> Year";
			}else {
				$year_level = "None";
			}

			// Type
			if ($type == "Regular") {
			    $type = "<span class='badge bg-success'>" . $type . "</span>";
			} else if ($type == "Irregular") {
				$type = "<span class='badge bg-secondary'>" . $type . "</span>";
			} 	else {
				$type = "None";
			}

			// Academic Year
			if($semester != "Summer"){
                $semester .= " Semester";
            }

			$academic_year = "A.Y. " . $academic_year . " " . $semester; 

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

			// Data to array
			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $reference_number;
			$subdata[] = $fullname;
			$subdata[] = $firstname;
			$subdata[] = $lastname;
			$subdata[] = $middlename;
			$subdata[] = $suffix;
			$subdata[] = $course;
			$subdata[] = $section;
			$subdata[] = $year_level;
			$subdata[] = $type;
			$subdata[] = $academic_year;
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