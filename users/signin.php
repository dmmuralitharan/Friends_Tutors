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
    <title>Signin | Friends Tutors</title>
    <link rel="icon" type="image/x-icon" href="../src/img/titlelogo.png">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <?php
    require('./user_header.php')
    ?>

    <main>
        <div class="signin-container">
            <form action="" method="post">
                <h2>Create New Account</h2>

                <div class="mb-3">
                    <label for="username" class="form-label">Username : </label>
                    <input type="text" class="form-control" name="username" autocomplete="off" required="required">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" autocomplete="off" required="required">
                </div>
                <div class="mb-3">
                    <label for="mobileno" class="form-label">Mobile No : </label>
                    <input type="number" class="form-control" name="mobileno" autocomplete="off" required="required">
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
                <div class="mb-3">
                    <label for="password" class="form-label">Password : </label>
                    <input type="password" class="form-control" name="password" autocomplete="off" required="required">
                </div>
                <button type="submit" name="signin-submit" class="btn w-100 mb-2">Submit</button>
                <a href="./login.php" class="d-block text-center">If You already have a account</a>
            </form>
        </div>
    </main>

    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>
<?php
if (isset($_POST['signin-submit'])) {
    $userid = generateRandomUniqueNumber();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $username_checking = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if ($username_checking) {
        if (mysqli_num_rows($username_checking) > 0) {
            alertMessage('Error', 'Username is already taken');
        } else {
            $insert_new_user = mysqli_query($conn, "INSERT INTO users VALUES('$userid', '$username', '$email', $mobileno, '$gender', '$hashed_password')");
            if ($insert_new_user) {
                alertMessage('Success', 'Account Created Successfully');
                
                echo ("
                <script>
                setTimeout(() => {
                    window.location.href ='./login.php';
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

mysqli_close($conn);
?>

