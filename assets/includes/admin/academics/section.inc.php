<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_POST["submitAddSection"])) {
	// Fetch POST variables
	$section = sanitize($_POST["section"]);
	$course = sanitize($_POST["course"]);
	$year = sanitize($_POST["year"]);
	$acad_year = sanitize($_POST["acad_year"]);

	// Check if entry exists 
	$checkQuery = "SELECT COUNT(*) as count FROM sections WHERE section = ?";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $section);
	mysqli_stmt_execute($stmt);
	$count = mysqli_stmt_get_result($stmt)->fetch_assoc()['count'];

	// If entry already exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/academics?error=Subject Code Already <b>Exists</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'`section`' => "'" . $section . "'",
		'`course`' => "'" . $course . "'",
		'year_level' => $year,
		'`academic_year`' => $acad_year,
	);

	// Array to strings
	$columnNames = implode(', ', array_keys($columns));
	$columnValues = '';

	// Add qoutes to string variables 
	foreach ($columns as $key => $value) {
		if ($key === '`academic_year`') {
			$columnValues .= $value;
		} else {
			$columnValues .= $value . ", ";
		}
	}
	
	// Prepare the SQL query
	echo $sql = "INSERT INTO `sections` ($columnNames) VALUES ($columnValues)";
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


if (isset($_POST["submitEditSection"])) {
	// Fetch POST variables
	$section = sanitize($_POST["section"]);
	$course = sanitize($_POST["course"]);
	$year = sanitize($_POST["year"]);
	$acad_year = sanitize($_POST["acad_year"]);

	$section_id = sanitize($_POST["submitEditSection"]);


	// Vairables to array
	$columns = array( 
		'`section`' => "'" . $section . "'",
		'`course`' => "'" . $course . "'",
		'year_level' => $year,
		'`academic_year`' => $acad_year,
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
	echo $sql = "UPDATE sections SET $columnUpdates WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?error=Update Entry <b>Error</b>");
		exit();
	}

	// Bind the parameters
	$paramTypes = str_repeat('s', count($columnValues)) . 's';
	$bindParams = array_merge($columnValues, [$section_id]);
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

if (isset($_GET["deleteSection"])) {
    echo $section = sanitize($_GET["id"]);

    $stmt = mysqli_prepare($conn, "DELETE FROM sections WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 's', $section);

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