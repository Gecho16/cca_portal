<div class="carousel-inner ">
    <!-- Users Count -->
    <div class="carousel-item active">
        <div class="d-flex justify-content-center">
            <!-- Title Value Container -->
            <input type="text" value="Users" hidden>
            <div class="w-100 row">
                <!-- Active Users -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Active Users</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-brown">
                                        <i class="fa-solid fa-user-gear align-middle"></i>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $sql = "SELECT * FROM user_accounts WHERE is_active = 1";
                            $result = mysqli_query($conn, $sql);
                            
                            echo "<h1 class='display-6 text-center mt-3 mb-0'>" . mysqli_num_rows($result) . "</h1>";

                            ?>
                        </div>
                    </div>
                </div>
                <!-- Inactive Users -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Inactive Users</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-brown">
                                        <i class="fa-solid fa-user-gear align-middle"></i>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $sql = "SELECT * FROM user_accounts WHERE is_active = 0";
                            $result = mysqli_query($conn, $sql);
                            
                            echo "<h1 class='display-6 text-center mt-3 mb-0'>" . mysqli_num_rows($result) . "</h1>";

                            ?>
                        </div>
                    </div>
                </div>
                <!-- Total Users -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Users</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-brown">
                                        <i class="fa-solid fa-users align-middle"></i>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $sql = "SELECT * FROM user_accounts";
                            $result = mysqli_query($conn, $sql);
                            
                            echo "<h1 class='display-6 text-center mt-3 mb-0'>" . mysqli_num_rows($result) . "</h1>";

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Student Count -->
    <div class="carousel-item">
        <div class="d-flex justify-content-center">
            <!-- Title Value Container -->
            <input type="text" value="Students" hidden>
            <div class="w-100 row">
                <!-- Active Students -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Active Students</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-brown">
                                        <i class="fa-solid fa-user-graduate align-middle"></i>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $sql = "SELECT * FROM user_accounts WHERE role = 'student' AND is_active = 1";
                            $result = mysqli_query($conn, $sql);
                            
                            echo "<h1 class='display-6 text-center mt-3 mb-0'>" . mysqli_num_rows($result) . "</h1>";

                            ?>
                        </div>
                    </div>
                </div>
                <!-- Inactive Students -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Inactive Students</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-brown">
                                        <i class="fa-solid fa-user-graduate align-middle"></i>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $sql = "SELECT * FROM user_accounts WHERE role = 'student' AND is_active = 0";
                            $result = mysqli_query($conn, $sql);
                            
                            echo "<h1 class='display-6 text-center mt-3 mb-0'>" . mysqli_num_rows($result) . "</h1>";

                            ?>
                        </div>
                    </div>
                </div>
                <!-- Total Students -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Students</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-brown">
                                        <i class="fa-solid fa-users align-middle"></i>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $sql = "SELECT * FROM user_accounts WHERE role = 'student'";
                            $result = mysqli_query($conn, $sql);
                            
                            echo "<h1 class='display-6 text-center mt-3 mb-0'>" . mysqli_num_rows($result) . "</h1>";

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Faculty  Count -->
    <div class="carousel-item">
        <div class="d-flex justify-content-center">
            <!-- Title Value Container -->
            <input type="text" value="Faculty" hidden>
            <div class="w-100 row">
                <!-- Active Students -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Full Time Faculty</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-brown">
                                        <i class="fa-solid fa-chalkboard-user align-middle"></i>
                                    </div>
                                </div>
                            </div>

                            <?php

                            $sql = "SELECT users.*,fac.type FROM user_accounts users, faculty fac WHERE users.username = fac.reference_number AND users.role = 'faculty' AND fac.type = 'COS Full-time'";
                            $result = mysqli_query($conn, $sql);
                            
                            echo "<h1 class='display-6 text-center mt-3 mb-0'>" . mysqli_num_rows($result) . "</h1>";

                            ?>
                        </div>
                    </div>
                </div>
                <!-- Part-Time Faculty -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Part Time Faculty</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-brown">
                                        <i class="fa-solid fa-chalkboard-user align-middle"></i>
                                    </div>
                                </div>
                            </div>

                            <?php

                                $sql = "SELECT users.*,fac.type FROM user_accounts users, faculty fac WHERE users.username = fac.reference_number AND users.role = 'faculty' AND fac.type = 'COS Part-time'";
                                $result = mysqli_query($conn, $sql);
                            
                            echo "<h1 class='display-6 text-center mt-3 mb-0'>" . mysqli_num_rows($result) . "</h1>";

                            ?>
                        </div>
                    </div>
                </div>
                <!-- Total Faculty -->
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Faculty</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-brown">
                                        <i class="fa-solid fa-users align-middle"></i>
                                    </div>
                                </div>
                            </div>

                            <?php

                                $sql = "SELECT users.*,fac.type FROM user_accounts users, faculty fac WHERE users.username = fac.reference_number AND users.role = 'faculty'";
                                $result = mysqli_query($conn, $sql);
                            
                            echo "<h1 class='display-6 text-center mt-3 mb-0'>" . mysqli_num_rows($result) . "</h1>";

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>