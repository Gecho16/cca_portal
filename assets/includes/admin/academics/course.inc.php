<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_POST["submitAddCourse"])) {
	// Fetch POST variables
	$course_name = sanitize($_POST["course_name"]);
	$course_code = sanitize($_POST["course_code"]);
	$institute = sanitize($_POST["institute"]);

	// Check if entry exists 
	$checkQuery = "SELECT COUNT(*) as count FROM courses WHERE course_code = ?";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $course_code);
	mysqli_stmt_execute($stmt);
	$count = mysqli_stmt_get_result($stmt)->fetch_assoc()['count'];

	// If entry already exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/academics?error=Course Code Already <b>Exists</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'`course_title`' => $course_name,
		'`course_code`' => $course_code,
		'`institute`' => $institute,
	);

	// Array to strings
	$columnNames = implode(', ', array_keys($columns));
	$columnValues = '';

	// Add qoutes to string variables 
	foreach ($columns as $key => $value) {
		if ($key === '`institute`') {
			echo $columnValues .= "'" . $value . "'";
		} else {
			echo $columnValues .= "'" . $value . "', ";
		}
	}
	
	// // Prepare the SQL query
	$sql = "INSERT INTO courses ($columnNames) VALUES ($columnValues)";
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

if (isset($_POST["submitEditCourse"])) {
	// Fetch POST variables
	$course_name = sanitize($_POST["course_name"]);
	$course_code = sanitize($_POST["course_code"]);
	$institute = sanitize($_POST["institute"]);
	$course_id = sanitize($_POST["submitEditCourse"]);

	// Vairables to array
	$columns = array( 
		'`course_title`' => $course_name,
		'`course_code`' => $course_code,
		'`institute`' => $institute,
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
	echo $sql = "UPDATE courses SET $columnUpdates WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?error=Update Entry <b>Error</b>");
		exit();
	}

	// Bind the parameters
	$paramTypes = str_repeat('s', count($columnValues)) . 's';
	$bindParams = array_merge($columnValues, [$course_id]);
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

if (isset($_GET["deleteCourse"])) {
    $course = sanitize($_GET["id"]);

    $stmt = mysqli_prepare($conn, "DELETE FROM courses WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 's', $course);

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