<?php

$baseUrl = "../../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "academics";

include $baseUrl . "assets/templates/admin/header.inc.php";

$year_start = range(strftime("%Y", time()), 2098);

?>

<div class="d-flex justify-content-between align-items-center d-print-none mb-3">
    <h1 class="h3 mb-0">Add Room</h1>

    <a class="btn btn-secondary d-flex justify-content-between align-items-center" onclick="history.back()" href="../">
        <i class="fa-solid fa-chevron-left me-2"></i>
        Back
    </a>
</div>

<div class="card col-md-6">
    <form class="card-body" id="form" action="<?= $baseUrl ?>assets/includes/admin/academics/academic.inc.php" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <label class="h3" >Room Information</label>
                    <!-- Room Name -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Room Name</label>
                            <input type="text" class="form-select form-select-lg" id="room_name" name="room_name" required>
                            </input>
                        </div>
                    </div> 

                    <!-- Room Code -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Room Code</label>
                            <input type="text" class="form-select form-select-lg" id="room_code" name="room_code" required>
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
                                    <option value="Lecture">Lecture</option>
                                    <option value="Laboratory">Laboratory</option>
                            </select>
                        </div>
                    </div> 

                    <!-- Room Location -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Room Location</label>
                            <select class="form-select form-select-lg" id="location" name="location" required>
                                    <option value="Left Wing Main Building 1st floor">Left Wing Main Building 1st floor</option>
                                    <option value="Left Wing Main Building 2nd floor">Left Wing Main Building 2nd floor</option>
                                    <option value="Left Wing Main Building 3rd floor">Left Wing Main Building 3rd floor</option>
                                    <option value="Left Wing Main Building 4th floor">Left Wing Main Building 4th floor</option>
                                    <option value="Right Wing Main Building 1st floor">Right Wing Main Building 1st floor</option>
                                    <option value="Right Wing Main Building 2nd floor">Right Wing Main Building 2nd floor</option>
                                    <option value="Right Wing Main Building 3rd floor">Right Wing Main Building 3rd floor</option>
                                    <option value="Right Wing Main Building 4th floor">Right Wing Main Building 4th floor</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Submit button -->
                <div class="text-end">
                    <button class="btn btn-primary btn-lg" name="submitAddRoom" type="submit">
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
        this.value = this.value.replace(/[^a-zA-Z]/g, '').toUpperCase();
        if (this.value.length > 8) {
            this.value = this.value.substring(0, 8);
        }
    });
</script>
