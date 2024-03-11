<?php
session_start();
require('../includes/connection.php');
require('../functions/ui_functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Friends Tutors</title>
    <link rel="icon" type="image/x-icon" href="../src/img/titlelogo.png">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <?php
    require('./user_header.php');
    ?>

    <main>
        <section class="container d-flex flex-column align-items-center mt-5">

            <table class="table w-50 text-center">
                <?php
                $username = $_SESSION['username'];
                $user_details = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
                if ($user_details) {
                    $user_details_row = mysqli_fetch_assoc($user_details);
                    $userid =  $user_details_row['userid'];
                    echo ("
                <thead>
                    <div class='d-flex mb-3 ms-auto'>
                        <a href='user_profile.php?e=' class='btn btn-primary-clr  ms-auto' data-bs-toggle='modal' data-bs-userid='" . $userid . "' data-bs-userusername='" . $user_details_row['username'] . "' data-bs-useremail='" . $user_details_row['email'] . "'  data-bs-mobileno='" . $user_details_row['mobileno'] .  "' data-bs-gender='" . $user_details_row['gender'] .  "' data-bs-userpassword='" . $user_details_row['password'] . "' data-bs-target='#editUser'>
                            Edit
                        </a>
                    </div>
                </thead>
                <tbody>
                    <tr>
                    <th>Username</th>
                    <td>" . $user_details_row['username'] . "</td>
                    </tr>
                    <tr>
                    <th>E-mail</th>
                    <td>" . $user_details_row['email'] . "</td>
                    </tr>
                    <tr>
                    <th>Mobile No</th>
                    <td>" . $user_details_row['mobileno'] . "</td>
                    </tr>
                    <tr>
                    <th>Gender</th>
                    <td>" . $user_details_row['gender'] . "</td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>" . shortenText($user_details_row['password']) . "</td>
                    </tr>
                ");
                } else {
                    echo ("ERROR" . mysqli_error($conn));
                }
                ?>
                </tbody>
            </table>
        </section>

        <div class="modal fade" id="editUser">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClassLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                <label for="username">User Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="email" name="email" placeholder="User E-mail">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="mobileno" name="mobileno" placeholder="User Mobile No">
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
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="User Password">
                                <label for="password">Password</label>
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
    </main>

    <script>
        let editUser = document.getElementById('editUser')
        editUser.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget
            let userId = button.getAttribute('data-bs-userid')
            window.history.pushState({}, "", `user_profile.php?profile&e=${userId}`);
            let userUsername = button.getAttribute('data-bs-userusername')
            let userEmail = button.getAttribute('data-bs-useremail')
            let mobileNo = button.getAttribute('data-bs-mobileno')
            let gender = button.getAttribute('data-bs-gender')
            let userPassword = button.getAttribute('data-bs-userpassword')

            console.log();
            let userUsernameInput = editUser.querySelector('#username')
            let userEmailInput = editUser.querySelector('#email')
            let userMobileNoInput = editUser.querySelector('#mobileno')
            let userPasswordInput = editUser.querySelector('#password')

            userUsernameInput.value = userUsername
            userEmailInput.value = userEmail
            userMobileNoInput.value = mobileNo
            if (gender === "Male") {
                editUser.querySelector('#male').checked = true
            } else if (gender === "Female") {
                editUser.querySelector('#female').checked = true
            } else if (gender === "Other") {
                editUser.querySelector('#other').checked = true
            }
            userPasswordInput.value = userPassword
        })
    </script>
    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>


<?php
if (isset($_POST['update-user-submit'])) {

    $old_userid = $_GET['e'];
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_mobile_no = $_POST['mobileno'];
    $new_gender = $_POST['gender'];
    $new_password = $_POST['password'];
    $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $update_user = mysqli_query($conn, "UPDATE users SET username='$new_username',email='$new_email',mobileno='$new_mobile_no',gender='$new_gender',password='$new_hashed_password' WHERE userid='$old_userid'");
    if ($update_user) {
        $_SESSION["username"] = $new_username;
        alertMessage('Success', 'User Updated Successfully');
        echo ("
        <script>
        setTimeout(() => {
            window.location.href ='./user_profile.php';
        }, 2000);
        </script>
        ");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>