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
		2 => 'room_code',
		3 => 'room_name',
		4 => 'type',
		5 => 'location',
		6 => 'status',
		7 => '',
	);
	
	$where = $sqlTot = $sqlRec = "";

	// Set leading sql string
	$sql = "SELECT * FROM rooms";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE room_code LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR room_name LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR type LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR location LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR status LIKE '%" . $request["search"]["value"] . "%'";
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
			$room_code = $row["room_code"];
			$room_name = $row["room_name"];
			$type = $row["type"];
			$location = $row["location"];
			$status = $row["status"];

            // Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

			// Type
			if ($type == "Laboratory") {
				$type = "<span class='badge bg-danger'>" . $type . "</span>";
			} else if ($type == "Lecture") {
				$type = "<span class='badge bg-primary'>" . $type . "</span>";
			} else if ($type == "Gmeet") {
				$type = "<span class='badge bg-success'>" . $type . "</span>";
			} else {
				$type = "None";
			}

			// Status
			if ($status == "Available") {
			    $status = "<span class='badge bg-success'>" . $status . "</span>";
			} else if ($status == "Occupied") {
				$status = "<span class='badge bg-danger'>" . $status . "</span>";
			} 	else {
				$status = "None";
			}

			//Action Bullet 
			$actionBullet = "";
			$actionBullet .= "<div class='btn-group d-flex justify-content-end'>";
			$actionBullet .= "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
			$actionBullet .= "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
			$actionBullet .= "</button>";
			$actionBullet .= "<div class='dropdown-menu' id='dropdown-container'>";
			$actionBullet .= "	<a class='dropdown-item' href='room/edit?room=" . $id . "' title='edit'>
									Edit
								</a>";
			$actionBullet .= "	<button type='button' class='dropdown-item'' data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-name='" . $room_code . "' data-bs-href='../../assets/includes/admin/academics/room.inc.php?deleteRoom&id=" . $id . "' title='delete'>
									Delete
								</button>";
			$actionBullet .= "</div>";
			$actionBullet .= "</div>";

			$subdata = array();

			// Data to array
			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $room_code;
			$subdata[] = $room_name;
			$subdata[] = $type;
			$subdata[] = $location;
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