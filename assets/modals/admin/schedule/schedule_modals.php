<!-- Subject Information Modal -->
<div id="subject_information" class="modal fade">
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
                            <td>Subject Name:</td>
                            <td class="subject_title"></td>
                        </tr>
                        <tr>
                            <td>Subject Code:</td>
                            <td class="subject_code"></td>
                        </tr>
                        <tr>
                            <td>Institute:</td>
                            <td class="institute"></td>
                        </tr>
                        <tr>
                            <td>Course:</td>
                            <td class="course"></td>
                        </tr>
                        <tr>
                            <td>Lecture Hours:</td>
                            <td class="lecture_hours"></td>
                        </tr>
                        <tr>
                            <td>Laboratory Hours:</td>
                            <td class="laboratory_hours"></td>
                        </tr>
                        <tr>
                            <td>Credited Units:</td>
                            <td class="credited_units"></td>
                        </tr>
                        <tr>
                            <td>Pre-requisite(s):</td>
                            <td class="prerequisites"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let subject_information = document.getElementById("subject_information");
    subject_information.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let modalTitle = button.getAttribute("data-bs-modal-title");
        let subject_title = button.getAttribute("data-bs-subject_title");
        let subject_code = button.getAttribute("data-bs-subject_code");
        let institute = button.getAttribute("data-bs-institute");
        let course = button.getAttribute("data-bs-course");
        let lecture_hours = button.getAttribute("data-bs-lecture_hours");
        let laboratory_hours = button.getAttribute("data-bs-laboratory_hours");
        let credited_units = button.getAttribute("data-bs-credited_units");
        let prerequisites = button.getAttribute("data-bs-prerequisites");

        let modalBodyTitle = subject_information.querySelector(".modal-header .modal-title");
        let modalBodySubjectTitle = subject_information.querySelector(".modal-body .subject_title");
        let modalBodySubjectCode = subject_information.querySelector(".modal-body .subject_code");
        let modalBodyInstitute = subject_information.querySelector(".modal-body .institute");
        let modalBodyCourse = subject_information.querySelector(".modal-body .course");
        let modalBodyLectureHours = subject_information.querySelector(".modal-body .lecture_hours");
        let modalBodyLaboratoryHours = subject_information.querySelector(".modal-body .laboratory_hours");
        let modalBodyCreditedUnits = subject_information.querySelector(".modal-body .credited_units");
        let modalBodyPrerequisites = subject_information.querySelector(".modal-body .prerequisites");

        modalBodyTitle.innerHTML = modalTitle;
        modalBodySubjectTitle.innerHTML = subject_title;
        modalBodySubjectCode.innerHTML = subject_code;
        modalBodyInstitute.innerHTML = institute;
        modalBodyCourse.innerHTML = course;
        modalBodyLectureHours.innerHTML = lecture_hours;
        modalBodyLaboratoryHours.innerHTML = laboratory_hours;
        modalBodyCreditedUnits.innerHTML = credited_units;
        modalBodyPrerequisites.innerHTML = prerequisites;
    });
</script>

<!-- Instructor Information Modal -->
<div id="instructor_information" class="modal fade">
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
                            <td>Full Name:</td>
                            <td class="fullname"></td>
                        </tr>
                        <tr>
                            <td>Institute:</td>
                            <td class="institute"></td>
                        </tr>
                        <tr>
                            <td>Reference Number:</td>
                            <td class="reference_number"></td>
                        </tr>
                        <tr>
                            <td>Employee Type:</td>
                            <td class="type"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let instructor_information = document.getElementById("instructor_information");
    instructor_information.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let modalTitle = button.getAttribute("data-bs-modal-title");

        let modalBodyTitle = instructor_information.querySelector(".modal-header .modal-title");

        modalBodyTitle.innerHTML = modalTitle;

        let fullname = button.getAttribute("data-bs-fullname");
        let institute = button.getAttribute("data-bs-institute");
        let referenceNumber = button.getAttribute("data-bs-reference_number");
        let type = button.getAttribute("data-bs-type");

        let modalBodyFullname = instructor_information.querySelector(".modal-body .fullname");
        let modalBodyInstitute = instructor_information.querySelector(".modal-body .institute");
        let modalBodyReferenceNumber = instructor_information.querySelector(".modal-body .reference_number");
        let modalBodyType = instructor_information.querySelector(".modal-body .type");

        modalBodyFullname.innerHTML = fullname;
        modalBodyInstitute.innerHTML = institute;
        modalBodyReferenceNumber.innerHTML = referenceNumber;
        modalBodyType.innerHTML = type;
    });
</script>

