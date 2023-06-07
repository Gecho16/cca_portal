<?php
$baseUrl = "../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "admin");

$sql = "SELECT * FROM `users` WHERE `lastname` LIKE '%Ã±%'or `lastname` LIKE '%Ã‘%' or `firstname` LIKE '%Ã±%'or `firstname` LIKE '%Ã‘%' or `middlename` LIKE '%Ã±%'or `middlename` LIKE '%Ã‘%';";
$result = $conn->query($sql);

while ($row = mysqli_fetch_assoc($result)) {
	if (strpos($row["firstname"], 'Ã±') or strpos($row["firstname"], 'Ã‘')){
		$row["firstname"] = str_replace('Ã±', 'ñ', $row["firstname"]);
		$row["firstname"] = str_replace('Ã‘', 'Ñ', $row["firstname"]);
		$update = "UPDATE users SET firstname = '".$row["firstname"]."' WHERE id='".$row['id']."'";
		$conn->query($update);
	}

	if (strpos($row["middlename"], 'Ã±') or strpos($row["middlename"], 'Ã‘')){
		$row["middlename"] = str_replace('Ã±', 'ñ', $row["middlename"]);
		$row["middlename"] = str_replace('Ã‘', 'Ñ', $row["middlename"]);
		$update = "UPDATE users SET middlename = '".$row["middlename"]."' WHERE id='".$row['id']."'";
		$conn->query($update);
	}

	if (strpos($row["lastname"], 'Ã±') or strpos($row["lastname"], 'Ã‘')){
		$row["lastname"] = str_replace('Ã±', 'ñ', $row["lastname"]);
		$row["lastname"] = str_replace('Ã‘', 'Ñ', $row["lastname"]);
		$update = "UPDATE users SET lastname = '".$row["lastname"]."' WHERE id='".$row['id']."'";
		$conn->query($update);
	}
}


?>