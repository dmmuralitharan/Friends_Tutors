<?php
session_start();
require('../functions/ui_functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Logout | Friends Tutors</title>
    <link rel="icon" type="image/x-icon" href="../src/img/titlelogo.png">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <?php
    echo ('
    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>');
    alertMessage('Success', 'Logout Success');
    unset($_SESSION['adminusername']);
    // session_destroy();
    echo ("
        <script>
            setTimeout(() => {
                window.location.href ='./admin_login.php';
            }, 1000);
        </script>
        ");
    ?>
</body>

</html>