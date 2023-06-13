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
		0 => 'reports.id',
		1 => 'reports.id',
		2 => 'faculty.lastname',
		3 => 'reports.reference_number',
		4 => 'reports.date',
		5 => 'reports.day',
		6 => 'reports.time_in',
		7 => 'reports.time_out',
		8 => 'reports.status',
		9 => 'reports.total_hours',
		10 => 'reports.remarks',
		11 => '',
		12 => '',

	);
	
	$where = $sqlTot = $sqlRec = "";

	// getting total number records without any search
	$sql = "SELECT 	reports.*,
					faculty.firstname AS firstname,
					faculty.lastname AS lastname,
					faculty.middlename AS middlename,
					faculty.suffix AS suffix
			FROM 	dtr_reports AS reports
					INNER JOIN faculty AS faculty ON reports.faculty = faculty.id";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE ";
		$where .= " reports.faculty  LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR reports.reference_number LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR reports.date LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR reports.day LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR reports.time_in LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR reports.time_out LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR reports.status LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR reports.total_hours LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR reports.remarks LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.firstname LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.lastname LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.middlename LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.suffix LIKE '%" . $request["search"]["value"] . "%' ";
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
			$faculty = $row["faculty"];
			$reference_number = $row["reference_number"];
			$date = $row["date"];
			$day = $row["day"];
			$time_in = $row["time_in"];
			$time_out = $row["time_out"];
			$status = $row["status"];
			$total_hours = $row["total_hours"];
			$remarks = $row["remarks"];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$middlename = $row["middlename"];
			$suffix = $row["suffix"];

			// Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

			// Faculty
			if ($middlename === null || $middlename === "") {
				$fullname = $lastname . " " . $suffix . ", " . $firstname;
			}else if($suffix === null || $suffix === ""){
				$fullname = $lastname . ", " . $firstname . " " . $middlename;
			}else if(($middlename === null || $middlename === "") || ($suffix === null || $suffix === "")){
				$fullname = $lastname . ", " . $firstname;
			}else{
				$fullname = $lastname . " " . $suffix . ", " . $firstname . " " . $middlename;
			}

			// Remarks
			if ($remarks === null || $remarks === "") {
				$remarks = "- - -";
			}

			// View
			$view = "<form action='../reports/report' method='POST' class='d-flex justify-content-start'><button type='submit' class='btn btn-sm rounded btn-primary' title='View' name='submitbutton' value=" . $id . " >View</button></form>";
			
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
			$subdata[] = $date;
			$subdata[] = $day;
			$subdata[] = $time_in;
			$subdata[] = $time_out;
			$subdata[] = $status;
			$subdata[] = $total_hours;
			$subdata[] = $remarks;
			$subdata[] = $view;
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