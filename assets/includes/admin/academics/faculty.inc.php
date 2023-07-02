<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_POST["submitAddFaculty"])) {
	// Fetch POST variables
	$firstname = sanitize($_POST["firstname"]);
	$lastname = sanitize($_POST["lastname"]);
	$middlename = sanitize($_POST["middlename"]);
	$suffix = sanitize($_POST["suffix"]);
	$reference_number = sanitize($_POST["reference_number"]);
	$institute = sanitize($_POST["institute"]);
	$type = sanitize($_POST["type"]);

	// Check if entry exists 
	$checkQuery = "SELECT COUNT(*) as count FROM faculty WHERE reference_number = ?";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $reference_number);
	mysqli_stmt_execute($stmt);
	$count = mysqli_stmt_get_result($stmt)->fetch_assoc()['count'];

	// If entry already exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/academics?table=faculty&error=Reference Number Already <b>Exists</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'`firstname`' => $firstname,
		'`lastname`' => $lastname,
		'`middlename`' => $middlename,
		'`suffix`' => $suffix,
		'`reference_number`' => $reference_number,
		'`institute`' => $institute,
		'`type`' => $type,
	);

	// Array to strings
	$columnValues = '';

	if($middlename == ''){ unset($columns['`middlename`']); }
	if($suffix == ''){ unset($columns['`suffix`']); }

	$columntitles = implode(', ', array_keys($columns));

	// Add qoutes to string variables 
	foreach ($columns as $key => $value) {
		if ($key === '`type`') {
			$columnValues .= "'" . $value . "'";
		} else {
			$columnValues .= "'" . $value . "', ";
		}
	}
	
	// Prepare the SQL query
	echo $sql = "INSERT INTO `faculty` ($columntitles) VALUES ($columnValues)";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?table=faculty&error=Add Entry <b>Error</b>");
		exit();
	}
	
	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: {$baseUrl}admin/academics?table=faculty&error=Add Entry <b>Error</b>");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: {$baseUrl}admin/academics?table=faculty&success=Added <b>ENTRY</b> successfully");
	} else {
		header("Location: {$baseUrl}admin/academics?table=faculty&error=Add Entry <b>Error</b>");
	}

	// Close prepared statment 
	mysqli_stmt_close($stmt);

	// Close Database Connection 
	mysqli_close($conn);
	exit();
}


if (isset($_POST["submitEditFaculty"])) {
	// Fetch POST variables
	$firstname = sanitize($_POST["firstname"]);
	$lastname = sanitize($_POST["lastname"]);
	$middlename = sanitize($_POST["middlename"]);
	$suffix = sanitize($_POST["suffix"]);
	$reference_number = sanitize($_POST["reference_number"]);
	$institute = sanitize($_POST["institute"]);
	$type = sanitize($_POST["type"]);

	$faculty_id = sanitize($_POST["submitEditFaculty"]);


	// Vairables to array
	$columns = array( 
		'`firstname`' => $firstname,
		'`lastname`' => $lastname,
		'`middlename`' => $middlename,
		'`suffix`' => $suffix,
		'`reference_number`' => $reference_number,
		'`institute`' => $institute,
		'`type`' => $type,
	);

	if($middlename == ''){ unset($columns['`middlename`']); }
	if($suffix == ''){ unset($columns['`suffix`']); }

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
	echo $sql = "UPDATE faculty SET $columnUpdates WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?table=faculty&error=Update Entry <b>Error</b>");
		exit();
	}

	// Bind the parameters
	$paramTypes = str_repeat('s', count($columnValues)) . 's';
	$bindParams = array_merge($columnValues, [$faculty_id]);
	mysqli_stmt_bind_param($stmt, $paramTypes, ...$bindParams);

	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: {$baseUrl}admin/academics?table=faculty&error=Update Entry <b>Error</b>");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: {$baseUrl}admin/academics?table=faculty&success=Updated <b>ENTRY</b> Successfully");
	} else {
		header("Location: {$baseUrl}admin/academics?table=faculty&error=No <b>ENTRY</b> Info Updated");
	}

	// Close prepared statement
	mysqli_stmt_close($stmt);

	// Close Database Connection
	mysqli_close($conn);
	exit();
	
}

if (isset($_GET["deleteFaculty"])) {
    echo $faculty = sanitize($_GET["id"]);

    $stmt = mysqli_prepare($conn, "DELETE FROM faculty WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 's', $faculty);

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
		header("Location: {$baseUrl}admin/academics?table=faculty&error=Delete Entry <b>Error</b>");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: {$baseUrl}admin/academics?table=faculty&success=<b>ENTRY</b> Deleted Successfully");
    exit();
}