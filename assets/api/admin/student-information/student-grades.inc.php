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
		0 => 'faculty.lastname',
		1 => 'course.course_code',
		2 => 'section.section',
		3 => 'class.class_code',
		4 => 'subj.subject_code',
		5 => 'subj.subject_code',
		6 => 'subj.subject_title',
		7 => 'subj.lecture_hours',
		8 => 'subj.laboratory_hours',
		9 => 'subj.credited_units',
		10 => 'prerequisites',
		11 => 'class.status',
		12 => '',
	);
	
	$where = $sqlTot = $sqlRec = "";

	// getting total number records without any search
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
					COALESCE(subj.`prerequisite(s)`, '') AS prerequisites
			FROM 	classes AS class
					INNER JOIN academic_years AS acad_year ON class.academic_year = acad_year.id
					LEFT JOIN faculty AS faculty ON class.faculty = faculty.id
					INNER JOIN institutes ON class.institute = institutes.id
					INNER JOIN courses AS course ON class.course = course.id
					INNER JOIN sections AS section ON class.section = section.id
					INNER JOIN subjects AS subj ON class.subject = subj.id";

	// check search value exists
	if (!empty($request["search"]["value"])) {
		$where .= " WHERE";
		$where .= " (class.class_code LIKE '%" . $request["search"]["value"] . "%' ";
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
			$subdata = array();

			// Variable transfer
			$id = $row["id"];
			$institute = $row["institute_code"];
			$course = $row["course_code"];
			$subject_code = $row["subject_code"];
			$subject_title = $row["subject_title"];

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

			// Action Button
			$actionBullet = "<div class='d-flex justify-content-end'><button type='button' class='btn btn-sm rounded btn-primary' title='Edit'>Edit</button></div>";

			// foreach ($row as $key => $value) {
			// 	echo $key . ": " . $value . "<br>";
			// }

			$subdata = array();

			// Data to array
			$subdata[] = $instructor;
			$subdata[] = $course;
			$subdata[] = $section;
			$subdata[] = $class_code;
			$subdata[] = $subject;
			$subdata[] = $subject_code;
			$subdata[] = $subject_title;
			$subdata[] = $lecture_hours;
			$subdata[] = $laboratory_hours;
			$subdata[] = $credited_units;
			$subdata[] = $prerequisites;
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