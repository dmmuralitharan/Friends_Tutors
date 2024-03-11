<section class="container mt-5">
    <div class="d-flex mb-3">
        <a href="admin_home.php?subject" class="btn btn-primary-clr  ms-auto" data-bs-toggle="modal" data-bs-target="#addSubject">
            Add Subject
        </a>
    </div>

    <?php
    $subject_details = mysqli_query($conn, "SELECT * FROM subjects");
    if ($subject_details) {
        if (mysqli_num_rows($subject_details) > 0) {
    ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Subject ID</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                </tbody>
        <?php
            $row_count = 1;
            while ($subject_details_row = mysqli_fetch_assoc($subject_details)) {
                echo ("
							<tr>
								<th scope='row'>$row_count</th>
								<td>" . $subject_details_row['subjectid'] . "</td>
								<td>" . $subject_details_row['subject'] . "</td>
								<td class='actions'>
									<a href='admin_home.php?subject' class='btn p-0 me-4' data-bs-toggle='modal' data-bs-subjectid='" . $subject_details_row['subjectid'] . "' data-bs-subjectname='" . $subject_details_row['subject'] . "' data-bs-target='#editSubject'>
										<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
										<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
										<path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
										</svg>
									</a>
									<a href='admin_home.php?subject&d=" . $subject_details_row['subjectid'] . "' class='btn p-0' > 
										<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
										<path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
										<path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
										</svg>
								  	</a>
								</td>
							</tr>
						");
                $row_count++;
            }
        } else {
            echo ("<h3 class='text-center text-danger'>No Subjects Available</h3>");
        }
    } else {
        echo ("ERROR" . mysqli_error($conn));
    }
        ?>
        </tbody>
            </table>
</section>

<div class="modal fade" id="addSubject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassLabel">Add New Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sid" name="sid" placeholder="Subject ID" autocomplete="off" required="required">
                        <label for="sid">Subject ID</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="sname" name="sname" placeholder="Subject Name" autocomplete="off" required="required">
                        <label for="sname">Subject Name</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="add-subject-submit" class="btn btn-primary-clr">Add Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editSubject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassLabel">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="sid" name="sid" placeholder="Subject ID" value="">
                        <label for="sid">Subject ID</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="sname" name="sname" placeholder="Subject Name">
                        <label for="sname">Subject Name</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update-subject-submit" class="btn btn-primary-clr">Update Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let editSubject = document.getElementById('editSubject')
    editSubject.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget
        let subjectId = button.getAttribute('data-bs-subjectid')
        window.history.pushState({}, "", `admin_home.php?subject&e=${subjectId}`);
        let subjectName = button.getAttribute('data-bs-subjectname')

        let subjectIdInput = editSubject.querySelector('#sid')
        let subjectNameInput = editSubject.querySelector('#sname')

        subjectIdInput.value = subjectId
        subjectNameInput.value = subjectName
    })
</script>

<?php
if (isset($_POST['add-subject-submit'])) {

    $sid = $_POST['sid'];
    $sname = $_POST['sname'];

    $subject_checking = mysqli_query($conn, "SELECT * FROM subjects WHERE subjectid='$sid'");
    if ($subject_checking) {
        if (mysqli_num_rows($subject_checking) > 0) {
            alertMessage('Error', 'Subject ID is already taken');
        } else {
            $insert_new_subject = mysqli_query($conn, "INSERT INTO subjects VALUES('$sid', '$sname')");
            if ($insert_new_subject) {
                alertMessage('Success', 'Subject Added Successfully');
                echo ("
                <script>
                setTimeout(() => {
                    window.location.href ='./admin_home.php?subject';
                }, 2000);
                </script>
                ");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['update-subject-submit'])) {

    $old_sid = $_GET['e'];
    $new_sid = $_POST['sid'];
    $new_sname = $_POST['sname'];

    $update_subject = mysqli_query($conn, "UPDATE subjects SET subjectid='$new_sid',subject='$new_sname' WHERE subjectid='$old_sid'");
    if ($update_subject) {
        alertMessage('Success', 'Subject Updated Successfully');
        echo ("
                <script>
                setTimeout(() => {
                    window.location.href ='./admin_home.php?subject';
                }, 2000);
                </script>
                ");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_GET['subject']) && isset($_GET['d'])) {
    $subjectid = $_GET['d'];
    $subject_deleting = mysqli_query($conn, "DELETE FROM subjects WHERE subjectid='$subjectid'");

    if ($subject_deleting) {
        alertMessage('Success', 'Subject Deleted Successfully');

        echo ("
        <script>
        setTimeout(() => {
            window.location.href ='./admin_home.php?subject';
        }, 2000);
        </script>
        ");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>