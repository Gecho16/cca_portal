<?php

$baseUrl = "../../../../";

include $baseUrl . "assets/includes/dbh.inc.php";

allowedRole($baseUrl, "Admin");

if (isset($_GET["selectYear"])) {
	if($_GET["selectYear"] !== "All"){
		$acadYearId = $_GET["selectYear"];
		$sql = "SELECT * FROM academic_years WHERE id = $acadYearId";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

		$acadYear = $row['year']. ' ' .$row['semester'];
	}
	
	// initialize all variables
	$request = $columns = $totalRecords = $data = array();
	$request = $_REQUEST;

	// define index of column
	$columns = array( 
		0 => 'class.id',
		1 => 'class.id',
		2 => 'acad_year.semester',
		3 => 'faculty.institute',
		4 => 'course.course_code',
		5 => 'subj.subject_title',
		6 => 'course.course_code',
		7 => 'course.course_title',
		8 => 'subj.lecture_hours',
		9 => 'subj.laboratory_hours',
		10 => 'subj.credited_units',
		11 => 'class.class_code',
		12 => 'section.section',
		13 => 'class.faculty',
		14 => 'class.synch_day',
		15 => 'class.synch_day',
		16 => 'class.synch_time',
		17 => 'synch_room.room_code',
		18 => 'class.asynch_day',
		19 => 'class.asynch_day',
		20 => 'class.asynch_time',
		21 => 'asynch_room.room_code',
		22 => 'class.status',
		23 => 'class.remarks',
		24 => ''

	);
	
	$where = $sqlTot = $sqlRec = "";

	// Set leading sql string
	$sql = "SELECT 	DISTINCT class.id,
					class.class_code,
					class.faculty,
					class.synch_day,
					class.synch_time,
					class.synch_room,
					class.asynch_day,
					class.asynch_time,
					class.asynch_room,
					class.status,
					class.remarks,
					acad_year.year,
					acad_year.semester,
					institutes.institute_code,
					faculty.lastname,
					faculty.firstname,
					faculty.middlename,
					faculty.suffix,
					faculty.institute,
					faculty.reference_number,
					faculty.type,
					course.course_code,
					section.section,
					subj.subject_code,
					subj.subject_title,
					subj.lecture_hours,
					subj.laboratory_hours,
					subj.credited_units,
					COALESCE(subj.`prerequisite(s)`, '') AS prerequisites,
					synch_room.room_code AS synch_room_code,
					synch_room.type AS synch_room_type,
					synch_room.location AS synch_room_location,
					asynch_room.room_code AS asynch_room_code,
					COALESCE(asynch_room.`type`, '') AS asynch_room_type,
					COALESCE(asynch_room.`location`, '') AS asynch_room_location
			FROM 	classes AS class
					INNER JOIN academic_years AS acad_year ON class.academic_year = acad_year.id
					LEFT JOIN faculty AS faculty ON class.faculty = faculty.id
					INNER JOIN institutes ON class.institute = institutes.id
					INNER JOIN courses AS course ON class.course = course.id
					INNER JOIN sections AS section ON class.section = section.id
					INNER JOIN subjects AS subj ON class.subject = subj.id
					INNER JOIN rooms AS synch_room ON class.synch_room = synch_room.id
					LEFT JOIN rooms AS asynch_room ON class.asynch_room = asynch_room.id";
			//  WHERE class.academic_year = acad_year.id
			// 		 AND class.institute = institutes.id
			// 		 AND (class.faculty IS NULL OR class.faculty = faculty.id)
			// 		 AND class.course = course.id
			// 		 AND class.section = section.id
			// 		 AND class.subject = subj.id
			// 		 AND class.synch_room = synch_room.id
			// 		 AND (class.asynch_room IS NULL OR class.asynch_room = asynch_room.id)";
	
	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE";
		$where .= " (class.class_code LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR class.synch_day LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR class.synch_time LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR class.synch_room LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR class.asynch_day LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR class.asynch_time LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR class.asynch_room LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR class.status LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR acad_year.year LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.lastname LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.firstname LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.middlename LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.suffix LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.institute LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR faculty.type LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR course.course_code LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR section.section LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR subj.subject_code LIKE '%" . $request["search"]["value"] . "%' ";
		$where .= " OR subj.subject_title LIKE '%" . $request["search"]["value"] . "%') ";
	}

	// Set academic year
	if (empty($request["search"]["value"] && $_GET["selectYear"] !== "All")) {
		$where .= " WHERE";
	}else{
		$where .= " AND";
	}

	if($_GET["selectYear"] !== "All"){
		$where .= " (class.academic_year = '$acadYearId')";	
	}
	
	$sqlTot .= $sql;
	$sqlRec .= $sql;

	// concatenate search sql if value exists
	if(isset($where) && $where != '') {
		$sqlTot .= $where;
		$sqlRec .= $where;
	}

	// Specify row order
	if($columns[$request['order'][0]['column']] == "class.synch_day"){
		$sqlRec .=  " ORDER BY
					CASE 
						WHEN class.synch_day = 'Monday' THEN 1
						WHEN class.synch_day = 'Tuesday' THEN 2
						WHEN class.synch_day = 'Wednesday' THEN 3
						WHEN class.synch_day = 'Thursday' THEN 4
						WHEN class.synch_day = 'Friday' THEN 5
						WHEN class.synch_day = 'Saturday' THEN 6
						WHEN class.synch_day = 'Sunday' THEN 7
						WHEN class.synch_day = '' THEN 8
					END " . $request['order'][0]['dir'];
	}else if($columns[$request['order'][0]['column']] == "class.asynch_day"){
		$sqlRec .=  " ORDER BY
					CASE 
						WHEN class.asynch_day = 'Monday' THEN 1
						WHEN class.asynch_day = 'Tuesday' THEN 2
						WHEN class.asynch_day = 'Wednesday' THEN 3
						WHEN class.asynch_day = 'Thursday' THEN 4
						WHEN class.asynch_day = 'Friday' THEN 5
						WHEN class.asynch_day = 'Saturday' THEN 6
						WHEN class.asynch_day = 'Sunday' THEN 7
						WHEN class.asynch_day = '' THEN 8
						WHEN class.asynch_day IS NULL THEN 9
					END " . $request['order'][0]['dir'];
	}else if($columns[$request['order'][0]['column']] == "class.remarks" || $columns[$request['order'][0]['column']] == "class.faculty"){
		$sqlRec .=  " ORDER BY
					CASE 
						WHEN ". $columns[$request['order'][0]['column']]." IS NOT NULL THEN ". $columns[$request['order'][0]['column']]."
						WHEN ". $columns[$request['order'][0]['column']]." IS NULL THEN 1
					END " . $request['order'][0]['dir'];
	}else if(!empty($request['order'][0]['column'])){
		$sqlRec .=  " ORDER BY ". $columns[$request['order'][0]['column']]." ".$request['order'][0]['dir'];
	}else{
		$sqlRec .=  " ORDER BY class.id asc";
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
	// echo $columns[$request['order'][0]['column']];


	$queryRecords = mysqli_query($conn, $sqlRec) or die("error to fetch data");

	if (mysqli_num_rows($queryRecords) > 0) {
		while ($row = mysqli_fetch_assoc($queryRecords)) {
			
			// Variable transfer
			$id = $row["id"];
			$institute = $row["institute_code"];
			$course = $row["course_code"];
			$subject_code = $row["subject_code"];
			$subject_title = $row["subject_title"];

			// Checbox
			$checkbox = "<input id='" . $row["id"] . "' type='checkbox' name='checkbox[]' value='" . $row["id"] . "'>";

			// Academic year
			$academic_year = "A.Y. " . $row["year"] . ", " . $row["semester"];
			if($row["semester"] !== 'Summer'){
				$academic_year .= " Semester";
			}
			
			// Subject Info
			$lecture_hours = $row["lecture_hours"] . " Hours";
			$laboratory_hours = $row["laboratory_hours"] . " Hours";
			$credited_units = $row["credited_units"] . " Units";

			// Prerequisites
			if (!in_array($row["prerequisites"], [null, ''])) {
				$prerequisites = $row["prerequisites"];
			}else{
				$prerequisites = "None";
			}

			// Subject 
			$subject = "<div class='d-flex flex-row align-items-center'>
							<button type='button'
								class='bg-transparent border-0'
								data-bs-toggle='modal'
								data-bs-target='#subject_information'
								data-bs-modal-title=' Subject Information'
								data-bs-subject_title='" . $row["subject_title"] . "'
								data-bs-subject_code='" . $row["subject_code"] . "'
								data-bs-institute='" . $row["institute_code"] . "'
								data-bs-course='" . $row["course_code"] . "'
								data-bs-lecture_hours='" . $lecture_hours . "'
								data-bs-laboratory_hours='" . $laboratory_hours . "'
								data-bs-credited_units='" . $credited_units . "'
								data-bs-prerequisites='" . $prerequisites . "'
								title='Click for more info'>
								<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
								" . $row["subject_code"] . "
							</button>
						</div>";

			// Class Code
			$class_code = '<strong>' . $row["class_code"] . '</strong>';

			// Section
			$section = $row["course_code"] . '-' . $row["section"];
 
			// Instructor full name
			if (!in_array($row["faculty"], [null, ''])) { 
				if (!in_array($row["suffix"], [null, ''])) {
					$instructor_name = $row["lastname"] . " " . $row["suffix"] . ", " . $row["firstname"].  " " . $row["middlename"] ;
				}else{
					$instructor_name = $row["lastname"] . ", " . $row["firstname"].  " " . $row["middlename"] ;
				}
				$instructor = "<div class='d-flex flex-row align-items-center'>
										<button type='button'
											class='bg-transparent border-0'
											data-bs-toggle='modal'
											data-bs-target='#instructor_information'
											data-bs-modal-title='Instructor Information'
											data-bs-fullname='" . $instructor_name . "'
											data-bs-institute='" . $row['institute'] . "'
											data-bs-reference_number='" . $row['reference_number'] . "'
											data-bs-type='" . $row['type'] . "'
											title='Click for more info'>
											<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
											" . $instructor_name . "
										</button>
									</div>";

			}else{
				$instructor = "- - -";
			}

			// Catch null variable errors
			// Null days
			if (!in_array($row["synch_day"], [null, ''])) {
				$synch_day = $row["synch_day"];
			}else{
				$synch_day = "- - -";
			}
			if (!in_array($row["asynch_day"], [null, ''])) {
				$asynch_day = $row["asynch_day"];
			}else{
				$asynch_day = "- - -";
			}

			// Null times
			if (!in_array($row["synch_time"], [null, ''])) {
				$synch_time = $row["synch_time"];
				$time = DateTime::createFromFormat('H:i:s', $synch_time);
				$synch_time = $time->format('h:i A');
			}else{
				$synch_time = "- - -";
			}
			if (!in_array($row["asynch_time"], [null, ''])) {
				$asynch_time = $row["asynch_time"];
				$time = DateTime::createFromFormat('H:i:s', $asynch_time);
				$asynch_time = $time->format('h:i A');
			}else{
				$asynch_time = "- - -";
			}

			// Null rooms
			if (!in_array($row["synch_room_code"], [null, ''])) {
				$synch_room = $row["synch_room_code"];
			}else{
				$synch_room = "- - -";
			}
			if (!in_array($row["asynch_room_code"], [null, ''])) {
				$asynch_room = $row["asynch_room_code"];
			}else{
				$asynch_room = "- - -";
			}

			// Synchronous
			$synch_short = substr($synch_day, 0, 3)  . " " . $synch_time . " (" . $synch_room . ")";
			$synchronous = "<div class='d-flex flex-row align-items-center'>
								<button type='button'
									class='bg-transparent border-0'
									data-bs-toggle='modal'
									data-bs-target='#synchronous_information'
									data-bs-modal-title='Synchronous Information'
									data-bs-synch_day='" . $row["synch_day"] . "'
									data-bs-synch_time='" . $synch_time . "'
									data-bs-synch_room_type='" . $row["synch_room_type"] . "'
									data-bs-synch_room='" . $row["synch_room_code"] . "'
									data-bs-synch_room_location='" . $row["synch_room_location"] . "'
									title='Click for more info'>
									<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
									" . $synch_short . "
								</button>
							</div>";
			
			// Asynchronous
			if (!(in_array($row["asynch_day"], [null, '']) ||
				in_array($row["asynch_time"], [null, '']) ||
				in_array($row["asynch_room_code"], [null, '']))) {
					$asynch_short = substr($asynch_day, 0, 3)  . " " . $asynch_time . " (" . $asynch_room . ")";
					$asynchronous = "<div class='d-flex flex-row align-items-center'>
										<button type='button'
											class='bg-transparent border-0'
											data-bs-toggle='modal'
											data-bs-target='#asynchronous_information'
											data-bs-modal-title='Asynchronous Information'
											data-bs-asynch_day='" . $row["asynch_day"] . "'
											data-bs-asynch_time='" . $asynch_time . "'
											data-bs-asynch_room_type='" . $row["asynch_room_type"] . "'
											data-bs-asynch_room='" . $row["asynch_room_code"] . "'
											data-bs-asynch_room_location='" . $row["asynch_room_location"] . "'
											title='Click for more info'>
											<i class='me-2 fa-solid fa-circle-info fa-lg table-info-icon'></i>
											" . $asynch_short . "
										</button>
									</div>";
			}else{
				$asynchronous = "- - -";
			}

			// Status
			if($row["status"] === 'ongoing'){
				$status = "<span class='badge bg-primary w-100' title='Grades not yet finalized'>" . strtoupper($row["status"]) . "</span>";
			}else if($row["status"] === 'completed'){
				$status = "<span class='badge bg-success w-100' title='Grades finalized'>" . strtoupper($row["status"]) . "</span>";
			}else if($row["status"] === 'pending'){
				$status = "<span class='badge bg-warning w-100' title='Entry info error'>" . strtoupper($row["status"]) . "</span>";
			}else if($row["status"] === 'dropped'){
				$status = "<span class='badge bg-danger w-100' title='Class removed'>" . strtoupper($row["status"]) . "</span>";
			}else if($row["status"] === 'archived'){
				$status = "<span class='badge bg-secondary w-100' title='Class semester ended'>" . strtoupper($row["status"]) . "</span>";
			}else{
				$status = "<p class='text-center'>- - -</p>";
			}

			// Remarks
			$remarks = "<p class='text-center'>- - -</p>";
			if(!in_array($row["remarks"], [null, ''])){
				if (strpos($row["remarks"], 'Conflict') !== false){
					$remarks = "<div class='d-flex flex-row align-items-center'>
									<button type='button'
										class='bg-transparent border-0 w-100'
										data-bs-toggle='modal'
										data-bs-target='#remarks_information'
										data-bs-modal-title='Remarks Information'
										data-bs-type='Conflict with another entry'
										data-bs-remarks='" . $row["remarks"] . "'
										title='Conflict with another entry'>
										<i class='fa-solid fa-circle-exclamation fa-xl' style='color: #ffc107;'></i>
									</button>
								</div>";
				}else if (strpos($row["remarks"], 'Missing') !== false){
					$remarks = "<div class='d-flex flex-row align-items-center'>
									<button type='button'
										class='bg-transparent border-0 w-100'
										data-bs-toggle='modal'
										data-bs-target='#remarks_information'
										data-bs-modal-title='Remarks Information'
										data-bs-type='Missing Information'
										data-bs-remarks='" . $row["remarks"] . "'
										title='Missing Information'>
										<i class='fa-solid fa-triangle-exclamation fa-xl' style='color: #ff0000;'></i>
									</button>
								</div>";
				}else{
					$remarks = "<div class='d-flex flex-row align-items-center'>
									<button type='button'
										class='bg-transparent border-0 w-100'
										data-bs-toggle='modal'
										data-bs-target='#remarks_information'
										data-bs-modal-title='Remarks Information'
										data-bs-type='Unknown Error'
										data-bs-remarks='" . $row["remarks"] . "'
										title='Unknown Error'>
										<i class='fa-solid fa-circle-question fa-xl' style='color: #ff0000;'></i>
									</button>
								</div>";
				}
			}

			//Action Bullet 
			$actionBullet = "";
			$actionBullet .= "<div class='btn-group d-flex justify-content-end'>";
			$actionBullet .= "<button class='bg-transparent border-0 dropdown-toggle dropdown-toggle-no-caret' type='button' data-bs-toggle='dropdown'>";
			$actionBullet .= "<i class='fa-solid fa-ellipsis-vertical fa-xl'></i>";
			$actionBullet .= "</button>";
			$actionBullet .= "<div class='dropdown-menu' id='dropdown-container'>";
			$actionBullet .= "<button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#deleteSelectedModal' data-bs-name='' data-bs-href='../assets/includes/admin/user.inc.php?deleteSelectedUser' title='deleteSelected'>Option (Button)</button>";
			$actionBullet .= "<a class='dropdown-item' href='#' title='edit'>Option (Link)</a>";
			$actionBullet .= "</div>";
			$actionBullet .= "</div>";

			// foreach ($row as $key => $value) {
			// 	echo $key . ": " . $value . "<br>";
			// }

			$subdata = array();

			// Data to array
			$subdata[] = $checkbox;
			$subdata[] = $id;
			$subdata[] = $academic_year;
			$subdata[] = $institute;
			$subdata[] = $course;
			$subdata[] = $subject;
			$subdata[] = $subject_code;
			$subdata[] = $subject_title;
			$subdata[] = $lecture_hours;
			$subdata[] = $laboratory_hours;
			$subdata[] = $credited_units;
			$subdata[] = $class_code;
			$subdata[] = $section;
			$subdata[] = $instructor;
			$subdata[] = $synchronous;
			$subdata[] = $synch_day;
			$subdata[] = $synch_time;
			$subdata[] = $synch_room;
			$subdata[] = $asynchronous;
			$subdata[] = $asynch_day;
			$subdata[] = $asynch_time;
			$subdata[] = $asynch_room;
			$subdata[] = $status;
			$subdata[] = $remarks;
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
?>