<!-- Synchronous Information Modal -->
<div id="synchronous_information" class="modal fade">
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
                            <td>Day:</td>
                            <td class="synch_day"></td>
                        </tr>
                        <tr>
                            <td>Time:</td>
                            <td class="synch_time"></td>
                        </tr>
                        <tr>
                            <td>Type:</td>
                            <td class="synch_type"></td>
                        </tr>
                        <tr>
                            <td>Room:</td>
                            <td class="synch_room"></td>
                        </tr>
                        <tr>
                            <td>Location:</td>
                            <td class="synch_location"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let synchronous_information = document.getElementById("synchronous_information");
    synchronous_information.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let modalTitle = button.getAttribute("data-bs-modal-title");

        let modalBodyTitle = synchronous_information.querySelector(".modal-header .modal-title");

        modalBodyTitle.innerHTML = modalTitle;

        let synchDay = button.getAttribute("data-bs-synch_day");
        let synchTime = button.getAttribute("data-bs-synch_time");
        let synchType = button.getAttribute("data-bs-synch_room_type");
        let synchRoom = button.getAttribute("data-bs-synch_room");
        let synchLocation = button.getAttribute("data-bs-synch_room_location");

        let modalBodySynchDay = synchronous_information.querySelector(".modal-body .synch_day");
        let modalBodySynchTime = synchronous_information.querySelector(".modal-body .synch_time");
        let modalBodySynchType = synchronous_information.querySelector(".modal-body .synch_type");
        let modalBodySynchRoom = synchronous_information.querySelector(".modal-body .synch_room");
        let modalBodySynchLocation = synchronous_information.querySelector(".modal-body .synch_location");

        modalBodySynchDay.innerHTML = synchDay;
        modalBodySynchTime.innerHTML = synchTime;
        modalBodySynchType.innerHTML = synchType;
        modalBodySynchRoom.innerHTML = synchRoom;
        modalBodySynchLocation.innerHTML = synchLocation;

    });
</script>

<!-- Asynchronous Information Modal -->
<div id="asynchronous_information" class="modal fade">
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
                            <td>Day:</td>
                            <td class="asynch_day"></td>
                        </tr>
                        <tr>
                            <td>Time:</td>
                            <td class="asynch_time"></td>
                        </tr>
                        <tr>
                            <td>Type:</td>
                            <td class="asynch_type"></td>
                        </tr>
                        <tr>
                            <td>Room:</td>
                            <td class="asynch_room"></td>
                        </tr>
                        <tr>
                            <td>Location:</td>
                            <td class="asynch_location"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let asynchronous_information = document.getElementById("asynchronous_information");
    asynchronous_information.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let modalTitle = button.getAttribute("data-bs-modal-title");

        let modalBodyTitle = asynchronous_information.querySelector(".modal-header .modal-title");

        modalBodyTitle.innerHTML = modalTitle;

        let asynchDay = button.getAttribute("data-bs-asynch_day");
        let asynchTime = button.getAttribute("data-bs-asynch_time");
        let asynchType = button.getAttribute("data-bs-asynch_room_type");
        let asynchRoom = button.getAttribute("data-bs-asynch_room");
        let asynchLocation = button.getAttribute("data-bs-asynch_room_location");

        let modalBodyAsynchDay = asynchronous_information.querySelector(".modal-body .asynch_day");
        let modalBodyAsynchTime = asynchronous_information.querySelector(".modal-body .asynch_time");
        let modalBodyAsynchType = asynchronous_information.querySelector(".modal-body .asynch_type");
        let modalBodyAsynchRoom = asynchronous_information.querySelector(".modal-body .asynch_room");
        let modalBodyAsynchLocation = asynchronous_information.querySelector(".modal-body .asynch_location");

        modalBodyAsynchDay.innerHTML = asynchDay;
        modalBodyAsynchTime.innerHTML = asynchTime;
        modalBodyAsynchType.innerHTML = asynchType;
        modalBodyAsynchRoom.innerHTML = asynchRoom;
        modalBodyAsynchLocation.innerHTML = asynchLocation;
    });
</script>

<!-- Remarks Information Modal -->
<div id="remarks_information" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center"></h3>
            </div>
            <div class="modal-body">
                <!-- Details Here -->
                <h5 class="type text-center"></h5>
                <p class="remarks "></p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let remarks_information = document.getElementById("remarks_information");
    remarks_information.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let modalTitle = button.getAttribute("data-bs-modal-title");

        let modalBodyTitle = remarks_information.querySelector(".modal-header .modal-title");

        modalBodyTitle.innerHTML = modalTitle;

        let type = button.getAttribute("data-bs-type");
        let remarks = button.getAttribute("data-bs-remarks");

        let modalBodytype = remarks_information.querySelector(".modal-body .type");
        let modalBodyremarks = remarks_information.querySelector(".modal-body .remarks");

        modalBodytype.innerHTML = type;
        modalBodyremarks.innerHTML = remarks;
    });
</script>