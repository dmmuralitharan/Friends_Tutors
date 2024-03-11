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
    <div class="container">
            <div class="row">
                <section class="col captions  d-flex justify-content-center align-items-center flex-column gap-2 ms-5">
                    <h1>Gateway to Success Through Engaging, Insightful Quizzes! Empower your intellect at 
                    <span class="fw-bold">Friends Tutors.</span>
                    </h1>
                    <a href="./user_quiz_select.php?quiz" class="btn w-50 mt-4">Quiz</a>
                </section>
                <section class="col banner w-100 d-flex justify-content-center">
                    <img  class="w-50" src="../src/img/quiz.svg" alt="Home Banner">
                </section>
            </div>
        </div>
    </main>

    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>
</html>