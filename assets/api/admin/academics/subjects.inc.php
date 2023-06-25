<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_GET["selectYear"])) {

	// initialize all variables
	$request = $columns = $totalRecords = $data = array();
	$request = $_REQUEST;

	// define index of column
	$columns = array( 
		0 => 'id',
		1 => 'id',
		2 => 'subject_code',
		3 => 'subject_title',
		4 => 'lecture_hours',
		5 => 'laboratory_hours',
		6 => 'credited_units',
		7 => '`prerequisite(s)`',
		8 => 'year',
		9 => '',
	);
	
	$where = $sqlTot = $sqlRec = "";

	// Set leading sql string
	$sql = "SELECT * FROM subjects";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE subject_code LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR subject_title LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR year LIKE '%" . $request["search"]["value"] . "%'";
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
			$subject_code = $row["subject_code"];
			$subject_title = $row["subject_title"];
			$lecture_hours = $row["lecture_hours"];
			$laboratory_hours = $row["laboratory_hours"];
			$credited_units = $row["credited_units"];
			$prerequisite = $row["prerequisite(s)"];
			$year = $row["year"];

            // Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

			// Lecture Hours
			if($lecture_hours == 0){
				$lecture_hours = "None";
			}else if($lecture_hours == 1){
				$lecture_hours = "<b>" . $row["lecture_hours"] . "</b> Hour";
			}else{
				$lecture_hours = "<b>" . $row["lecture_hours"] . "</b> Hours";
			}
			
			// Laboratory Hours
			if($laboratory_hours == 0){
				$laboratory_hours = "None";
			}else if($laboratory_hours == 1){
				$laboratory_hours = "<b>" . $row["laboratory_hours"] . "</b> Hour";
			}else{
				$laboratory_hours = "<b>" . $row["laboratory_hours"] . "</b> Hours";
			}
			
			// Credited Units
			if($credited_units == 0){
				$credited_units = "None";
			}else if($credited_units == 1){
				$credited_units = "<b>" . $row["credited_units"] . "</b> Unit";
			}else{
				$credited_units = "<b>" . $row["credited_units"] . "</b> Units";
			}

			// Prerequisites
			if ($prerequisite === null || $prerequisite === "") {
				$prerequisite = "None";
			} else {
				$prerequisite = $prerequisite;
			}

			// Year Level
			if ($year == 1) {
				$year = $year . "<sup>st</sup> Year";
			}else if ($year == 2) {
				$year = $year . "<sup>nd</sup> Year";
			}else if ($year == 3) {
				$year = $year . "<sup>rd</sup> Year";
			}else if ($year == 4) {
				$year = $year . "<sup>th</sup> Year";
			}else {
				$year = "None";
			}

			//Action Bullet 
			$actionBullet = "";
			$actionBullet .= "<div class='btn-group d-flex justify-content-end'>";
			$actionBullet .= "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
			$actionBullet .= "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
			$actionBullet .= "</button>";
			$actionBullet .= "<div class='dropdown-menu' id='dropdown-container'>";
			$actionBullet .= "	<a class='dropdown-item' href='subject/edit?subject=" . $id . "' title='edit'>
									Edit
								</a>";
			$actionBullet .= "	<button type='button' class='dropdown-item'' data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-name='" . $subject_code . "' data-bs-href='../../assets/includes/admin/academics/subject.inc.php?deleteSubject&id=" . $id . "' title='delete'>
								Delete
							</button>";
			$actionBullet .= "</div>";
			$actionBullet .= "</div>";

			$subdata = array();

			// Data to array
			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $subject_code;
			$subdata[] = $subject_title;
			$subdata[] = $lecture_hours;
			$subdata[] = $laboratory_hours;
			$subdata[] = $credited_units;
			$subdata[] = $prerequisite;
			$subdata[] = $year;
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