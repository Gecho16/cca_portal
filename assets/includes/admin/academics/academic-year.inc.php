<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_POST["submitAddYear"])) {
	// Fetch POST variables
	$year = sanitize($_POST["year"]);
	$semester = sanitize($_POST["semester"]);

	if (preg_match('/^\d{4}-\d{4}$/', $year)) {
		$acad_year = $year . " " . $semester;
	} else {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=<b>Error</b> Selecting Year");
	}

	if ($semester !== "1st" && $semester !== "2nd" && $semester !== "Summer") {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=<b>Error</b> Selecting Semester");
	}

	$acad_year = $year . " " . $semester;

	// Check if entry exists 
	$checkQuery = "SELECT COUNT(*) as count FROM academic_years WHERE CONCAT(`year`, ' ', `semester`) = ?";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $acad_year);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$count = $result->fetch_assoc()['count'];

	// If entry already exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Academic Year Already <b>Exists</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'year' => $year,
		'`semester`' => $semester,
	);

	// Array to strings
	$columnNames = implode(', ', array_keys($columns));
	$columnValues = '';

	// Add qoutes to string variables 
	foreach ($columns as $key => $value) {
		if ($key === '`semester`') {
			$columnValues .= "'" . $value . "'";
		} else {
			$columnValues .= "'" . $value . "', ";
		}
	}
	
	// // Prepare the SQL query
	$sql = "INSERT INTO academic_years ($columnNames) VALUES ($columnValues)";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Add Entry <b>Error</b>");
		exit();
	}
	
	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Add Entry <b>Error</b>");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: {$baseUrl}admin/academics?table=academic-year&success=Added <b>ENTRY</b> successfully");
	} else {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Add Entry <b>Error</b>");
	}

	// Close prepared statment 
	mysqli_stmt_close($stmt);

	// Close Database Connection 
	mysqli_close($conn);
	exit();
}

if (isset($_POST["submitEditYear"])) {
	// Fetch POST variables
	$year = sanitize($_POST["year"]);
	$semester = sanitize($_POST["semester"]);
	$acad_yearId = sanitize($_POST["submitEditYear"]);

	if (preg_match('/^\d{4}-\d{4}$/', $year)) {
		$acad_year = $year . " " . $semester;
	} else {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=<b>Error</b> Selecting Year");
	}

	if ($semester !== "1st" && $semester !== "2nd" && $semester !== "Summer") {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=<b>Error</b> Selecting Semester");
	}

	$acad_year = $year . " " . $semester;

	// Check if entry exists 
	$checkQuery = "SELECT COUNT(*) as count FROM academic_years WHERE CONCAT(`year`, ' ', `semester`) = ? AND id != $acad_yearId";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $acad_year);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$count = $result->fetch_assoc()['count'];

	// If entry already exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Academic Year Already <b>Exists</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'year' => $year,
		'`semester`' => $semester,
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
	$sql = "UPDATE academic_years SET $columnUpdates WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Update Entry <b>Error</b>");
		exit();
	}

	// Bind the parameters
	$paramTypes = str_repeat('s', count($columnValues)) . 's';
	$bindParams = array_merge($columnValues, [$acad_yearId]);
	mysqli_stmt_bind_param($stmt, $paramTypes, ...$bindParams);

	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Update Entry <b>Error</b>");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: {$baseUrl}admin/academics?table=academic-year&success=Updated <b>ENTRY</b> Successfully");
	} else {
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=No <b>ENTRY</b> Info Updated");
	}

	// Close prepared statement
	mysqli_stmt_close($stmt);

	// Close Database Connection
	mysqli_close($conn);
	exit();
	
}

if (isset($_GET["deleterAcadYear"])) {
    $acad_yearId = sanitize($_GET["id"]);

    $stmt = mysqli_prepare($conn, "DELETE FROM academic_years WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 's', $acad_yearId);

    if (!mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Delete Entry <b>Error</b>");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: {$baseUrl}admin/academics?table=academic-year&success=<b>ENTRY</b> Deleted Successfully");
    exit();
}

if (isset($_GET["activateAcadYear"])) {
	$acad_yearId = sanitize($_GET["id"]);

	$stmt = mysqli_prepare($conn, "UPDATE academic_years SET is_active = ?");
	mysqli_stmt_bind_param($stmt, 'i', $is_active);

	$is_active = 0;

	if (!mysqli_stmt_execute($stmt)) {
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Activate Academic Year <b>Error</b>");
		exit();
	}

	mysqli_stmt_close($stmt);

	$stmt = mysqli_prepare($conn, "UPDATE academic_years SET is_active = ? WHERE id = ?");
	mysqli_stmt_bind_param($stmt, 'si', $is_active, $acad_yearId);

	$is_active = 1;

	if (!mysqli_stmt_execute($stmt)) {
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		header("Location: {$baseUrl}admin/academics?table=academic-year&error=Activate Academic Year <b>Error</b>");
		exit();
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

	header("Location: {$baseUrl}admin/academics?table=academic-year&success=<b>Academic Year</b> Activated Successfully");
	exit();
}
	