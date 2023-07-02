<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

$year_start = range(strftime("%Y", time()), 2098);

// Get room
$room_id = sanitize($_GET["room"]);
$room = "SELECT * FROM rooms WHERE id = $room_id";
$result_room = mysqli_query($conn, $room);
$row_room = mysqli_fetch_assoc($result_room);

// Set Variables
$room_name = $row_room['room_name'];
$room_code = $row_room['room_code'];
$type = $row_room['type'];
$location = $row_room['location'];

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Edit Room</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../?table=rooms">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/room.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Room Information</label>
                    <!-- Room Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Room Name</label>
                            <input type="text" class="form-select form-select-lg" id="room_name" name="room_name" value='<?= $room_name ?>' required>
                            </input>
                        </div>
                    </div> 

                    <!-- Room Code -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Room Code</label>
                            <input type="text" class="form-control form-select-lg" id="room_code" name="room_code" value='<?= $room_code ?>' required>
                            </input>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Type -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Room Type</label>
                            <select class="form-select form-select-lg" id="type" name="type" required>
                                    <option value="Lecture" <?= ($type === "Lecture") ? 'selected' : '';?>>Lecture</option>
                                    <option value="Laboratory" <?= ($type === "Laboratory") ? 'selected' : '';?>>Laboratory</option>
                            </select>
                        </div>
                    </div> 

                    <!-- Room Location -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Room Location</label>
                            <select class="form-select form-select-lg" id="location" name="location" required>
                                    <option value="Main Building"  <?= ($location === "Main Building") ? 'selected' : '';?>>Main Building</option>
                                    <option value="Second Building"  <?= ($location === "Second Building") ? 'selected' : '';?>>Second Building</option>
                                    <option value="Gymnasium"  <?= ($location === "Gymnasium") ? 'selected' : '';?>>Gymnasium</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Submit button -->
                <div class="text-end">
                    <button class="btn btn-primary btn-lg" name="submitEditRoom" type="submit" value='<?= $room_id ?>'>
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<script>
    // Room Name
    var room_name = document.getElementById('room_name');

    room_name.addEventListener('input', function() {
        let words = room_name.value.split(' ');

        // Capitalize the first letter of each word
        for (let i = 0; i < words.length; i++) {
            let word = words[i];
            words[i] = word.charAt(0).toUpperCase() + word.slice(1);
        }

        // Join the words back into a string
        room_name.value = words.join(' ');
    });

    // Room Code
    var room_code = document.getElementById('room_code');

    room_code.addEventListener('input', function() {
        this.value = this.value.replace(/[^a-zA-Z0-9-_-]/g, '').toUpperCase();
        if (this.value.length > 8) {
            this.value = this.value.substring(0, 8);
        }
    });
</script>
