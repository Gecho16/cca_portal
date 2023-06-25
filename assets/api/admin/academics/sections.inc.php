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
		0 => 'section.id',
		1 => 'section.id',
		2 => 'section.section',
		3 => 'section.course',
		4 => 'section.year_level',
		5 => 'section.adviser',
		6 => 'section.academic_year',
		7 => '',
	);
	
	$where = $sqlTot = $sqlRec = "";

	// Set leading sql string
	$sql = "SELECT 	section.*,
					acad_year.year,
					acad_year.semester
			FROM	sections AS section
					INNER JOIN academic_years AS acad_year ON section.academic_year = acad_year.id";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE section.section LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR section.course LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR section.year_level LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR section.adviser LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR section.academic_year LIKE '%" . $request["search"]["value"] . "%'";
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
			$section = $row["section"];
			$course = $row["course"];
			$year = $row["year_level"];
			$adviser = $row["adviser"];
			$academic_year = $row["year"];
			$semester = $row["semester"];

            // Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

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

			// Adviser
			if ($adviser === null || $adviser === "") {
				$adviser = "- - -";
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
			$actionBullet .= "	<a class='dropdown-item' href='section/edit?section=" . $id . "' title='edit'>
									Edit
								</a>";
			$actionBullet .= "	<button type='button' class='dropdown-item'' data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-name='" . $section . "' data-bs-href='../../assets/includes/admin/academics/section.inc.php?deleteSection&id=" . $id . "' title='delete'>
								Delete
							</button>";
			$actionBullet .= "</div>";
			$actionBullet .= "</div>";

			$subdata = array();

			// Data to array
			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $section;
			$subdata[] = $course;
			$subdata[] = $year;
			$subdata[] = $adviser;
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