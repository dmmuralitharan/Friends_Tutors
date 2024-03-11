<?php
session_start();
if (isset($_SESSION['username'])) {
    echo ("
        <script>
                window.location.href ='./users/user_home.php';
        </script>
        ");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends Tutors</title>
    <link rel="icon" type="image/x-icon" href="./src/img/titlelogo.png">
    <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/style.css">
</head>

<body>
    <?php
    require('./includes/header.php');
    ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col captions d-flex justify-content-center align-items-center">
                    <h1>Gateway to Success Through Engaging, Insightful Quizzes! Empower your intellect at
                        <span class="fw-bold">Friends Tutors.</span>
                    </h1>
                </div>
                <div class="col banner w-100 d-flex justify-content-center">
                    <img class="w-50" src="./src/img/quiz.svg" alt="Home Banner">
                </div>
            </div>
        </div>

    </main>
    <?php
    require('./includes/footer.php')
        ?>
    <script src="./src/bootstrap/js/bootstrap.min.js"></script>
    <script src="./src/js/script.js"></script>
</body>

</html>