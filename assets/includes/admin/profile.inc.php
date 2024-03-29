<?php

$baseUrl = "../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_POST["submitUpdateProfile"])) {
	$userId = $_SESSION["user_id"];
	$firstname = sanitize($_POST["firstname"]);
	$middlename = sanitize($_POST["middlename"]);
	$lastname = sanitize($_POST["lastname"]);

	if (!empty($_FILES['avatar']['tmp_name'])) {
		$fileName = $_FILES['avatar']['name'];
		$fileTmpName = $_FILES['avatar']['tmp_name'];

		$fileExt = explode(".", $fileName);
		$fileExt = strtolower(end($fileExt));

		$fileName = uniqid("", true) . "." . $fileExt;

		$fileDestination =  $baseUrl . "assets/uploads/avatars/" . $fileName;

		move_uploaded_file($fileTmpName, $fileDestination);

		$sql = "UPDATE user_accounts SET avatar = '$fileName', firstname = '$firstname', middlename = '$middlename', lastname = '$lastname' WHERE id = $userId";
		
		if (!mysqli_query($conn, $sql)) {
			header("Location: " . $baseUrl . "admin/profile/?error=Update Profile error");
			exit();
		}		
	} else {
		$sql = "UPDATE user_accounts SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname' WHERE id = $userId";
		
		if (!mysqli_query($conn, $sql)) {
			header("Location: " . $baseUrl . "admin/profile/?error=Update Profile error");
			exit();
		}
	}

	header("Location: " . $baseUrl . "admin/profile/?success=Updated profile successfully");
	exit();
}

if (isset($_POST["submitChangePassword"])) {
	$userId = $_SESSION["user_id"];
	$currentPassword = sanitize($_POST["currentPassword"]);
	$newPassword = sanitize($_POST["newPassword"]);
	$confirmNewPassword = sanitize($_POST["confirmNewPassword"]);

	$sql = "SELECT * FROM user_accounts WHERE id = $userId";
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			if (!password_verify($currentPassword, $row["password"])) {
				header("Location: " . $baseUrl . "admin/profile/change-password?error=Incorrect Current Password");
				exit();
			}
		}
	}

	if ($newPassword != $confirmNewPassword) {
		header("Location: " . $baseUrl . "admin/profile/change-password?error=Passwords mismatch");
		exit();
	}

	$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

	$sql = "UPDATE user_accounts SET password = '$newPassword' WHERE id = $userId";
	
	if (!mysqli_query($conn, $sql)) {
		header("Location: " . $baseUrl . "admin/profile/change-password?error=Change Password error");
		exit();
	}

	header("Location: " . $baseUrl . "admin/profile/change-password?success=Changed Password successfully");
	exit();
}