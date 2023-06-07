<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_GET["recoverUser"])) {
	$userId = sanitize($_GET["id"]);

	$sql = "SELECT * FROM user_accounts WHERE id = $userId";
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$username = $row["username"];
		}
	}

	$initialPassword = bin2hex(openssl_random_pseudo_bytes(4));
	$hashedInitialPassword = password_hash($initialPassword, PASSWORD_DEFAULT);

	$sql = "UPDATE user_accounts SET initial_password = '$hashedInitialPassword' WHERE id = $userId";
	
	if (!mysqli_query($conn, $sql)) {
		header("Location: " . $baseUrl . "admin/users?error=Recover User error&username=" . $username . "&initialPassword=" . $initialPassword);
		exit();
	}

	header("Location: " . $baseUrl . "admin/recover/user?success=Recovered User successfully&username=" . $username . "&initialPassword=" . $initialPassword);
	exit();
}

if (isset($_GET["disableUser"])) {
	$userId = sanitize($_GET["id"]);

	$sql = "UPDATE user_accounts SET is_active = 0 WHERE id = $userId";
	
	if (!mysqli_query($conn, $sql)) {
		header("Location: " . $baseUrl . "admin/users?error=Disable User error");
		exit();
	}

	header("Location: " . $baseUrl . "admin/users?success=Disabled User successfully");
	exit();
}

if (isset($_GET["enableUser"])) {
	$userId = sanitize($_GET["id"]);

	$sql = "UPDATE user_accounts SET is_active = 1 WHERE id = $userId";
	
	if (!mysqli_query($conn, $sql)) {
		header("Location: " . $baseUrl . "admin/users?error=Enable User error");
		exit();
	}

	header("Location: " . $baseUrl . "admin/users?success=Enabled User successfully");
	exit();
}

if (isset($_GET["deleteUser"])) {
	echo $userId = sanitize($_GET["id"]);

	$sql = "DELETE FROM user_accounts WHERE id = $userId";

	
	if (!mysqli_query($conn, $sql)) {
		header("Location: " . $baseUrl . "admin/users?error=User Delete error");
		exit();
	}

	header("Location: " . $baseUrl . "admin/users?success=User Deleted successfully");
	exit();
}

if (isset($_GET['deleteSelectedUser'])) {
	if(isset($_POST["checkbox"][0])){
		foreach($_POST['checkbox'] as $list){
			$id = mysqli_real_escape_string($conn,$list);
			$sql = "DELETE FROM user_accounts WHERE id = '$id'";

			if (!mysqli_query($conn, $sql)) {
				header("Location: " . $baseUrl . "admin/users?error=User Delete error");
				exit();
			}
		}
		header("Location: " . $baseUrl . "admin/users?success=User Deleted successfully");
		exit();
	}else{
		header("Location: " . $baseUrl . "admin/users?error=No user selected");
		exit();
	}
}

if (isset($_POST["submitImportUsers"])) {
	$fileExtension = explode(".", $_FILES["csv"]["name"]);
	$fileExtension = end($fileExtension);
	$fileExtension = strtolower($fileExtension);

	$data = [];

	if ($fileExtension != "csv") {
		$data["type"] = "error";
		$data["value"] = "Invalid file type";

		echo json_encode($data);
		exit();
	}

	$handle = fopen($_FILES["csv"]["tmp_name"], "r");

	$counter = 1;

	while ($row = fgetcsv($handle)) {
		if ($counter <= 1) {
			$counter++;

			continue;
		}

		$avatar = "avatar.png";
		$lastname = preg_replace('/[^a-zA-Z0-9 Ññ]/', '', sanitize(utf8_encode($row[2])));
		$firstname = preg_replace('/[^a-zA-Z0-9 Ññ]/', '', sanitize(utf8_encode($row[3])));
		$middlename = preg_replace('/[^a-zA-Z0-9 Ññ]/', '', sanitize(utf8_encode($row[4])));
		$institute = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', sanitize($row[0]));
		$emailAddress = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', sanitize($row[7]));
		$username = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', sanitize($row[1]));
		$initialPassword = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', sanitize($row[6]));
		$password = "";
		$role = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', sanitize($row[5]));
		$role = strtolower($role);
		$status = "";
		$isActive = 1;
		$lastLogin	= date("Y-m-d H:i:s", time());
		$currentLogin	= date("Y-m-d H:i:s", time());

		if ($username == "") {
			continue;
		}

		$sql = "SELECT * FROM user_accounts WHERE username = '$username'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			continue;
		}

		$initialPassword = password_hash($initialPassword, PASSWORD_DEFAULT);

		$sql = "INSERT INTO user_accounts (avatar, lastname, firstname, middlename, institute, email_address, username, initial_password, password, role, status, is_active, last_login, current_login) VALUES ('$avatar', '$lastname', '$firstname', '$middlename', '$institute', '$emailAddress', '$username', '$initialPassword', '$password', '$role', '$status', $isActive, '$lastLogin', '$currentLogin')";
		
		if (!mysqli_query($conn, $sql)) {
			$data["type"] = "error";
			$data["value"] = "Import <b>USERS</b> error";

			echo json_encode($data);
			exit();
		}
	}

	$data["type"] = "success";
	$data["value"] = "Imported <b>USERS</b> successfully";

	echo json_encode($data);
	exit();
}

