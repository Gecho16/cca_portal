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
		0 => 'class.id',
		1 => 'class.id',
		2 => 'class.id',
		3 => 'class.id',
		4 => 'class.id',
		5 => 'class.id'
	);
	
	$where = $sqlTot = $sqlRec = "";

	// getting total number records without any search
	$sql = "SELECT 	DISTINCT class.id,
					class.academic_year
					FROM classes AS class";

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
		$where .= " WHERE class.academic_year = '$acadYearId'";	
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

			// Action Button
			$actionBullet = "<div class='d-flex justify-content-end'><button type='button' class='btn btn-sm rounded btn-primary' title='View report card'>View</button></div>";

			$subdata = array();

			// Data to array
			$subdata[] = '';
			$subdata[] = '';
			$subdata[] = '';
			$subdata[] = '';
			$subdata[] = '';
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