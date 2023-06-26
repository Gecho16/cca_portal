<script src="../../assets/js/grid-style.js" type="module"></script>
<div id="graphics_container" class="card px-2">
        <form id="" >
            <div id="graphics" class="schedule-graphics m-2">
                <!-- Header row -->
                <div class="d-flex flex-column align-items-center justify-content-center bg-secondary border border-white display-header">Time</div>
                <div class="d-flex flex-column align-items-center justify-content-center bg-secondary border border-white display-header">Monday</div>
                <div class="d-flex flex-column align-items-center justify-content-center bg-secondary border border-white display-header">Tuesday</div>
                <div class="d-flex flex-column align-items-center justify-content-center bg-secondary border border-white display-header">Wednesday</div>
                <div class="d-flex flex-column align-items-center justify-content-center bg-secondary border border-white display-header">Thursday</div>
                <div class="d-flex flex-column align-items-center justify-content-center bg-secondary border border-white display-header">Friday</div>
                <div class="d-flex flex-column align-items-center justify-content-center bg-secondary border border-white display-header">Saturday</div>
                <!-- Time column -->
                <div class="d-flex flex-column align-items-center justify-content-space-around bg-secondary border border-white display-time-container">
                    <?php
                        // Loop counter
                        $i = 0;
                        // Starting Time
                        $time = 6;
                        // End of day  + starting time = Last hour
                        // 15(hours) + 6(:00 am) = 21(9:00 pm)
                        $endOfDay = 15;
                        while($i < $endOfDay){
                            // Set start time from 24-hour to 12 hour format 
                            if($time == 12){
                                $endTime = 1;
                            }else{
                                $endTime = $time + 1;
                            }
                    ?>
                            <!-- Display time cell -->
                            <div class="border border-white w-100 p-2 display-time"><?= sprintf("%02d", $time).":00 - ".sprintf("%02d", $endTime).":00" ?></div>
                    <?php
                            // Set end time from 24-hour to 12 hour format
                            if($time >= 12){
                                $time = 1;
                            }else{
                                $time++;
                            }
                            // Increment counter
                            $i++;
                            // End of loop
                        }
                    ?> 
                </div>
                <!-- Display time blocks and vacant blocks -->
                <?php
                    // Loop counter
                    $i = 0;
                    // Starting Time
                    $time = 6;
                    // Insert column headers to array
                    $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                    while($i < 6){
                ?>
                        <!-- Day column -->
                        <div id="<?= $days[$i];?>" class="display-day-container">
                        <?php
                            // Loop counter
                            $j = 0;
                            // Insert column headers to array
                            while($j < 15){
                        ?>
                                <!-- Day column -->
                                <a id="" class="h-20 display-day-container" href='add'> + </a>
                        <?php
                                // Increment counter 
                                $j++;
                                // End of loop
                            }
                        ?>


                        </div>
                <?php
                        // Increment counter 
                        $i++;
                        // End of loop
                    }
                ?>
            </div>
        </div>
    </form>
</div>

