<?php

$baseUrl = "../";

$title = "City College of Angeles - Totalis Humanae";
$page = "institutes";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<!-- BODY HEADERS -->
<div class="d-flex justify-content-between align-items-center mb-3 d-print-none">
    <div class="d-flex flex-column align-items-start w-50">
        <h1 id="page-title" class="h1">Institutes</h1>
    </div>
</div>


<div class="d-flex flex-row justify-content-around align-items-center">
    <div class="card" style="width: 20rem; box-shadow: 0 0 2rem 0 rgba(0,0,0,.1);">
        <img class="card-img-top p-3" src="../assets/images/photos/ibm-logo.png" alt="IBM Logo">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h3 class="h1">IBM</h3>
            <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi doloremque dolore in incidunt voluptatibus accusamus voluptatem eum quam, molestiae, quae optio.</p>
            <a href="#" class="badge badge-primary p-3 my-1" style="background-color: var(--green); color: white; font-size: .8vw; text-decoration: none;">VIEW DOCUMENT TEMPLATES</a>
            <a href="#" class="badge badge-primary p-3 my-1" style="background-color: var(--green); color: white; font-size: .8vw; text-decoration: none;">VISIT INSTITUTE PAGE</a>
        </div>
    </div>

    <div class="card" style="width: 20rem; box-shadow: 0 0 2rem 0 rgba(0,0,0,.1);">
        <img class="card-img-top p-3" src="../assets/images/photos/icslis-logo.png" alt="ICSLIS Logo">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h3 class="h1">ICSLIS</h3>
            <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi doloremque dolore in incidunt voluptatibus accusamus voluptatem eum quam, molestiae, quae optio.</p>
            <a href="#" class="badge badge-primary p-3 my-1" style="background-color: var(--green); color: white; font-size: .8vw; text-decoration: none;">VIEW DOCUMENT TEMPLATES</a>
            <a href="#" class="badge badge-primary p-3 my-1" style="background-color: var(--green); color: white; font-size: .8vw; text-decoration: none;">VISIT INSTITUTE PAGE</a>
        </div>
    </div>

    <div class="card" style="width: 20rem; box-shadow: 0 0 2rem 0 rgba(0,0,0,.1);">
        <img class="card-img-top p-3" src="../assets/images/photos/ieas-logo.png" alt="IEAS Logo">
        <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <h3 class="h1">IEAS</h3>
            <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi doloremque dolore in incidunt voluptatibus accusamus voluptatem eum quam, molestiae, quae optio.</p>
            <a href="#" class="badge badge-primary p-3 my-1" style="background-color: var(--green); color: white; font-size: .8vw; text-decoration: none;">VIEW DOCUMENT TEMPLATES</a>
            <a href="#" class="badge badge-primary p-3 my-1" style="background-color: var(--green); color: white; font-size: .8vw; text-decoration: none;">VISIT INSTITUTE PAGE</a>
        </div>
    </div>
</div>


<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

