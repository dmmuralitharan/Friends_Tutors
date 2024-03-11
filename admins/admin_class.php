<section class="container mt-5">
	<div class="d-flex mb-3">
		<a href="admin_home.php?class" class="btn btn-primary-clr  ms-auto" data-bs-toggle="modal" data-bs-target="#addClass">
			Add class
		</a>
	</div>
	<?php
	$class_details = mysqli_query($conn, "SELECT * FROM class");
	if ($class_details) {
		if (mysqli_num_rows($class_details) > 0) {
	?>
			<table class="table text-center">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Class ID</th>
						<th scope="col">Term</th>
						<th scope="col">Class</th>
						<th scope="col">Subjects</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				</tbody>
		<?php
			$row_count = 1;
			while ($class_details_row = mysqli_fetch_assoc($class_details)) {
				echo ("
							<tr>
								<th scope='row'>$row_count</th>
								<td>" . $class_details_row['classid'] . "</td>
								<td>" . $class_details_row['termid'] . "</td>
								<td>" . $class_details_row['classname'] . "</td>
								<td>" . $class_details_row['subjects'] . "</td>
								<td class='actions'>
									<a href='admin_home.php?class' class='btn p-0 me-4' data-bs-toggle='modal' data-bs-classid='" . $class_details_row['classid'] . "' data-bs-termname='" . $class_details_row['termid'] . "' data-bs-classname='" . $class_details_row['classname'] . "' data-bs-classsubjects='" . $class_details_row['subjects'] . "' data-bs-target='#editClass'>
										<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
										<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
										<path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
										</svg>
									</a>
									<a href='admin_home.php?class&d=" . $class_details_row['classid'] . "' class=''> 
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
			echo ("<h3 class='text-center text-danger'>No Classes Available</h3>");
		}
	} else {
		echo ("ERROR" . mysqli_error($conn));
	}
		?>
		</tbody>
			</table>
</section>

<div class="modal fade" id="addClass">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addClassLabel">Add New Class</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="cid" name="cid" placeholder="Class ID" autocomplete="off" required="required">
						<label for="cid">Class ID</label>
					</div>

					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="cname" name="cname" placeholder="Subject Name" autocomplete="off" required="required">
						<label for="cname">Class Name</label>
					</div>

					<select class="form-select form-select mb-3" name="term">
						<option selected>Select the Term</option>
						<?php
						$term_checking = mysqli_query($conn, "SELECT * FROM terms");
						if ($term_checking) {
							if (mysqli_num_rows($term_checking) > 0) {
								while ($term_details_row = mysqli_fetch_assoc($term_checking)) {
									$termid = $term_details_row['termid'];
									$termname = $term_details_row['termname'];
									echo ("
										<option value='$termname'>$termname</option>		
										");
								}
							} else {
								echo ("<h3 class='text-center text-danger'>No Term Found</h3>");
							}
						} else {
							echo "Error: " . mysqli_error($conn);
						}
						?>
					</select>

					<div class="mb-3">
						<label class="d-block">Select Subjects</label>
						<?php
						$subject_checking = mysqli_query($conn, "SELECT * FROM subjects");
						if ($subject_checking) {
							if (mysqli_num_rows($subject_checking) > 0) {
								$temp = 0;
								while ($subject_details_row = mysqli_fetch_assoc($subject_checking)) {
									$sid = $subject_details_row['subjectid'];
									$sname = $subject_details_row['subject'];
									echo ("
										<div class='form-check form-check-inline'>
											<input class='form-check-input' type='checkbox' name='classsubjects[]' id='classsubject$temp' value='$sname'>
											<label class='form-check-label' for='classsubject$temp'>$sname</label>
										</div>
										");
									$temp++;
								}
							} else {
								echo ("<h3 class='text-center text-danger'>No Subject Found</h3>");
							}
						} else {
							echo "Error: " . mysqli_error($conn);
						}
						?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="add-class-submit" class="btn btn-primary-clr">Add Class</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editClass">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addClassLabel">Edit Class</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="cid" name="cid" placeholder="Class ID" autocomplete="off" required="required">
						<label for="cid">Class ID</label>
					</div>

					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="cname" name="cname" placeholder="Subject Name" autocomplete="off" required="required">
						<label for="cname">Class Name</label>
					</div>

					<select class="form-select form-select mb-3" name="term" id="term">
						<option selected>Select the Term</option>
						<?php
						$term_checking = mysqli_query($conn, "SELECT * FROM terms");
						if ($term_checking) {
							if (mysqli_num_rows($term_checking) > 0) {
								while ($term_details_row = mysqli_fetch_assoc($term_checking)) {
									$termid = $term_details_row['termid'];
									$termname = $term_details_row['termname'];
									echo ("
										<option value='$termname'>$termname</option>		
										");
								}
							} else {
								echo ("<h3 class='text-center text-danger'>No Term Found</h3>");
							}
						} else {
							echo "Error: " . mysqli_error($conn);
						}
						?>
					</select>

					<div class="mb-3">
						<label class="d-block">Select Subjects</label>
						<?php
						$subject_checking = mysqli_query($conn, "SELECT * FROM subjects");
						if ($subject_checking) {
							if (mysqli_num_rows($subject_checking) > 0) {
								$temp = 0;
								while ($subject_details_row = mysqli_fetch_assoc($subject_checking)) {
									$sid = $subject_details_row['subjectid'];
									$sname = $subject_details_row['subject'];
									echo ("
										<div class='form-check form-check-inline'>
											<input class='form-check-input' type='checkbox' name='classsubjects[]' id='clssubject$temp' value='$sname'>
											<label class='form-check-label' for='clssubject$temp'>$sname</label>
										</div>
										");
									$temp++;
								}
							} else {
								echo ("<h3 class='text-center text-danger'>No Subject Found</h3>");
							}
						} else {
							echo "Error: " . mysqli_error($conn);
						}
						?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="update-class-submit" class="btn btn-primary-clr">Update Class</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	let editClass = document.getElementById('editClass')
	editClass.addEventListener('show.bs.modal', function(event) {
		let button = event.relatedTarget
		let classId = button.getAttribute('data-bs-classid')
		window.history.pushState({}, "", `admin_home.php?class&e=${classId}`);
		let termName = button.getAttribute('data-bs-termname')
		let className = button.getAttribute('data-bs-classname')

		let classIdInput = editClass.querySelector('#cid')
		let termNameInput = editClass.querySelector('#term')
		let classNameInput = editClass.querySelector('#cname')
		for (let i = 0; i < termNameInput.options.length; i++) {
			if (termNameInput.options[i].value === termName) {
				termNameInput.options[i].selected = true;
				break;
			}
		}
		classIdInput.value = classId
		classNameInput.value = className
	})
</script>

<?php

if (isset($_POST['add-class-submit'])) {
	$cid = $_POST['cid'];
	$cname = $_POST['cname'];
	$term = $_POST['term'];
	$csubjects = $_POST['classsubjects'];
	$csubjects = implode(',', $csubjects);

	$class_checking = mysqli_query($conn, "SELECT * FROM class WHERE classid='$cid'");
	if ($class_checking) {
		if (mysqli_num_rows($class_checking) > 0) {
			alertMessage('Error', 'Class ID is already taken');
		} else {
			$insert_new_class = mysqli_query($conn, "INSERT INTO class VALUES('$cid','$term','$cname','$csubjects')");
			if ($insert_new_class) {
				alertMessage('Success', 'Class Added Successfully');
				echo ("
                <script>
                setTimeout(() => {
                    window.location.href ='./admin_home.php?class';
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


if (isset($_POST['update-class-submit'])) {
	$old_cid = $_GET['e'];
	$new_cid = $_POST['cid'];
	$new_term = $_POST['term'];
	$new_cname = $_POST['cname'];
	$new_csubjects = $_POST['classsubjects'];
	$new_csubjects = implode(',', $new_csubjects);

	echo ($old_cid . "" . $new_cid . "" . $new_term . "" . $new_cname . "" . $new_csubjects);
	$update_class = mysqli_query($conn, "UPDATE class SET classid='$new_cid',termid='$new_term',classname='$new_cname',subjects='$new_csubjects' WHERE classid='$old_cid'");
	if ($update_class) {
		alertMessage('Success', 'Class Updated Successfully');
		echo ("
                <script>
                setTimeout(() => {
                    window.location.href ='./admin_home.php?class';
                }, 2000);
                </script>
                ");
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}

if (isset($_GET['class']) && isset($_GET['d'])) {
	$classid = $_GET['d'];
	$class_deleting = mysqli_query($conn, "DELETE FROM class WHERE classid='$classid'");

	if ($class_deleting) {
		alertMessage('Success', 'Class Deleted Successfully');

		echo ("
        <script>
        setTimeout(() => {
            window.location.href ='./admin_home.php?class';
        }, 2000);
        </script>
        ");
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}
mysqli_close($conn);
?>