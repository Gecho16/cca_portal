<?php

$baseUrl = "../../";

$title = "City College of Angeles - Totalis Humanae";
$page = "users";

include $baseUrl . "assets/templates/admin/header.inc.php";

?>

<!-- BODY HEADER -->
<div class="d-flex justify-content-between align-items-center mb-3 d-print-none">
    <div class="d-flex flex-column align-items-start w-50">
        <h1 id="page-title" class="h1">User Accounts</h1>
    </div>
    <div class="d-flex flex-column w-50">
        <div class="d-flex justify-content-end align-items-center my-2">
            <div class="d-flex align-items-center">
                <select class="form-select me-2" id="tableSelect">
                    <option value='users'>User Accounts</option>
                    <option value='logs'>User Logs</option>
                </select>
            </div>	
        </div>
        <div class="d-flex justify-content-end">
            <div class="d-flex mx-2">
                <a class='btn bg-white border border-dark d-flex' href='add'>
                    Add User
                </a>
            </div>
            <div class="d-flex mx-2">
                <a class="btn bg-white border border-dark d-flexx justify-content-center align-items-center" href="import">
                    <i class="fa-solid fa-upload me-2"></i>
                    Import
                </a>
            </div>
        </div>
    </div>
</div>

<!-- TABLE -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <form method="POST" action='../../assets/includes/admin/users/user.inc.php?deleteSelectedUser' id="userListform">
                <table class="table table-striped table-sm w-100" id="users"></table>
            </form>
        </div>
    </div>
</div>
<?php

include $baseUrl . "assets/modals/admin/users/user_modals.php";
include $baseUrl . "assets/modals/admin/users/user_logs_modals.php";
include $baseUrl . "assets/templates/admin/footer.inc.php";
?>

<script>
// Initialize Tables
function userListTable(){
    $.getScript('../../assets/js/admin/users/user-table-script.js');
}
function userLogsTable(){
    $.getScript('../../assets/js/admin/users/user-logs-script.js');
}

userListTable()

// Refresh table when view value is changed
$('#tableSelect').on('change', function() {
    view = document.getElementById("tableSelect").value;
    var table = $('#users').DataTable();
    var container = $('#users');

    if ($.fn.DataTable.isDataTable('#users')) {
        table.destroy();
        container.remove();
    }

    var parentContainer = $('#userListform');
    var newTable = $('<table class="table table-striped table-sm w-100" id="users"></table>');
    parentContainer.append(newTable);

    if(view == 'users'){
        userListTable();
        document.getElementById("page-title").innerHTML = 'User Accounts';
    }else if(view == 'logs'){
        userLogsTable()
        document.getElementById("page-title").innerHTML = 'User Logs';
    }
});

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
</script>