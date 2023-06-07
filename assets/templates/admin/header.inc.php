<?php

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="theme-color" content="#4F6932">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="Jimwel and Irvine">
	<meta name="keywords" content="CCA Portal, City College of Angeles Portal, City College of Angeles, Portal">
	<meta name="description" content="The City College of Angeles is committed to offer quality education for the holistic development of competitive and technically-capable professionals with deep sense of excellence, resiliency, stewardship, and patrimony.">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://portal.cca.edu.ph">
	<meta property="og:title" content="City College of Angeles - Totalis Humanae">
	<meta property="og:description" content="The City College of Angeles is committed to offer quality education for the holistic development of competitive and technically-capable professionals with deep sense of excellence, resiliency, stewardship, and patrimony.">
	<meta property="og:image" content="https://portal.cca.edu.ph/assets/images/photos/thumbnail.png">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="https://portal.cca.edu.ph">
	<meta property="twitter:title" content="City College of Angeles - Totalis Humanae">
	<meta property="twitter:description" content="The City College of Angeles is committed to offer quality education for the holistic development of competitive and technically-capable professionals with deep sense of excellence, resiliency, stewardship, and patrimony.">
	<meta property="twitter:image" content="https://portal.cca.edu.ph/assets/images/photos/thumbnail.png">
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/x-icon" href="<?= $baseUrl; ?>assets/images/icons/favicon.ico">
	<title><?= $title; ?></title>

	<!-- BOOTSTRAP CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

	<!-- ADMIN KIT CSS -->
	<link href="<?= $baseUrl; ?>assets/css/app.css" rel="stylesheet">

	<!-- DATATABLES BOOTSTRAP CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

	<!-- DATATABLES COLUMN VISIBILITY -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

	<!-- DATATABLES PDF EXPORT -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

	<!-- MODALS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<!-- FANCYAPPS CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css">
	<!-- FONTAWESOME CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	
	<!-- MAIN CSS -->
	<link href="<?= $baseUrl; ?>assets/css/main.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap">
</head>
<body>
	<div class="wrapper">
		<nav class="sidebar js-sidebar user-select-none" id="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand d-flex flex-column align-items-center text-center" href="<?= $baseUrl; ?>admin">
					<img class="pe-none w-40" src="<?= $baseUrl; ?>assets/images/photos/cca-logo.png">
					<span class="align-middle">City College of Angeles</span>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-item <?= page("dashboard", $page); ?>">
						<a class="sidebar-link" href="<?= $baseUrl; ?>admin">
							<i class="fa-solid fa-chart-pie align-middle"></i>
							<span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item <?= page("users", $page); ?>">
						<a class="sidebar-link" href="<?= $baseUrl; ?>admin/users">
							<i class="fa-solid fa-chart-pie align-middle"></i>
							<span class="align-middle">Users</span>
						</a>
					</li>

					<li class="sidebar-item <?= page("schedule", $page); ?>">
						<a class="sidebar-link" href="<?= $baseUrl; ?>admin/schedule">
							<i class="fa-solid fa-chart-pie align-middle"></i>
							<span class="align-middle">Schedule</span>
						</a>
					</li>

					<li class="sidebar-item <?= page("student-information", $page); ?>">
						<a class="sidebar-link" href="<?= $baseUrl; ?>admin/student-information">
							<i class="fa-solid fa-chart-pie align-middle"></i>
							<span class="align-middle">Student Information</span>
						</a>
					</li>

					<li class="sidebar-item <?= page("registrar", $page); ?>">
						<a class="sidebar-link" href="<?= $baseUrl; ?>admin/registrar">
							<i class="fa-solid fa-chart-pie align-middle"></i>
							<span class="align-middle">Registrar</span>
						</a>
					</li>

					<li class="sidebar-item <?= page("reports", $page); ?>">
						<a class="sidebar-link" href="<?= $baseUrl; ?>admin/reports">
							<i class="fa-solid fa-chart-pie align-middle"></i>
							<span class="align-middle">Reports</span>
						</a>
					</li>

					<li class="sidebar-item <?= page("institutes", $page); ?>">
						<a class="sidebar-link" href="<?= $baseUrl; ?>admin/institutes">
							<i class="fa-solid fa-chart-pie align-middle"></i>
							<span class="align-middle">Institutes</span>
						</a>
					</li>
				</ul>
					
			</div>
		</nav>

		<div class="main bg-phoenix">
			<nav class="navbar navbar-expand navbar-light navbar-bg d-print-none bg-white-85">
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" data-bs-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block user-select-none" data-bs-toggle="dropdown">
								
								<?php

								$usersId = $_SESSION["user_id"];

								$sql = "SELECT * FROM user_accounts WHERE id = $usersId";
								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {

									while ($row = mysqli_fetch_assoc($result)) {

										$firstname = $row["firstname"];
										$middlename = $row["middlename"];
										$lastname = $row["lastname"];

										if ($middlename != "") {
											$middlename = substr($row["middlename"], 0, 1) . ".";
										}

										$fullname = $firstname . " " . $middlename . " " . $lastname;

										echo "<img src='" . $baseUrl . "assets/uploads/avatars/" . $row["avatar"] . "' class='avatar img-fluid rounded pe-none me-1' alt='" . $row["firstname"] . "' style='object-fit: cover;'> <span class='text-dark'>" . $fullname . "</span>";

									}

								}

								?>
								
							</a>

							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="<?= $baseUrl; ?>admin/profile">
									<i class="align-middle me-1" data-feather="user"></i> 
									Profile
								</a>
								<a class="dropdown-item" href="<?= $baseUrl; ?>assets/includes/sessions.inc.php?signOut">
									<i class="align-middle me-1" data-feather="log-out"></i> 
									Log out
								</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">