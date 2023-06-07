<?php 

session_start();
date_default_timezone_set("Asia/Manila");
set_time_limit(0);

// $conn = mysqli_connect("localhost", "ljgtmurty1m6_cca_admin", "ICSLIS2023!_", "ljgtmurty1m6_cca_portal_db");
$conn = mysqli_connect("localhost", "root", "", "cca_portal");

mysqli_set_charset( $conn, 'utf8');
if (!$conn) {
	die("connection failed: " . mysqli_connect_errno());
	die("connection failed: " . mysqli_connect_error());
}

include "functions.inc.php";