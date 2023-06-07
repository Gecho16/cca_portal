<!-- User Information Modal -->
<div id="user_information" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center"></h3>
            </div>
            <div class="modal-body">
                <!-- Details Here -->
                <img class="avatar rounded mx-auto d-block" style="width: 200px!important; height: 200px!important;" src="" alt="user.avatar">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Full Name:</td>
                            <td class="fullname"></td>
                        </tr>
                        <tr>
                            <td>Institute:</td>
                            <td class="institute"></td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td class="username"></td>
                        </tr>
                        <tr>
                            <td>Role:</td>
                            <td class="role"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let user_information = document.getElementById("user_information");
    user_information.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let modalTitle = button.getAttribute("data-bs-modal-title");
        let fullname = button.getAttribute("data-bs-fullname");
        let institute = button.getAttribute("data-bs-institute");
        let username = button.getAttribute("data-bs-username");
        let role = button.getAttribute("data-bs-role");

        let modalBodyTitle = user_information.querySelector(".modal-header .modal-title");
        let modalBodyfullname = user_information.querySelector(".modal-body .fullname");
        let modalBodyinstitute = user_information.querySelector(".modal-body .institute");
        let modalBodyusername = user_information.querySelector(".modal-body .username");
        let modalBodyrole = user_information.querySelector(".modal-body .role");

        modalBodyTitle.innerHTML = modalTitle;
        modalBodyfullname.innerHTML = fullname;
        modalBodyinstitute.innerHTML = institute;
        modalBodyusername.innerHTML = username;
        modalBodyrole.innerHTML = role;

        let avatar = "../../assets/uploads/avatars/" + button.getAttribute("data-bs-avatar");
        let modalBodyavatar = user_information.querySelector(".modal-body .avatar");
        modalBodyavatar.src = avatar;
    });
</script>

<!-- Action Details Modal -->
<div id="action_details" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center"></h3>
            </div>
            <div class="modal-body">
                <!-- Details Here -->
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Action:</td>
                            <td class="action"></td>
                        </tr>
                        <tr>
                            <td>Item Type:</td>
                            <td class="item_type"></td>
                        </tr>
                        <tr>
                            <td>Item ID:</td>
                            <td class="item"></td>
                        </tr>
                        <tr>
                            <td>Details:</td>
                            <td class="details"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type='button'
                        class='btn btn-secondary revbtn'
                        data-bs-toggle='modal'
                        data-bs-target='#revert_modal'
                        data-bs-modal-title=' Revert Action '
                        data-bs-action-revert=''
                        data-bs-date=''
                        title='Revert action'>
                        Revert
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let action_details = document.getElementById("action_details");
    action_details.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let modalTitle = button.getAttribute("data-bs-modal-title");
        let action = button.getAttribute("data-bs-action");
        let item_type = button.getAttribute("data-bs-item_type");
        let item = button.getAttribute("data-bs-item");
        let details = button.getAttribute("data-bs-details");

        let modalBodyTitle = action_details.querySelector(".modal-header .modal-title");
        let modalBodyaction = action_details.querySelector(".modal-body .action");
        let modalBodyitem_type = action_details.querySelector(".modal-body .item_type");
        let modalBodyitem = action_details.querySelector(".modal-body .item");
        let modalBodydetails = action_details.querySelector(".modal-body .details");

        modalBodyTitle.innerHTML = modalTitle;
        modalBodyaction.innerHTML = action;
        modalBodyitem_type.innerHTML = item_type;
        modalBodyitem.innerHTML = item;
        modalBodydetails.innerHTML = details;

        let actionlog = button.getAttribute("data-bs-action-revert");
        let date = button.getAttribute("data-bs-date");

        let modalBodyrevbtn= action_details.querySelector(".modal-body .revbtn");

        modalBodyrevbtn.setAttribute("data-bs-action-revert", actionlog);
        modalBodyrevbtn.setAttribute("data-bs-date", date);

    });
</script>

<!-- Revert Button Modal -->
<div id="revert_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center"></h3>
            </div>
            <div class="modal-body">
                <!-- Details Here -->
                <p class="text-center">Are you sure you want to revert this action?</p>
                <p class="text-center"><strong class="action"></strong></p>
                <p class="text-center">on <strong class="date"></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeleteSelected" class="btn btn-danger" onclick="">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let revert_modal = document.getElementById("revert_modal");
    revert_modal.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let modalTitle = button.getAttribute("data-bs-modal-title");
        let action = button.getAttribute("data-bs-action-revert");
        let date = button.getAttribute("data-bs-date");

        let modalBodyTitle = revert_modal.querySelector(".modal-header .modal-title");
        let modalBodyaction = revert_modal.querySelector(".modal-body .action");
        let modalBodydate = revert_modal.querySelector(".modal-body .date");

        modalBodyTitle.innerHTML = modalTitle;
        modalBodyaction.innerHTML = action;
        modalBodydate.innerHTML = date;
    });
</script>

<!-- Revert Selected Button Modal -->
<div id="revert_selected_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center"></h3>
            </div>
            <div class="modal-body">
                <!-- Details Here -->
                <p class="text-center question"></p>
                <p class="text-center"><strong class="action"></strong><strong class="date"></strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeleteSelected" class="btn btn-danger" onclick="">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let revert_selected_modal = document.getElementById("revert_selected_modal");
    revert_selected_modal.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let modalTitle = button.getAttribute("data-bs-modal-title");

        let modalBodyTitle = revert_selected_modal.querySelector(".modal-header .modal-title");
        let modalBodyquestion = revert_selected_modal.querySelector(".modal-body .question");
        let modalBodyaction = revert_selected_modal.querySelector(".modal-body .action");

        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        var rowcount = checkboxes.length;

        var checkboxIds = getCheckboxIds();
        var question = "";
        var action = '';

        if (!checkboxIds || checkboxIds.length === 0) {
            question = "No rows selected";
        } else if (checkboxIds.includes("selectAll") && checkboxIds.length == rowcount) {
            question = "Are you sure you want to revert all action(s)?";
        } else {
            checkboxIds.sort(function(a, b) {
                return parseInt(a) - parseInt(b);
            });
            question = "Are you sure you want to revert selected action(s)?";
            var stringToRemove = "selectAll";

            var checkboxIds = checkboxIds.filter(function(element) {
                return element !== stringToRemove;
            });
            var action = checkboxIds.map(id => `(ID:${id})`);;
        }

        modalBodyTitle.innerHTML = modalTitle;
        modalBodyquestion.innerHTML = question;
        modalBodyaction.innerHTML = action;
    });
</script>