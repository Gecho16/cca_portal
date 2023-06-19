<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_POST["submitAddInstitute"])) {
	// Fetch POST variables
	$institute_name = sanitize($_POST["institute_name"]);
	$institute_code = sanitize($_POST["institute_code"]);

	// $firstname = sanitize($_POST["firstname"]);
	// $lastname = sanitize($_POST["lastname"]);
	// $middlename = sanitize($_POST["middlename"]);
	// $suffix = sanitize($_POST["suffix"]);

	// if (!in_array($suffix, [null, ''])) {
	// 	$fullname = $lastname . ' ' . $suffix . ', ' . $firstname . ' ' . $middlename; 
	// }else if (!in_array($middlename, [null, ''])) {
	// 	$fullname = $lastname . ', ' . $firstname . ' ' . $middlename; 
	// }else{
	// 	$fullname = $lastname . ', ' . $firstname; 
	// }

	// if (!in_array($firstname, [null, '']) || !in_array($lastname, [null, ''])) {
	// 	$dean = $fullname; 
	// }else{
	// 	$dean = NULL;
	// }

	// Check if entry exists 
	$checkQuery = "SELECT COUNT(*) as count FROM institutes WHERE institute_code = ?";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $institute_code);
	mysqli_stmt_execute($stmt);
	$count = mysqli_stmt_get_result($stmt)->fetch_assoc()['count'];

	// If entry already exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/academics?error=Institute Code Already <b>Exists</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'`institute_name`' => $institute_name,
		'`institute_code`' => $institute_code,
	);

	// Array to strings
	$columnNames = implode(', ', array_keys($columns));
	$columnValues = '';

	// Add qoutes to string variables 
	foreach ($columns as $key => $value) {
		if ($key === '`institute_code`') {
			echo $columnValues .= "'" . $value . "'";
		} else {
			echo $columnValues .= "'" . $value . "', ";
		}
	}
	
	// // Prepare the SQL query
	$sql = "INSERT INTO institutes ($columnNames) VALUES ($columnValues)";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?error=Add Entry <b>Error</b>");
		exit();
	}
	
	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: {$baseUrl}admin/academics?error=Add Entry <b>Error</b>");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: {$baseUrl}admin/academics?&success=Added <b>ENTRY</b> successfully");
	} else {
		header("Location: {$baseUrl}admin/academics?error=Add Entry <b>Error</b>");
	}

	// Close prepared statment 
	mysqli_stmt_close($stmt);

	// Close Database Connection 
	mysqli_close($conn);
	exit();
}

if (isset($_POST["submitEditInstitute"])) {
	// Fetch POST variables
	$institute_name = sanitize($_POST["institute_name"]);
	$institute_code = sanitize($_POST["institute_code"]);
	$institute = sanitize($_POST["submitEditInstitute"]);

	// Check if entry exists 
	$checkQuery = "SELECT COUNT(*) as count FROM institutes WHERE institute_code = ?";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $institute_code);
	mysqli_stmt_execute($stmt);
	$count = mysqli_stmt_get_result($stmt)->fetch_assoc()['count'];

	// If entry already exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/academics?error=Institute Code Already <b>Exists</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'`institute_name`' => $institute_name,
		'`institute_code`' => $institute_code,
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
	$sql = "UPDATE institutes SET $columnUpdates WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?error=Update Entry <b>Error</b>");
		exit();
	}

	// Bind the parameters
	$paramTypes = str_repeat('s', count($columnValues)) . 's';
	$bindParams = array_merge($columnValues, [$institute]);
	mysqli_stmt_bind_param($stmt, $paramTypes, ...$bindParams);

	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: {$baseUrl}admin/academics?error=Update Entry <b>Error</b>");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: {$baseUrl}admin/academics?success=Updated <b>ENTRY</b> Successfully");
	} else {
		header("Location: {$baseUrl}admin/academics?error=No <b>ENTRY</b> Info Updated");
	}

	// Close prepared statement
	mysqli_stmt_close($stmt);

	// Close Database Connection
	mysqli_close($conn);
	exit();
	
}

if (isset($_GET["deleteInstitute"])) {
    $institute = sanitize($_GET["id"]);

    $stmt = mysqli_prepare($conn, "DELETE FROM institutes WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 's', $institute);

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
		header("Location: {$baseUrl}admin/academics?error=Delete Entry <b>Error</b>");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: {$baseUrl}admin/academics?success=<b>ENTRY</b> Deleted Successfully");
    exit();
}