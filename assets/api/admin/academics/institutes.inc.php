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
		2 => 'institute_code',
		3 => 'institute_name',
		4 => 'dean',
		5 => '',
	);
	
	$where = $sqlTot = $sqlRec = "";

	// Set leading sql string
	$sql = "SELECT * FROM institutes";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE institute_code LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR institute_name LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR dean LIKE '%" . $request["search"]["value"] . "%'";
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
			$institute_code = $row["institute_code"];
			$institute_name = $row["institute_name"];
			$dean = $row["dean"];

            // Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

			// Dean
			if (($dean === null || $dean === "") && ($institute_code == "MISSO" || $institute_code == "NTPs")) {
				$institute_dean = "N/A";
			} else if ($dean === null || $dean === ""){
				$institute_dean = "- - -";
			} else {
				$institute_dean = $dean;
			}

			//Action Bullet 
			$actionBullet = "";
			$actionBullet .= "<div class='btn-group d-flex justify-content-end'>";
			$actionBullet .= "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
			$actionBullet .= "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
			$actionBullet .= "</button>";
			$actionBullet .= "<div class='dropdown-menu' id='dropdown-container'>";
			$actionBullet .= "	<a class='dropdown-item' href='institute/edit?institute=" . $id . "' title='edit'>
									Edit
								</a>";
			$actionBullet .= "	<button type='button' class='dropdown-item'' data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-name='" . $institute_code . "' data-bs-href='../../assets/includes/admin/academics/institute.inc.php?deleteInstitute&id=" . $id . "' title='delete'>
									Delete
								</button>";
			$actionBullet .= "</div>";
			$actionBullet .= "</div>";

			$subdata = array();

			// Data to array
			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $institute_code;
			$subdata[] = $institute_name;
			$subdata[] = $institute_dean;
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