<!-- ENABLE MODAL -->
<div class="modal fade" id="activateModal" tabindex="-1" aria-labelledby="activateModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="activateModalLabel">Activate Academic Year</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to activate <strong class="name"></strong>?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<a href="#" class="btn btn-success href">Confirm</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	let activateModal = document.getElementById("activateModal");

	activateModal.addEventListener("show.bs.modal", function (event) {
		let button = event.relatedTarget;

		let name = button.getAttribute("data-bs-name");
		let modalBodyName = activateModal.querySelector(".modal-body .name");
		modalBodyName.innerHTML = name;

		let href = button.getAttribute("data-bs-href");
		let modalFooterHref = activateModal.querySelector(".modal-footer .href");
		modalFooterHref.href = href;
	});
</script>

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Academic Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong class="name"></strong>?</p>
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