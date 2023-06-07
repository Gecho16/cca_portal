<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_GET["selectUsers"])) {
	// initialize all variables
	$request = $columns = $totalRecords = $data = array();
	$request = $_REQUEST;

	// define index of column
	$columns = array( 
		0 => 'id',
		1 => 'avatar',
		2 => 'fullname',
		3 => 'lastname',
		4 => 'firstname',
		5 => 'middlename',
		6 => 'suffix',
		7 => 'institute',
		8 => 'institute',
		9 => 'email',
		10 => 'username',
		11 => 'role',
		12 => 'last_login',
		13 => 'is_active',
		14 => ''
	);
	
	$where = $sqlTot = $sqlRec = "";

	// Set leading sql string
	$sql = "SELECT * FROM user_accounts WHERE username <> 'CCA-Admin'";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " AND (username LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR lastname LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR firstname LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR institute LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR CONCAT(lastname, ' ', suffix, ', ', firstname, ' ', middlename) LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR email LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR institute LIKE '%" . $request["search"]["value"] . "%'";
		$where .= " OR role LIKE '%" . $request["search"]["value"] . "%')";
	}

	$sqlTot .= $sql;
	$sqlRec .= $sql;

	// concatenate search sql if value exists
	if(isset($where) && $where != '') {
		$sqlTot .= $where;
		$sqlRec .= $where;
	}

	// Specify row order
	$sqlRec .=  " ORDER BY ". $columns[$request['order'][0]['column']]."   ".$request['order'][0]['dir'];

	// Limit number of rows
	if(intval($request['length']) !== -1){
		$sqlRec .= " LIMIT ".$request['start']." ,".$request['length'];
	}else{
		$sqlRec .= " LIMIT 0, 100000";
	}

	$queryTot = mysqli_query($conn, $sqlTot) or die("database error:". mysqli_error($conn));
	$totalRecords = mysqli_num_rows($queryTot);

	// Fetch records
	$sqlRec .=  ";";
	$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch data");

	if (mysqli_num_rows($queryRecords) > 0) {
		while ($row = mysqli_fetch_assoc($queryRecords)) {

			// Variable transfer
			$id = $row["id"];
			$lastname = $row["lastname"];
			$firstname = $row["firstname"];
			$middlename = $row["middlename"];
			$institute = $row["institute"];
			$username = $row["username"];
			$role = $row["role"];

			// Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

			// Avatar
			$avatar  = " <a data-fancybox='' data-src='../../assets/uploads/avatars/" . $row["avatar"] . "'>";
			$avatar .= " <button class='btn btn-secondary btn-sm'>View</button>";
			$avatar .= " </a>";
			
			// Suffix
			if (!in_array($row["suffix"], [null, ''])) {
				$suffix = $row["suffix"];
			}else{
				$suffix = "- - -";
			}

			// Middle name
			if (!in_array($row["middlename"], [null, ''])) {
				$middlename = $row["middlename"];
			}else{
				$middlename = "- - -";
			}

			// Fullname
			if (!in_array($row["suffix"], [null, ''])) {
				$fullname = $lastname . ' ' . $suffix . ', ' . $firstname . ' ' . $middlename; 
			}else if (!in_array($row["middlename"], [null, ''])) {
				$fullname = $lastname . ', ' . $firstname . ' ' . $middlename; 
			}else{
				$fullname = $lastname . ', ' . $firstname; 
			}

			// Institute Details
			// if(in_array($institute, ['IBM', 'ICSLIS', 'IEAS', 'MISSO', 'NTPs'])){
			// 	$sql_institutes = "SELECT institute.id,
			// 							institute.institute_code,
			// 							institute.institute_name,
			// 							institute.dean,
			// 							users.lastname,
			// 							users.firstname,
			// 							users.middlename,
			// 							users.suffix
			// 						FROM institutes as institute
			// 							INNER JOIN user_accounts AS users ON institute.dean = users.id
			// 						WHERE institute.institute_code = '" . $institute . "'";
			// 	$query_institutes = mysqli_query($conn, $sql_institutes);
			// 	if (mysqli_num_rows($query_institutes) > 0) {
			// 		while ($row_institutes = mysqli_fetch_assoc($query_institutes)) {
			// 			$dean_lastname = $row_institutes['lastname'];
			// 			$dean_firstname = $row_institutes['firstname'];
			// 			$dean_middlename = $row_institutes['middlename'];
			// 			$dean_suffix = $row_institutes['suffix'];
						
			// 			if (!in_array($row["suffix"], [null, ''])) {
			// 				$dean_fullname = $dean_lastname . ' ' . $dean_suffix . ', ' . $dean_firstname . ' ' . $dean_middlename; 
			// 			}else if (!in_array($row["middlename"], [null, ''])) {
			// 				$dean_fullname = $dean_lastname . ', ' . $dean_firstname . ' ' . $dean_middlename; 
			// 			}else{
			// 				$dean_fullname = $dean_lastname . ', ' . $dean_firstname; 
			// 			}

			// 			$institute_details = "<button type='button'
			// 										class='bg-transparent border-0'
			// 										data-bs-toggle='modal'
			// 										data-bs-target='#institute_information'
			// 										data-bs-modal-title='Institute Information'
			// 										data-bs-institute_code='" . $row_institutes['institute_code'] . "'
			// 										data-bs-institute_name='" . $row_institutes['institute_name'] . "'
			// 										data-bs-dean='" . $dean_fullname . "'
			// 										title='Click for more info'>
			// 										<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
			// 										" . $row_institutes['institute_code'] . "
			// 									</button>";
			// 		}
			// 	}
			// }

			if(in_array($institute, ['IBM', 'ICSLIS', 'IEAS'])){

				$sql_institutes = "	SELECT * FROM institutes
									WHERE institute_code = '" . $institute . "'";
				$query_institutes = mysqli_query($conn, $sql_institutes);
				if (mysqli_num_rows($query_institutes) > 0) {
					while ($row_institutes = mysqli_fetch_assoc($query_institutes)) {
						$institute_details = "<button type='button'
													class='bg-transparent border-0'
													data-bs-toggle='modal'
													data-bs-target='#institute_information'
													data-bs-modal-title='Institute Information'
													data-bs-institute_code='" . $row_institutes['institute_code'] . "'
													data-bs-institute_name='" . $row_institutes['institute_name'] . "'
													data-bs-dean='UserID:(" . $row_institutes['dean'] . ")'
													title='Click for more info'>
													<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
													" . $row_institutes['institute_code'] . "
												</button>";
					}
				}
			}
			// else{
			// 		$institute_details = "<button type='button'
			// 							class='bg-transparent border-0'
			// 							data-bs-toggle='modal'
			// 							data-bs-target='#institute_information'
			// 							data-bs-modal-title='Institute Information'
			// 							data-bs-institute_code='NTPs'
			// 							data-bs-institute_name='Non Teaching Personnels'
			// 							data-bs-dean='N/A'
			// 							title='Click for more info'>
			// 							<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
			// 							NTPs
			// 						</button>";
			// }

			else if($institute == 'MISSO'){
				$institute_details = "<button type='button'
										class='bg-transparent border-0'
										data-bs-toggle='modal'
										data-bs-target='#institute_information'
										data-bs-modal-title='Institute Information'
										data-bs-institute_code='MIS'
										data-bs-institute_name='Multimeadia and Information Systems Services Office'
										data-bs-dean='N/A'
										title='Click for more info'>
										<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
										MISSO
									</button>";
			}else{
				$institute_details = "<button type='button'
										class='bg-transparent border-0'
										data-bs-toggle='modal'
										data-bs-target='#institute_information'
										data-bs-modal-title='Institute Information'
										data-bs-institute_code='NTPs'
										data-bs-institute_name='Non Teaching Personnels'
										data-bs-dean='N/A'
										title='Click for more info'>
										<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
										NTPs
									</button>";
			}

			// Email
			if (!in_array($row["email"], [null, ''])) {
				$email = $row["email"];
			}else{
				$email = "- - -";
			}

			// Last Login
			if (!in_array($row["last_login"], [null, ''])) {
				$last_login = $row["last_login"];
				$last_login = strtotime($last_login);
				$last_login = date("M d, Y (D) h:i A", $last_login);
			}else{
				$last_login = "- - -";
			}

			// Status
			if ($row["is_active"] == 1) {
			    $status = "<span class='badge bg-success'>enabled</span>";
			} else if ($row["is_active"] == 0) {
				$status = "<span class='badge bg-danger'>disabled</span>";
			}

			// Action Bullet
			$actionBullet = "	<div class='btn-group d-flex justify-content-end'>";
			$actionBullet .= "	<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>
									<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>
								</button>";
			$actionBullet .= "	<div class='dropdown-menu ' id='dropdown-container'>";
			$actionBullet .= "	<button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#recoverModal' data-bs-name='" . $row["username"] . "' data-bs-href='../../assets/includes/admin/users/user.inc.php?recoverUser&id=" . $row["id"] . "' title='recover'>
									Recover
								</button>";
			if ($row["is_active"] == 1) {
				$actionBullet .= "	<button type='button' class='dropdown-item'' data-bs-toggle='modal' data-bs-target='#disableModal' data-bs-name='" . $row["username"] . "' data-bs-href='../../assets/includes/admin/users/user.inc.php?disableUser&id=" . $row["id"] . "' title='disable'>
										Disable
									</button>";
			}else{
				$actionBullet .= "	<button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#enableModal' data-bs-name='" . $row["username"] . "' data-bs-href='../../assets/includes/admin/users/user.inc.php?enableUser&id=" . $row["id"] . "' title='enable'>
									Enable
								</button>";
			}
			if (in_array($role, ['Faculty', 'Student'])) {
				$actionBullet .= "	<a class='dropdown-item' href='edit?userId=" . $id . "' title='edit'>
										Edit
									</a>";
			}
			$actionBullet .= "	<button type='button' class='dropdown-item'' data-bs-toggle='modal' data-bs-target='#deleteModal' data-bs-name='" . $row["username"] . "' data-bs-href='../../assets/includes/admin/users/user.inc.php?deleteUser&id=" . $row["id"] . "' title='delete'>
									Delete
								</button>";
			$actionBullet .= "	</div></div>";

			$subdata = array();

			// Data to array
			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $avatar;
			$subdata[] = $fullname;
			$subdata[] = $lastname;
			$subdata[] = $firstname;
			$subdata[] = $middlename;
			$subdata[] = $suffix;
			$subdata[] = $institute_details;
			$subdata[] = $institute;
			$subdata[] = $email;
			$subdata[] = $username;
			$subdata[] = $role;
			$subdata[] = $last_login;
			$subdata[] = $status;
			$subdata[] = $actionBullet;

			$data[] = $subdata;
		}
	}

	$jsonData = array(
		"draw"				=> intval($request['draw']),
		"recordsTotal"    	=> intval( $totalRecords ),  
		"recordsFiltered" 	=> intval($totalRecords),
		"data"            	=> $data   // total data array
		);

	echo json_encode($jsonData);  // send data as json format
}