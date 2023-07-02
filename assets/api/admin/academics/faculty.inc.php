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
		2 => 'lastname',
		3 => 'firstname',
		4 => 'lastname',
		5 => 'middlename',
		6 => 'suffix',
		7 => 'institute',
		8 => 'reference_number',
		9 => 'type',
		10 => '',
	);
	
	$where = $sqlTot = $sqlRec = "";

	// Set leading sql string
	$sql = "SELECT * FROM faculty";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE firstname LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR lastname LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR middlename LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR suffix LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR institute LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR reference_number LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR type LIKE '%" . $request["search"]["value"] . "%'";
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
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$middlename = $row["middlename"];
			$middle_initital = substr($middlename, 0, 1);
			$suffix = $row["suffix"];
			$institute = $row["institute"];
			$reference_number = $row["reference_number"];
			$type = $row["type"];

			// Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

			// Fullname
			if(($middlename === null || $middlename === "") && ($suffix === null || $suffix === "")){
				$fullname = $lastname . ", " . $firstname;
			}else if ($middlename === null || $middlename === "") {
				$fullname = $lastname . ", " . $firstname . $suffix ;
			}else if($suffix === null || $suffix === ""){
				$fullname = $lastname . ", " . $firstname . " " . $middle_initital . ".";
			}else{
				$fullname = $lastname . ", " . $firstname . " " . $middle_initital . ". " . $suffix ;
			}

			// Middlename
			if ($middlename === null || $middlename === "") {
				$middlename = "- - -";
			}

			// Suffix
			if ($suffix === null || $suffix === "") {
				$suffix = "- - -";
			}

			// Status
			if ($type == "COS Full Time") {
			    $type = "<span class='badge bg-info'>" . $type . "</span>";
			} else if ($type == "COS Part Time") {
				$type = "<span class='badge bg-warning'>" . $type . "</span>";
			} else if ($type == "Plantilla Permanent") {
				$type = "<span class='badge bg-success'>" . $type . "</span>";
			} else if ($type == "Plantilla Temporary") {
				$type = "<span class='badge bg-primary'>" . $type . "</span>";
			} else {
				$type = "None";
			}

			//Action Bullet 
			$actionBullet = "";
			$actionBullet .= "<div class='btn-group d-flex justify-content-end'>";
			$actionBullet .= "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
			$actionBullet .= "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
			$actionBullet .= "</button>";
			$actionBullet .= "<div class='dropdown-menu' id='dropdown-container'>";
			$actionBullet .= "	<a class='dropdown-item' href='faculty/edit?faculty=" . $id . "' title='edit'>
									Edit
								</a>";
			$actionBullet .= "	<button type='button' class='dropdown-item'' data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-name='" . $reference_number . "' data-bs-href='../../assets/includes/admin/academics/faculty.inc.php?deleteFaculty&id=" . $id . "' title='delete'>
									Delete
								</button>";
			$actionBullet .= "</div>";
			$actionBullet .= "</div>";

			$subdata = array();

			// Data to array
			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $fullname;
			$subdata[] = $lastname;
			$subdata[] = $firstname;
			$subdata[] = $middlename;
			$subdata[] = $suffix;
			$subdata[] = $institute;
			$subdata[] = $reference_number;
			$subdata[] = $type;
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