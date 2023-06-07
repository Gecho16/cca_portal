<?php

include "./assets/includes/dbh.inc.php";

// IBM Dean
// $avatar = "cca-avatar.png";
// $lastname = "Dean";
// $firstname = "IBM";
// $middlename = "";
// $institute = "IBM";
// $username = "IBM-Dean";
// $initialPassword = "changed";
// $password = "1234";
// $role = "dean";
// $isActive = 1;

// ICSLIS Dean
// $avatar = "cca-avatar.png";
// $lastname = "Dean";
// $firstname = "ICSLIS";
// $middlename = "";
// $institute = "ICSLIS";
// $username = "ICSLIS-Dean";
// $initialPassword = "changed";
// $password = "1234";
// $role = "dean";
// $isActive = 1;

// IEAS Dean
// $avatar = "cca-avatar.png";
// $lastname = "Dean";
// $firstname = "IEAS";
// $middlename = "";
// $institute = "IEAS";
// $username = "IEAS-Dean";
// $initialPassword = "changed";
// $password = "1234";
// $role = "dean";
// $isActive = 1;

// CCA ADMIN
$avatar = "cca-avatar.png";
$firstname = "Admin";
$lastname = "CCA";
$middlename = "";
$suffix = "";
$institute = "MISSO";
$email = "CCA-Admin@cca.edu.ph";
$username = "CCA-Admin";
$initial_password = "changed";
$password = password_hash('1234', PASSWORD_DEFAULT);
$role = "Admin";
$last_login = date("Y-m-d H:i:s", time());
$current_login = date("Y-m-d H:i:s", time());
$is_active = 1;

$columns = array( 
	'avatar' => $avatar,
	'firstname' => $firstname,
	'lastname' => $lastname,
	'middlename' => $middlename,
	'suffix' => $suffix,
	'institute' => $institute,
	'email' => $email,
	'username' => $username,
	'initial_password' => $initial_password,
	'password' => $password,
	'role' => $role,
	'last_login' => $last_login,
	'current_login' => $current_login,
	'is_active' => $is_active,
);

if($middlename == ''){ unset($columns['middlename']); }
if($suffix == ''){ unset($columns['suffix']); }

// Array to strings
$columnNames = implode(', ', array_keys($columns));
$columnValues = '';

foreach ($columns as $key => $value) {
	if ($key === 'is_active') {
		$columnValues .= $value;
	} else {
		$columnValues .= "'" . $value . "', ";
	}
}

// Prepare the SQL query
echo $sql = "INSERT INTO user_accounts ($columnNames) VALUES ($columnValues)";

if (!mysqli_query($conn, $sql)) {
	echo "error";
} else {
	echo "success";
}

?>