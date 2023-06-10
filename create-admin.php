<?php

// // CCA ADMIN
// $avatar = "cca-avatar.png";
// $firstname = "Admin";
// $lastname = "CCA";
// $middlename = "";
// $suffix = "";
// $institute = "MISSO";
// $email = "CCA-Admin@cca.edu.ph";
// $username = "CCA-Admin";
// $initial_password = "changed";
// $password = password_hash('1234', PASSWORD_DEFAULT);
// $role = "Admin";
// $last_login = date("Y-m-d H:i:s", time());
// $current_login = date("Y-m-d H:i:s", time());
// $is_active = 1;

// $columns = array( 
// 	'avatar' => $avatar,
// 	'firstname' => $firstname,
// 	'lastname' => $lastname,
// 	'middlename' => $middlename,
// 	'suffix' => $suffix,
// 	'institute' => $institute,
// 	'email' => $email,
// 	'username' => $username,
// 	'initial_password' => $initial_password,
// 	'password' => $password,
// 	'role' => $role,
// 	'last_login' => $last_login,
// 	'current_login' => $current_login,
// 	'is_active' => $is_active,
// );

// if($middlename == ''){ unset($columns['middlename']); }
// if($suffix == ''){ unset($columns['suffix']); }

// // Array to strings
// $columnNames = implode(', ', array_keys($columns));
// $columnValues = '';

// foreach ($columns as $key => $value) {
// 	if ($key === 'is_active') {
// 		$columnValues .= $value;
// 	} else {
// 		$columnValues .= "'" . $value . "', ";
// 	}
// }

// // Prepare the SQL query
// echo $sql = "INSERT INTO user_accounts ($columnNames) VALUES ($columnValues)";

// // Prepare the SQL query
echo "Go to create-account.php";