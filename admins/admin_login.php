<?php
session_start();
if (isset($_SESSION['adminusername'])) {
    echo ("
    <script>
            window.location.href ='./admin_home.php';
    </script>
    ");
}

require('../includes/connection.php');
require('../functions/ui_functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Friends Tutors</title>
    <link rel="icon" type="image/x-icon" href="../src/img/titlelogo.png">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <main>
        <div class="login-container">
            <form action="" method="post">
                <h2>Admin Login</h2>
                <div class="mb-3">
                    <label for="username" class="form-label">Username : </label>
                    <input type="text" class="form-control" name="username" id="username" autocomplete="off" required="required">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" class="form-control" name="password" id="password" autocomplete="off" required="required">
                </div>
                <button type="submit" name="login-submit" class="btn w-100 mb-2" data-bs-target="#exampleModal">Submit</button>
            </form>
        </div>
    </main>

    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>

<?php
if (isset($_POST['login-submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin_login = mysqli_query($conn, "SELECT * FROM admins WHERE username='$username' AND password='$password'");

    if ($admin_login) {
        if (mysqli_num_rows($admin_login) > 0) {
            $_SESSION['adminusername'] = $username;
            alertMessage('Success', 'Login success');
            echo ("
            <script>
            setTimeout(() => {
                window.location.href ='./admin_home.php';
            }, 2000);
            </script>
            ");
        } else {
            alertMessage('Error', 'User Not Found');
            echo ("
            <script>
            setTimeout(() => {
                window.location.href ='./admin_login.php';
            }, 2000);
            </script>
            ");
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>