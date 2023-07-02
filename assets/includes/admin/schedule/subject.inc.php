<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_POST["submitAddSubject"])) {
	// Fetch POST variables
	$subject_title = sanitize($_POST["subject_title"]);
	$subject_code = sanitize($_POST["subject_code"]);
	$year = sanitize($_POST["year"]);
	$lecture_hours = sanitize($_POST["lecture_hours"]);
	$laboratory_hours = sanitize($_POST["laboratory_hours"]);
	$credited_units = sanitize($_POST["credited_units"]);

	if (isset($_POST["prerequisite"])){
		$prerequisite = sanitize($_POST["prerequisite"]);
	}else{
		$prerequisite = "";
	}


	// Check if entry exists 
	$checkQuery = "SELECT COUNT(*) as count FROM subjects WHERE subject_code = ?";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $subject_code);
	mysqli_stmt_execute($stmt);
	$count = mysqli_stmt_get_result($stmt)->fetch_assoc()['count'];

	// If entry already exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/academics?error=Subject Code Already <b>Exists</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'`subject_title`' => $subject_title,
		'`subject_code`' => $subject_code,
		'year' => $year,
		'lecture_hours' => $lecture_hours,
		'laboratory_hours' => $laboratory_hours,
		'credited_units' => $credited_units,
		'`prerequisite`' => $prerequisite,
	);

	// Array to strings
	$columnValues = '';

	// Unset empty variables
	if($prerequisite == ''){
		unset($columns['`prerequisite`']);
		// Add qoutes to string variables 
		foreach ($columns as $key => $value) {
			if ($key === 'credited_units') {
				$columnValues .= "'" . $value . "'";
			} else {
				$columnValues .= "'" . $value . "', ";
			}
		}
		
	}else{
		// Add qoutes to string variables 
		foreach ($columns as $key => $value) {
			if ($key === '`prerequisite`') {
				$columnValues .= "'" . $value . "'";
			} else {
				$columnValues .= "'" . $value . "', ";
			}
		}
		
	}

	$columntitles = implode(', ', array_keys($columns));
	
	// Prepare the SQL query
	echo $sql = "INSERT INTO `subjects` ($columntitles) VALUES ($columnValues)";
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


if (isset($_POST["submitEditSubject"])) {
	// Fetch POST variables
	$subject_title = sanitize($_POST["subject_title"]);
	$subject_code = sanitize($_POST["subject_code"]);
	$year = sanitize($_POST["year"]);
	$lecture_hours = sanitize($_POST["lecture_hours"]);
	$laboratory_hours = sanitize($_POST["laboratory_hours"]);
	$credited_units = sanitize($_POST["credited_units"]);

	if (isset($_POST["prerequisite"])){
		$prerequisite = sanitize($_POST["prerequisite"]);
	}else{
		$prerequisite = "";
	}

	$subject_id = sanitize($_POST["submitEditSubject"]);


	// Vairables to array
	$columns = array( 
		'`subject_title`' => $subject_title,
		'`subject_code`' => $subject_code,
		'year' => $year,
		'lecture_hours' => $lecture_hours,
		'laboratory_hours' => $laboratory_hours,
		'credited_units' => $credited_units,
		'`prerequisite`' => $prerequisite,
	);

	if($prerequisite == ''){ unset($columns['`prerequisite`']); }


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
	echo $sql = "UPDATE subjects SET $columnUpdates WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/academics?error=Update Entry <b>Error</b>");
		exit();
	}

	// Bind the parameters
	$paramTypes = str_repeat('s', count($columnValues)) . 's';
	$bindParams = array_merge($columnValues, [$subject_id]);
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

if (isset($_GET["deleteSubject"])) {
    echo $subject = sanitize($_GET["id"]);

    $stmt = mysqli_prepare($conn, "DELETE FROM subjects WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 's', $subject);

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