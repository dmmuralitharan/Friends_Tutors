<section class="container mt-5">
    <?php
    $users_details = mysqli_query($conn, "SELECT * FROM users");
    if ($users_details) {
        if (mysqli_num_rows($users_details) > 0) {
    ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Mobile No</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Password</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                </tbody>
        <?php
            $row_count = 1;
            while ($users_details_row = mysqli_fetch_assoc($users_details)) {
                echo ("
							<tr>
								<th scope='row'>$row_count</th>
								<td>" . $users_details_row['userid'] . "</td>
								<td>" . $users_details_row['username'] . "</td>
								<td>" . $users_details_row['email'] . "</td>
								<td>" . $users_details_row['mobileno'] . "</td>
								<td>" . $users_details_row['gender'] . "</td>
								<td>" .  shortenText($users_details_row['password']) . "</td>
								<td class='actions'>
									<a href='admin_home.php?users' class='btn p-0 me-4' data-bs-toggle='modal' data-bs-userid='" . $users_details_row['userid'] . "' data-bs-username='" . $users_details_row['username'] . "' data-bs-email='" . $users_details_row['email'] . "' data-bs-mobileno='" . $users_details_row['mobileno'] . "' data-bs-gender='" . $users_details_row['gender'] . "' data-bs-password='" . $users_details_row['password'] . "' data-bs-target='#editUsers'>
										<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
										<path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
										<path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
										</svg>
									</a>
									<a href='admin_home.php?users&d=" . $users_details_row['userid'] . "' class='btn p-0' > 
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
            echo ("<h3 class='text-center text-danger'>No Users Available</h3>");
        }
    } else {
        echo ("ERROR" . mysqli_error($conn));
    }
        ?>
        </tbody>
            </table>
</section>

<div class="modal fade" id="editUsers">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="User Name">
                        <label for="username">User Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="email" name="email" placeholder="E-mail">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="Mobile No">
                        <label for="mobileno">Mobile No</label>
                    </div>
                    <div class="mb-3">
                        <label for="gender">Gender : </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="male" name="gender" value="Male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="female" name="gender" value="Female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="others" name="gender" value="Others">
                            <label class="form-check-label" for="others">Others</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update-user-submit" class="btn btn-primary-clr">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let editUsers = document.getElementById('editUsers')
    editUsers.addEventListener('show.bs.modal', function(event) {
        let button = event.relatedTarget
        let userId = button.getAttribute('data-bs-userid')
        window.history.pushState({}, "", `admin_home.php?users&e=${userId}`);
        let userName = button.getAttribute('data-bs-username')
        let email = button.getAttribute('data-bs-email')
        let mobileno = button.getAttribute('data-bs-mobileno')
        let gender = button.getAttribute('data-bs-gender')
        let password = button.getAttribute('data-bs-password')
        editUsers.querySelector('#username').value = userName
        editUsers.querySelector('#email').value = email
        editUsers.querySelector('#mobileno').value = mobileno
        if (gender === "Male") {
            editUsers.querySelector('#male').checked = true
        } else if (gender === "Female") {
            editUsers.querySelector('#female').checked = true
        } else if (gender === "Other") {
            editUsers.querySelector('#other').checked = true
        }
    })
</script>



<?php
if (isset($_POST['update-user-submit'])) {

    $old_userid = $_GET['e'];
    $new_userid = $_POST['userid'];
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_mobileno = $_POST['mobileno'];
    $new_gender = $_POST['gender'];
    $new_password = $_POST['password'];
    $user_checking = mysqli_query($conn, "SELECT * FROM users WHERE userid='$new_userid'");
    if ($user_checking) {
        if (mysqli_num_rows($user_checking) > 0) {
            alertMessage('Error', 'user ID is already taken');
        } else {
            $update_user = mysqli_query($conn, "UPDATE users SET username='$new_username',email='$new_email',mobileno='$new_mobileno',gender='$new_gender' WHERE userid='$old_userid'");
            if ($update_user) {
                alertMessage('Success', 'User Updated Successfully');
                echo ("
                <script>
                setTimeout(() => {
                    window.location.href ='./admin_home.php?users';
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

if (isset($_GET['users']) && isset($_GET['d'])) {
    $userid = $_GET['d'];
    $user_deleting = mysqli_query($conn, "DELETE FROM users WHERE userid='$userid'");

    if ($user_deleting) {
        alertMessage('Success', 'User Deleted Successfully');

        echo ("
        <script>
        setTimeout(() => {
            window.location.href ='./admin_home.php?users';
        }, 2000);
        </script>
        ");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);



?>