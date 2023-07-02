<!-- Institute Information Modal -->
<div id="institute_information" class="modal fade">
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
                            <td>Code:</td>
                            <td class="institute_code"></td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td class="institute_name"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let institute_information = document.getElementById("institute_information");
    institute_information.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;

        let modalTitle = button.getAttribute("data-bs-modal-title");
        let institute_code = button.getAttribute("data-bs-institute_code");
        let institute_name = button.getAttribute("data-bs-institute_name");

        let modalBodyTitle = institute_information.querySelector(".modal-header .modal-title");
        let modalBodyinstitute_code = institute_information.querySelector(".modal-body .institute_code");
        let modalBodyinstitute_name = institute_information.querySelector(".modal-body .institute_name");
        
        modalBodyTitle.innerHTML = modalTitle;
        modalBodyinstitute_code.innerHTML = institute_code;
        modalBodyinstitute_name.innerHTML = institute_name;

    });
</script>

<!-- RECOVER MODAL -->
<div class="modal fade" id="recoverModal" tabindex="-1" aria-labelledby="recoverModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recoverModalLabel">Recover User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to recover user <strong class="name"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-warning href">Confirm</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
let recoverModal = document.getElementById("recoverModal");

recoverModal.addEventListener("show.bs.modal", function(event) {
    let button = event.relatedTarget;

    let name = button.getAttribute("data-bs-name");
    let modalBodyName = recoverModal.querySelector(".modal-body .name");
    modalBodyName.innerHTML = name;

    let href = button.getAttribute("data-bs-href");
    let modalFooterHref = recoverModal.querySelector(".modal-footer .href");
    modalFooterHref.href = href;
});
</script>

<!-- DISABLE MODAL -->
<div class="modal fade" id="disableModal" tabindex="-1" aria-labelledby="disableModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disableModalLabel">Disable User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to disable user <strong class="name"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-danger href">Confirm</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
let disableModal = document.getElementById("disableModal");

disableModal.addEventListener("show.bs.modal", function(event) {
    let button = event.relatedTarget;

    let name = button.getAttribute("data-bs-name");
    let modalBodyName = disableModal.querySelector(".modal-body .name");
    modalBodyName.innerHTML = name;

    let href = button.getAttribute("data-bs-href");
    let modalFooterHref = disableModal.querySelector(".modal-footer .href");
    modalFooterHref.href = href;
});
</script>

<!-- ENABLE MODAL -->
<div class="modal fade" id="enableModal" tabindex="-1" aria-labelledby="enableModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enableModalLabel">Enable User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to enable user <strong class="name"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-success href">Confirm</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
let enableModal = document.getElementById("enableModal");

enableModal.addEventListener("show.bs.modal", function(event) {
    let button = event.relatedTarget;

    let name = button.getAttribute("data-bs-name");
    let modalBodyName = enableModal.querySelector(".modal-body .name");
    modalBodyName.innerHTML = name;

    let href = button.getAttribute("data-bs-href");
    let modalFooterHref = enableModal.querySelector(".modal-footer .href");
    modalFooterHref.href = href;
});
</script>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete user <strong class="name"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" class="btn btn-danger href">Confirm</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
let deleteModal = document.getElementById("deleteModal");

deleteModal.addEventListener("show.bs.modal", function(event) {
    let button = event.relatedTarget;

    let name = button.getAttribute("data-bs-name");
    let modalBodyName = deleteModal.querySelector(".modal-body .name");
    modalBodyName.innerHTML = name;

    let href = button.getAttribute("data-bs-href");
    let modalFooterHref = deleteModal.querySelector(".modal-footer .href");
    modalFooterHref.href = href;
});
</script>

<!-- DELETE SELECTED MODAL -->
<div class="modal fade" id="deleteSelectedModal" tabindex="-1" aria-labelledby="deleteSelectedModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSelectedModalLabel">Delete Selected Users</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete all selected users <strong class="name"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="confirmDeleteSelected" class="btn btn-danger" onclick="">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
let deleteSelectedModal = document.getElementById("deleteSelectedModal");

var form = document.getElementById("userListform");
var button = document.getElementById("confirmDeleteSelected");

button.addEventListener("click", function () {
  form.submit();
});
</script>