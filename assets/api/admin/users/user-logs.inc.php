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
		0 => 'date_time',
		1 => 'id',
		2 => 'user',
		3 => 'user',
		4 => 'role',
		5 => 'action',
		6 => 'action',
		7 => 'item_type',
		8 => 'item',
		9 => 'details',
		10 => 'date_time',
		11 => ''
	);
	
	$where = $sqlTot = $sqlRec = "";

	// Set leading sql string
	$sql = "SELECT 	DISTINCT user_log.id,
					user_log.user,
					user_log.action,
					user_log.item_type,
					user_log.item,
					user_log.details,
					user_log.date_time,
					user.avatar,
					user.lastname,
					user.firstname,
					user.middlename,
					user.suffix,
					user.institute,
					user.role,
					user.username
			FROM 	user_logs AS user_log
					INNER JOIN user_accounts AS user ON user_log.user = user.id";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE";
		$where .= " user_log.id LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user_log.user LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user_log.action LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user_log.item LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user_log.item_type LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user_log.details LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user_log.date_time LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user.avatar LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user.lastname LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user.firstname LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user.middlename LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user.suffix LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user.username LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user.role LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR user.username LIKE '%" . $request["search"]["value"] . "%' ";

	}

	$sqlTot .= $sql;
	$sqlRec .= $sql;

	// concatenate search sql if value exists
	if(isset($where) && $where != '') {
		$sqlTot .= $where;
		$sqlRec .= $where;
	}

	// Specify row order

	if(!empty($request['order'][0]['column'])){
		$sqlRec .=  " ORDER BY ". $columns[$request['order'][0]['column']]."   ".$request['order'][0]['dir'];
	}else{
		$sqlRec .=  " ORDER BY user_log.date_time desc";
	}

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
			$avatar = $row["avatar"];
			$username = $row["username"];
			$lastname = $row["lastname"];
			$firstname = $row["firstname"];
			$middlename = $row["middlename"];
			$suffix = $row["suffix"];
			$institute = $row["institute"];
			$details = $row["details"];
			$item = $row["item"];
			$item_type = $row["item_type"];

			// Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

			// Role
			$role = ucfirst($row["role"]);

			// User
			if($suffix == null){
				$fullname = $lastname . ', ' . $firstname . ' ' . $middlename;
			}else{
				$fullname = $lastname . ' ' . $suffix . ', ' . $firstname . ' ' . $middlename;
			}
			$user = "<div class='d-flex flex-row align-items-start'>
						<button type='button'
							class='bg-transparent border-0'
							data-bs-toggle='modal'
							data-bs-target='#user_information'
							data-bs-modal-title='User Information'
							data-bs-avatar='" . $avatar . "'
							data-bs-fullname='" . $fullname . "'
							data-bs-institute='" . $institute . "'
							data-bs-username='" . $username . "'
							data-bs-role='" . $role . "'
							title='Click for more info'>
							<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
							" . $fullname . "
						</button>
					</div>";

			// Action
			$action = $row["action"];

			// Change date and time format
			$date_time = $row["date_time"];
			$dateTime = strtotime($date_time);
			$date_time = date("M d, Y (D) h:i A", $dateTime);

			// Action Details
			$log = "<strong>" . $action . "</strong> a " . $item_type . " (ID:<strong>" . $item . "</strong>)";
			$action_detail = "<div class='d-flex flex-row align-items-start'>
						<button type='button'
							class='bg-transparent border-0'
							data-bs-toggle='modal'
							data-bs-target='#action_details'
							data-bs-modal-title='Log Information'
							data-bs-action='" . $action . "'
							data-bs-item_type='" . $item_type . "'
							data-bs-item='" . $item . "'
							data-bs-details='" . $details . "'
							data-bs-action-revert='" . $username . " " . $log . "'
							data-bs-date='" . $date_time . "'
							title='Click for more info'>
							<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
							" . $log . "
						</button>
					</div>";

			//Action Bullet 
			$actionBullet = "<div class='d-flex flex-row justify-content-end'>
							<button type='button'
								class='btn btn-sm btn-secondary'
								data-bs-toggle='modal'
								data-bs-target='#revert_modal'
								data-bs-modal-title=' Revert Action '
								data-bs-action-revert='" . $username . " " . $log . "'
								data-bs-date='" . $date_time . "'
								title='Revert action'>Revert</button>
							</div>";

			$subdata = array();

			// Data to array
			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $user;
			$subdata[] = $fullname;
			$subdata[] = $role;
			$subdata[] = $action_detail;
			$subdata[] = $action;
			$subdata[] = $item_type;
			$subdata[] = $item;
			$subdata[] = $details;
			$subdata[] = $date_time;
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