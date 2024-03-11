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
    <title>Login | Friends Tutors</title>
    <link rel="icon" type="image/x-icon" href="../src/img/titlelogo.png">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <?php
    require('./user_header.php')
    ?>

    <main>
        <div class="login-container">
            <form action="" method="post">
                <h2>Login</h2>
                <div class="mb-3">
                    <label for="username" class="form-label">Username : </label>
                    <input type="text" class="form-control" name="username" id="username" autocomplete="off" required="required">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" class="form-control" name="password" id="password" autocomplete="off" required="required">
                </div>
                <button type="submit" name="login-submit" class="btn w-100 mb-2">Submit</button>
                <a href="./signin.php" class="d-block text-center">Create New Account</a>
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

    $user_login = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if ($user_login) {
        if (mysqli_num_rows($user_login) > 0) {
            $row = mysqli_fetch_assoc($user_login);
            $hashedPasswordFromDatabase = $row['password'];
            if (password_verify($password,$hashedPasswordFromDatabase)) {
                $_SESSION['username'] = $username;
                alertMessage('Success', 'Login success');
                echo ("
                    <script>
                    setTimeout(() => {
                        window.location.href ='./user_home.php';
                    }, 2000);
                    </script>
                    ");
            } else {
                alertMessage('Error', 'Incorrect Password');
                echo ("
                    <script>
                    setTimeout(() => {
                        window.location.href ='./login.php';
                    }, 2000);
                    </script>
                    ");
            }
        }  else {
            alertMessage('Error', 'User Not Found');
            echo ("
                <script>
                document.queryselectorAll('input:not([type=submit])').forEach((ele)=>{
                    ele.value=''
                })
                setTimeout(() => {
                    window.location.href ='./login.php';
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