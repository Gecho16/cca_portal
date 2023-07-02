<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_POST["submitAddRoom"])) {
	// Fetch POST variables
	$room_name = sanitize($_POST["room_name"]);
	$room_code = sanitize($_POST["room_code"]);
	$type = sanitize($_POST["type"]);
	$location = sanitize($_POST["location"]);
	$status = "Available";


	// Check if entry exists 
	$checkQuery = "SELECT COUNT(*) as count FROM rooms WHERE room_code = ?";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $room_code);
	mysqli_stmt_execute($stmt);
	$count = mysqli_stmt_get_result($stmt)->fetch_assoc()['count'];

	// If entry already exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/academics?table=rooms&error=Room Code Already <b>Exists</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'`room_name`' => $room_name,
		'`room_code`' => $room_code,
		'`type`' => $type,
		'`location`' => $location,
		'`status`' => $status,
	);

	// Array to strings
	$columnValues = '';
	$columntitles = implode(', ', array_keys($columns));

	// Add qoutes to string variables 
	foreach ($columns as $key => $value) {
		if ($key === '`status`') {
			$columnValues .= "'" . $value . "'";
		} else {
			$columnValues .= "'" . $value . "', ";
		}
	}

	$columntitles = implode(', ', array_keys($columns));
	
	// Prepare the SQL query
	echo $sql = "INSERT INTO `rooms` ($columntitles) VALUES ($columnValues)";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?table=rooms&error=Add Entry <b>Error</b>");
		exit();
	}
	
	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: {$baseUrl}admin/academics?table=rooms&error=Add Entry <b>Error</b>");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: {$baseUrl}admin/academics?table=rooms&success=Added <b>ENTRY</b> successfully");
	} else {
		header("Location: {$baseUrl}admin/academics?table=rooms&error=Add Entry <b>Error</b>");
	}

	// Close prepared statment 
	mysqli_stmt_close($stmt);

	// Close Database Connection 
	mysqli_close($conn);
	exit();
}


if (isset($_POST["submitEditRoom"])) {
	// Fetch POST variables
	$room_name = sanitize($_POST["room_name"]);
	$room_code = sanitize($_POST["room_code"]);
	$type = sanitize($_POST["type"]);
	$location = sanitize($_POST["location"]);

	$room_id = sanitize($_POST["submitEditRoom"]);


	// Vairables to array
	$columns = array( 
		'`room_name`' => $room_name,
		'`room_code`' => $room_code,
		'`type`' => $type,
		'`location`' => $location,
	);

	// Prepare the column names and values for the SQL query
	$columnUpdates = '';
	$columnValues = [];

	foreach ($columns as $column => $value) {
		$columnUpdates .= $column . ' = ?, ';
		$columnValues[] = $value;
	}

	// Remove the trailing comma and space from columnUpdates
	$columnUpdates = rtrim($columnUpdates, ', ');

	// Prepare the SQL query
	echo $sql = "UPDATE rooms SET $columnUpdates WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?table=rooms&error=Update Entry <b>Error</b>");
		exit();
	}

	// Bind the parameters
	$paramTypes = str_repeat('s', count($columnValues)) . 's';
	$bindParams = array_merge($columnValues, [$room_id]);
	mysqli_stmt_bind_param($stmt, $paramTypes, ...$bindParams);

	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: {$baseUrl}admin/academics?table=rooms&error=Update Entry <b>Error</b>");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: {$baseUrl}admin/academics?table=rooms&success=Updated <b>ENTRY</b> Successfully");
	} else {
		header("Location: {$baseUrl}admin/academics?table=rooms&error=No <b>ENTRY</b> Info Updated");
	}

	// Close prepared statement
	mysqli_stmt_close($stmt);

	// Close Database Connection
	mysqli_close($conn);
	exit();
	
}

if (isset($_GET["deleteRoom"])) {
    echo $room = sanitize($_GET["id"]);

    $stmt = mysqli_prepare($conn, "DELETE FROM rooms WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 's', $room);

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
		header("Location: {$baseUrl}admin/academics?table=rooms&error=Delete Entry <b>Error</b>");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: {$baseUrl}admin/academics?table=rooms&success=<b>ENTRY</b> Deleted Successfully");
    exit();
}