if (isset($_POST["submitEditUser"])) {
	$userId = sanitize($_POST["userId"]);
	$firstname = sanitize($_POST["firstname"]);
	$lastname = sanitize($_POST["lastname"]);
	$middlename = sanitize($_POST["middlename"]);
	$suffix = sanitize($_POST["suffix"]);
	$institute = strtoupper(sanitize($_POST["institute"]));
	$course = strtoupper(sanitize($_POST["course"]));
	$username = sanitize($_POST["username"]);

	// Vairables to array
	$columns = array( 
		'firstname' => $firstname,
		'lastname' => $lastname,
		'middlename' => $middlename,
		'suffix' => $suffix,
		'institute' => $institute,
		'course' => $course,
		'username' => $username,
	);

	// Unset empty variables
	if($middlename == ''){ unset($columns['middlename']); }
	if($suffix == ''){ unset($columns['suffix']); }

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
	$sql = "UPDATE user_accounts SET $columnUpdates WHERE id = ?";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: {$baseUrl}admin/users?userId={$userId}&error=Update <b>USER</b> error");
		exit();
	}

	// Bind the parameters
	$paramTypes = str_repeat('s', count($columnValues)) . 's';
	$bindParams = array_merge($columnValues, [$userId]);
	mysqli_stmt_bind_param($stmt, $paramTypes, ...$bindParams);

	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: {$baseUrl}admin/users?userId={$userId}&error=Update <b>USER</b> error");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: {$baseUrl}admin/users?userId={$userId}&success=Updated <b>USER</b> successfully");
	} else {
		header("Location: {$baseUrl}admin/users?userId={$userId}&error=No <b>USER</b> info updated");
	}

	// Close prepared statement
	mysqli_stmt_close($stmt);

	// Close Database Connection
	mysqli_close($conn);
	exit();
	
}

if (isset($_POST["submitAddUser"])) {
	// Fetch POST variables
	$avatar = "avatar.png";
	$firstname = sanitize($_POST["firstname"]);
	$lastname = sanitize($_POST["lastname"]);
	$middlename = sanitize($_POST["middlename"]);
	$suffix = sanitize($_POST["suffix"]);
	$institute = strtoupper(sanitize($_POST["institute"]));
	$email = "- - -";
	$username = sanitize($_POST["username"]);
	$initial_password = "changed";
	$password = password_hash(sanitize($_POST["password"]), PASSWORD_DEFAULT);
	$role = sanitize($_POST["role"]);
	$last_login = date("Y-m-d H:i:s", time());
	$current_login = date("Y-m-d H:i:s", time());
	$is_active = 1;

	if(isset($_POST["course"])){
		$course = strtoupper(sanitize($_POST["course"]));
	}else{
		$course = "";
	}

	// Check if username exists 
	$checkQuery = "SELECT COUNT(*) as count FROM user_accounts WHERE username = ?";
	$stmt = mysqli_prepare($conn, $checkQuery);
	mysqli_stmt_bind_param($stmt, 's', $username);
	mysqli_stmt_execute($stmt);
	$count = mysqli_stmt_get_result($stmt)->fetch_assoc()['count'];

	// If already username exists send error message
	if ($count > 0) {
		header("Location: {$baseUrl}admin/users?userId={$userId}&error=User already <b>EXISTS</b>");
		exit();
	}

	// Vairables to array
	$columns = array( 
		'avatar' => $avatar,
		'firstname' => $firstname,
		'lastname' => $lastname,
		'middlename' => $middlename,
		'suffix' => $suffix,
		'institute' => $institute,
		'course' => $course,
		'email' => $email,
		'username' => $username,
		'initial_password' => $initial_password,
		'password' => $password,
		'role' => $role,
		'last_login' => $last_login,
		'current_login' => $current_login,
		'is_active' => $is_active,
	);

	// Set avatar of school staff
	if (in_array($role, ["Admin", "VPAA", "Dean", "Coordinator", "HR", "Secretary",])) {
		$avatar = "cca-".$avatar;
	}

	// Unset empty variables
	if($course == ''){ unset($columns['course']); }
	if($middlename == ''){ unset($columns['middlename']); }
	if($suffix == ''){ unset($columns['suffix']); }

	// Array to strings
	$columnNames = implode(', ', array_keys($columns));
	$columnValues = '';

	// Add qoutes to string variables 
	foreach ($columns as $key => $value) {
		if ($key === 'is_active') {
			$columnValues .= $value;
		} else {
			$columnValues .= "'" . $value . "', ";
		}
	}
	
	// Prepare the SQL query
	$sql = "INSERT INTO user_accounts ($columnNames) VALUES ($columnValues)";
	$stmt = mysqli_prepare($conn, $sql);

	// Error preparing the statement
	if (!$stmt) {
		header("Location: " . $baseUrl . "admin/users?userId=" . $userId . "&error=Add <b>USER</b> error");
		exit();
	}
	
	// Execute the statement
	if (!mysqli_stmt_execute($stmt)) {
		header("Location: " . $baseUrl . "admin/users?userId=" . $userId . "&error=Add <b>USER</b> error");
		exit();
	}

	// Check if any rows were affected
	if (mysqli_stmt_affected_rows($stmt) > 0) {
		header("Location: " . $baseUrl . "admin/users?userId=" . $userId . "&success=Added <b>USER</b> successfully");
	} else {
		header("Location: " . $baseUrl . "admin/users?userId=" . $userId . "&error=Add <b>USER</b> error");
	}

	// Close prepared statment 
	mysqli_stmt_close($stmt);

	// Close Database Connection 
	mysqli_close($conn);
	exit();
}