<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "users";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
	<h1 class="h3 mb-0">Import Users</h1>

	<a class="btn btn-primary d-flex justify-content-between align-items-center" onclick="history.back()">
		<i class="fa-solid fa-chevron-left me-2"></i>
		Back
	</a>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Field Names</h5>

				<ul class="mb-0">
					<li>Institute</li>
					<li>Username</li>
					<li>Last Name</li>
					<li>First Name</li>
					<li>Middle Name</li>
					<li>Role</li>
					<li>Initial Password</li>
					<li>Email Address</li>
				</ul>
			</div>
		</div>	
	</div>

	<div class="col-md-8">
		<form class="card" id="form" enctype="multipart/form-data">
			<div class="card-body">
				<div class="mb-3">
					<label>Users CSV</label>
					<input class="form-control form-control-lg" type="file" accept=".csv" name="csv" required>
				</div>

				<div class="mb-3">
					<label class="form-check user-select-none">
						<input class="form-check-input" type="checkbox" required>
						<span class="form-check-label">Verify</span>
					</label>
				</div>

				<div class="text-center">
					<button class="btn btn-secondary btn-lg" id="downloadCSVTemplate" name="downloadCSVTemplate" type="submit">
						Template
					</button>
					<button class="btn btn-success btn-lg" id="submitButton" name="submitButton" type="submit">
						Submit
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<script type="text/javascript">
	$(document).ready(function() {
	$('#form').submit(function(e) {
		e.preventDefault();

		let formData = new FormData();
		formData.append("csv", $("input[type=file]")[0].files[0]);
		formData.append("submitImportUsers", "");

		$.ajax({
			url: "../../assets/includes/admin/users/user.inc.php",
			type: "POST",
			data: formData,
			dataType: "json",
			contentType: false,
			processData: false,
			beforeSend: function() {
				$("#submitButton").prop("disabled", true);
				$("#submitButton").html(`<span class="spinner-grow spinner-grow-sm"></span> Loading..`);

				window.onbeforeunload = function() {
					return "Are you sure you want to leave this page?";
				};

				isImporting = true;
			},
			success: function(data) {
				$("#submitButton").prop("disabled", false);
				$("#submitButton").html(`Submit`);

				window.onbeforeunload = null;

				if (data.type == "error") {
					Swal.fire(
						'Error!',
						data.value + '.',
						'error'
					)
				}

				if (data.type == "success") {
					Swal.fire(
						'Success!',
						data.value + '.',
						'success'
					)
				}

				isImporting = false;

				$('#form').trigger("reset");
			}
		});

		return false;
	});

	// Get the template button element
	var templateButton = document.getElementById('downloadCSVTemplate');

	// Add a click event listener to the template button
	templateButton.addEventListener('click', function(event) {
		// Prevent the form from submitting
		event.preventDefault();

		// Code to load the template file instead of submitting the form
		window.location.href = "../../assets/includes/admin/users/user.inc.php?downloadCSVTemplate";
	});
});
</script>