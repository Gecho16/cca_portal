<?php

$baseUrl = "../";

$title = "City College of Angeles - Totalis Humanae";
$page = "dashboard";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<!-- FULL CALENDAR SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1/index.global.min.js"></script>

<div class="">
	<div class="">
		<h1 id="page-title" class="h1">Users</h1>
		<!-- Carousel -->
		<div id="dashboard" class="carousel slide px-4" data-bs-ride="carousel">
			<!-- Include Sliders -->
			<?php include $baseUrl . "assets/api/admin/dashboard/user-count.inc.php";?>
			<!-- Navigation Buttons -->
			
			<button class="carousel-control-prev" type="button" data-bs-target="#dashboard" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"><i class="fa-solid fa-chevron-left carousel-arrows"></i></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#dashboard" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"><i class="fa-solid fa-chevron-right carousel-arrows"></i></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
	<div class="d-flex flex-row ">
		<div class="calendar-container mx-2  w-100">
			<h1 id="page-title" class="h1">Calendar</h1>
			<div class="card mx-2">
				<div class="card-body">
					<div id="calendar" class="calendar">
					</div>
				</div>
			</div>
		</div>
		<div class="event-container mx-2 w-100">
			<h1 id="page-title" class="h1">Events</h1>
			<div class="card mx-2">
			<div class="card-body">
					<div id="events" class="calendar">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

include $baseUrl . "assets/templates/admin/footer.inc.php";

?>

<script>
// Carousel script
document.addEventListener("DOMContentLoaded", function() {
	var carousel = document.querySelector("#dashboard");
	var pageTitle = document.querySelector("#page-title");

	carousel.addEventListener("slid.bs.carousel", function() {
		var activeSlide = carousel.querySelector(".carousel-item.active");
		var slideContent = activeSlide.querySelector("input").value;

		pageTitle.innerHTML = slideContent;
	});
});

// Table script
// $( document ).ready(function() {
//     $.getScript('../assets/js/admin/user-logs-script.js');
// });


// Select all checkbox
function select_all(){
	if(jQuery('#selectAll').prop("checked")){
		jQuery('input[type=checkbox]').each(function(){
			jQuery('#'+this.id).prop('checked',true);
            // console.log(this.id);
		});
	}else{
		jQuery('input[type=checkbox]').each(function(){
			jQuery('#'+this.id).prop('checked',false);
            // console.log(this.id);
		});
	}
}

// Get checkbox Ids
function getCheckboxIds() {
  	var checkboxIds = [];
  	jQuery('input[type="checkbox"]:checked').each(function() {
    	checkboxIds.push(this.id);
  	});
	// console.log(checkboxIds);
 	return checkboxIds;
}

// Calendar script
document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
	views: {
		dayGridMonth: { // name of view
		titleFormat: { year: 'numeric', month: 'short'}
		// other view-specific options here
		}
	},
	initialView: 'dayGridMonth',
});
calendar.render();
calendar.setOption('contentHeight', 300);
});

document.addEventListener('DOMContentLoaded', function() {
var calendarEl = document.getElementById('events');
var calendar = new FullCalendar.Calendar(calendarEl, {
	views: {
		listMonth: { // name of view
		titleFormat: { year: 'numeric', month: 'short'}
		// other view-specific options here
		}
	},
	initialView: 'listMonth',
	// events: 'https://fullcalendar.io/api/demo-feeds/events.json'
});
calendar.render();
calendar.setOption('contentHeight', 300);
});

</script>
