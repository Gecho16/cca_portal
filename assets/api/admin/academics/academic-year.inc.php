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
		1 => 'year',
		2 => 'year',
		3 => 'semester',
		4 => 'is_active',
		5 => '',
	);
	
	$where = $sqlTot = $sqlRec = "";

	// Set leading sql string
	$sql = "SELECT * FROM academic_years";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE year LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR semester LIKE '%" . $request["search"]["value"] . "%'";
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
			$year = $row["year"];
			$semester = $row["semester"];
			$is_active = $row["is_active"];

            // Full Year
            $fullYear = "A.Y. " . $year . " " . $semester;

            if($semester != "Summer"){
                $fullYear .= " Semester";
            }

            // Status
            if($is_active == 1){
                $status =	"<button type='button' class='btn btn-success btn-sm' title='activated'>
                                <i class='fa-solid fa-toggle-on'></i>
                            </button>";
            }else{
				$status =	"<button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#activateModal' data-bs-name='" . $fullYear . "' data-bs-href='../../assets/includes/admin/academics/academic-year.inc.php?activateAcadYear&id=" . $row["id"] . "' title='activate'>
                                <i class='fa-solid fa-toggle-off'></i>
                            </button>";
            }

			//Action Bullet 
			$actionBullet = "";
			$actionBullet .= "<div class='btn-group d-flex justify-content-end'>";
			$actionBullet .= "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
			$actionBullet .= "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
			$actionBullet .= "</button>";
			$actionBullet .= "<div class='dropdown-menu' id='dropdown-container'>";
			$actionBullet .= "	<a class='dropdown-item' href='academic-year/edit?acad_year=" . $id . "' title='edit'>
									Edit
								</a>";
			$actionBullet .= "	<button type='button' class='dropdown-item'' data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-name='" . $fullYear . "' data-bs-href='../../assets/includes/admin/academics/academic-year.inc.php?deleterAcadYear&id=" . $row["id"] . "' title='delete'>
									Delete
								</button>";
			
			$actionBullet .= "</div>";
			$actionBullet .= "</div>";

			$subdata = array();

			// Data to array
			$subdata[] = $id;
			$subdata[] = $fullYear;
			$subdata[] = $year;
			$subdata[] = $semester;
			$subdata[] = $status;
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