<section class="container mt-5">
	<div class="d-flex mb-3">
		<a href="admin_home.php?questions" class="btn btn-primary-clr  ms-auto" data-bs-toggle="modal" data-bs-target="#addQuestion">
			Add Question
		</a>
	</div>
	<?php
	$question_details = mysqli_query($conn, "SELECT * FROM questions ORDER BY classid ASC,subjectid ASC");
	if ($question_details) {
		if (mysqli_num_rows($question_details) > 0) {

	?>
			<table class="table text-center">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Class</th>
						<th scope="col">Subject</th>
						<th scope="col">Quetion</th>
						<th scope="col">Options</th>
						<th scope="col">Answer</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				</tbody>
		<?php
			$row_count = 1;
			while ($question_details_row = mysqli_fetch_assoc($question_details)) {
				echo ("
							<tr>
								<th scope='row'>$row_count</th>
								<td>" . $question_details_row['classid'] . "</td>
								<td>" . $question_details_row['subjectid'] . "</td>
								<td>" . $question_details_row['questiontext'] . "</td>
								<td class='text-wrap'> "); 
								
								$option_words = explode(',',$question_details_row['options']);
								foreach ($option_words as $option_word) {
									echo($option_word . "<br>");
								}

								echo ("</td>
								<td>" . $question_details_row['answers'] . "</td>
								<td class='actions text-nowrap'>
									<a href='admin_home.php?questions' class='btn p-0 me-4' data-bs-toggle='modal' data-bs-qid='" . $question_details_row['qid'] . "' data-bs-cid='" . $question_details_row['classid'] . "' data-bs-sid='" . $question_details_row['subjectid'] . "' data-bs-qtext='" . $question_details_row['questiontext'] . "' data-bs-options='" . $question_details_row['options'] . "' data-bs-answers='" . $question_details_row['answers'] . "' data-bs-target='#editQuestion'>
										<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
										<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
										<path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
										</svg>
									</a>
									<a href='admin_home.php?questions&d=" . $question_details_row['qid'] . "' class=''> 
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
			echo ("<h3 class='text-center text-danger'>No Questions Available</h3>");
		}
	} else {
		echo ("ERROR" . mysqli_error($conn));
	}
		?>
		</tbody>
	</table>
</section>

<div class="modal fade" id="addQuestion">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addClassLabel">Add New Class</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<select class="form-select form-select mb-3" name="class">
						<option selected>Select the Class</option>
						<?php
						$class_checking = mysqli_query($conn, "SELECT * FROM class");
						if ($class_checking) {
							if (mysqli_num_rows($class_checking) > 0) {
								while ($class_details_row = mysqli_fetch_assoc($class_checking)) {
									$classid = $class_details_row['classid'];
									$classname = $class_details_row['classname'];
									$termname = $class_details_row['termid'];
									echo ("
										<option value='$classid'>" . $classname . " - " . $termname . "</option>		
										");
								}
							} else {
								echo ("<h3 class='text-center text-danger'>No Class Found</h3>");
							}
						} else {
							echo "Error: " . mysqli_error($conn);
						}
						?>
					</select>

					<select class="form-select form-select mb-3" name="subject">
						<option selected>Select the Subject</option>
						<?php
						$subject_checking = mysqli_query($conn, "SELECT * FROM subjects");
						if ($subject_checking) {
							if (mysqli_num_rows($subject_checking) > 0) {
								while ($subject_details_row = mysqli_fetch_assoc($subject_checking)) {
									$subjectid = $subject_details_row['subjectid'];
									$subjectname = $subject_details_row['subject'];
									echo ("
										<option value='$subjectid'>$subjectname</option>		
										");
								}
							} else {
								echo ("<h3 class='text-center text-danger'>No Subject Found</h3>");
							}
						} else {
							echo "Error: " . mysqli_error($conn);
						}
						?>
					</select>

					<div class="form-floating  mb-3">
						<textarea class="form-control" placeholder="Question" id="question" name="question" rows="3" autocomplete="off" required="required"></textarea>
						<label for="question">Question</label>
					</div>
					<div class="mb-3">
						<label for="options" class="mb-1">Options</label>
						<div class="input-group flex-nowrap mb-3">
							<input type="text" class="form-control" id="option1" name="options[]" placeholder="Option 1" autocomplete="off" required="required">
							<input type="text" class="form-control" id="option2" name="options[]" placeholder="Option 2" autocomplete="off" required="required">
						</div>
						<div class="input-group flex-nowrap mb-3">
							<input type="text" class="form-control" id="option3" name="options[]" placeholder="Option 3" autocomplete="off" required="required">
							<input type="text" class="form-control" id="option4" name="options[]" placeholder="Option 4" autocomplete="off" required="required">
						</div>
					</div>
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="canswer" name="canswer" placeholder="Correct Answer" autocomplete="off" required="required">
						<label for="canswer">Correct Answer</label>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="add-question-submit" class="btn btn-primary-clr">Add Question</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editQuestion">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addClassLabel">Edit Question</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<select class="form-select form-select mb-3" id="class" name="class">
						<option selected>Select the Class</option>
						<?php
						$class_checking = mysqli_query($conn, "SELECT * FROM class");
						if ($class_checking) {
							if (mysqli_num_rows($class_checking) > 0) {
								while ($class_details_row = mysqli_fetch_assoc($class_checking)) {
									$classid = $class_details_row['classid'];
									$classname = $class_details_row['classname'];
									$termname = $class_details_row['termid'];
									echo ("
										<option value='$classid'>" . $classname . " - " . $termname . "</option>		
										");
								}
							} else {
								echo ("<h3 class='text-center text-danger'>No Class Found</h3>");
							}
						} else {
							echo "Error: " . mysqli_error($conn);
						}
						?>
					</select>

					<select class="form-select form-select mb-3" id="subject" name="subject">
						<option selected>Select the Subject</option>
						<?php
						$subject_checking = mysqli_query($conn, "SELECT * FROM subjects");
						if ($subject_checking) {
							if (mysqli_num_rows($subject_checking) > 0) {
								while ($subject_details_row = mysqli_fetch_assoc($subject_checking)) {
									$subjectid = $subject_details_row['subjectid'];
									$subjectname = $subject_details_row['subject'];
									echo ("
										<option value='$subjectid'>$subjectname</option>		
										");
								}
							} else {
								echo ("<h3 class='text-center text-danger'>No Subject Found</h3>");
							}
						} else {
							echo "Error: " . mysqli_error($conn);
						}
						?>
					</select>

					<div class="form-floating  mb-3">
						<textarea class="form-control" placeholder="Question" id="question" name="question" rows="3" autocomplete="off" required="required"></textarea>
						<label for="question">Question</label>
					</div>
					<div class="mb-3">
						<label for="options" class="mb-1">Options</label>
						<div class="input-group flex-nowrap mb-3">
							<input type="text" class="form-control" id="option1" name="options[]" placeholder="Option 1" autocomplete="off" required="required">
							<input type="text" class="form-control" id="option2" name="options[]" placeholder="Option 2" autocomplete="off" required="required">
						</div>
						<div class="input-group flex-nowrap mb-3">
							<input type="text" class="form-control" id="option3" name="options[]" placeholder="Option 3" autocomplete="off" required="required">
							<input type="text" class="form-control" id="option4" name="options[]" placeholder="Option 4" autocomplete="off" required="required">
						</div>
					</div>
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="canswer" name="canswer" placeholder="Correct Answer" autocomplete="off" required="required">
						<label for="canswer">Correct Answer</label>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="update-question-submit" class="btn btn-primary-clr">Update Question</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	let editQuestion = document.getElementById('editQuestion')
	editQuestion.addEventListener('show.bs.modal', function(event) {
		let button = event.relatedTarget
		let qid = button.getAttribute('data-bs-qid')
		let cid = button.getAttribute('data-bs-cid')
		let sid = button.getAttribute('data-bs-sid')
		let qtext = button.getAttribute('data-bs-qtext')
		let options = button.getAttribute('data-bs-options')
		options = options.split(",");
		let option1 = options[0]
		let option2 = options[1]
		let option3 = options[2]
		let option4 = options[3]
		let answers = button.getAttribute('data-bs-answers')
		window.history.pushState({}, "", `admin_home.php?questions&e=${qid}`);
		let classIdInput = editQuestion.querySelector('#class')
		let subjectIdInput = editQuestion.querySelector('#subject')
		let questionTextInput = editQuestion.querySelector('#question')
		let option1Input = editQuestion.querySelector('#option1')
		let option2Input = editQuestion.querySelector('#option2')
		let option3Input = editQuestion.querySelector('#option3')
		let option4Input = editQuestion.querySelector('#option4')
		let answersInput = editQuestion.querySelector('#canswer')

		for (let i = 0; i < classIdInput.options.length; i++) {
			if (classIdInput.options[i].value === cid) {
				classIdInput.options[i].selected = true;
				break;
			}
		}
		for (let i = 0; i < subjectIdInput.options.length; i++) {
			if (subjectIdInput.options[i].value === sid) {
				subjectIdInput.options[i].selected = true;
				break;
			}
		}
		questionTextInput.value = qtext
		option1Input.value = option1
		option2Input.value = option2
		option3Input.value = option3
		option4Input.value = option4
		answersInput.value = answers
	})
</script>

<?php
if (isset($_POST['add-question-submit'])) {
	$qid = generateRandomUniqueNumber();
	$classid = $_POST['class'];
	$subjectid = $_POST['subject'];
	$questiontext = $_POST['question'];
	$options = $_POST['options'];
	$options = implode(',', $options);
	$correctanswer = $_POST['canswer'];

	$insert_new_question = mysqli_query($conn, "INSERT INTO questions VALUES('$qid','$classid','$subjectid','$questiontext','$options','$correctanswer', CURRENT_TIMESTAMP(),CURRENT_TIMESTAMP())");
	if ($insert_new_question) {
		alertMessage('Success', 'Question Added Successfully');
		echo ("
			<script>
			setTimeout(() => {
				window.location.href ='./admin_home.php?questions';
			}, 2000);
			</script>
			");
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}

if (isset($_POST['update-question-submit'])) {

	$old_qid = $_GET['e'];
	$new_classid = $_POST['class'];
	$new_subjectid = $_POST['subject'];
	$new_questiontext = $_POST['question'];
	$new_options = $_POST['options'];
	$new_options = implode(',', $new_options);
	$new_correctanswer = $_POST['canswer'];

	$update_question = mysqli_query($conn, "UPDATE questions SET classid='$new_classid',subjectid='$new_subjectid',questiontext='$new_questiontext',options='$new_options',answers='$new_correctanswer',updatedat=CURRENT_TIMESTAMP() WHERE qid='$old_qid'");
	if ($update_question) {
		alertMessage('Success', 'Question Updated Successfully');
		echo ("
                <script>
                setTimeout(() => {
                    window.location.href ='./admin_home.php?questions';
                }, 2000);
                </script>
                ");
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}


if (isset($_GET['questions']) && isset($_GET['d'])) {
	$questionid = $_GET['d'];
	$question_deleting = mysqli_query($conn, "DELETE FROM questions WHERE qid='$questionid'");

	if ($question_deleting) {
		alertMessage('Success', 'Question Deleted Successfully');

		echo ("
        <script>
        setTimeout(() => {
            window.location.href ='./admin_home.php?questions';
        }, 2000);
        </script>
        ");
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}

mysqli_close($conn);

?>