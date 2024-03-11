<?php
session_start();
if (!isset($_SESSION["adminusername"])) {
    echo ("
    <script>
            window.location.href ='./admin_login.php';
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
    <title>Admin Home | Friends Tutors</title>
    <link rel="icon" type="image/x-icon" href="../src/img/titlelogo.png">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <?php
    require('./admin_header.php');
    ?>

    <main>
        <div class="admin-container">
            <section class="admin-main">
                <?php

                if (!isset($_GET['subject']) && !isset($_GET['class']) && !isset($_GET['questions']) && !isset($_GET['results']) && !isset($_GET['users']) && !isset($_GET['profile'])) {
                ?>
                    <div class="container pt-4 px-4">
                        <div class="row g-4" id="animatedRow">
                            <a href="admin_home.php?subject" class="hover-translateY-elements col-sm-6 col-xl-4">
                                <div class="primary-card rounded d-flex align-items-center justify-content-between p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="60" fill="currentColor" class="bi bi-clipboard-data-fill" viewBox="0 0 16 16">
                                        <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z" />
                                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zM10 8a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1" />
                                    </svg>
                                    <div class="ms-3">
                                        <p class="mb-2">Subjects</p>
                                        <?php
                                        $subject_count = mysqli_query($conn, "SELECT COUNT(*) AS sub_count FROM subjects");
                                        if ($subject_count) {
                                            while ($subject_row = mysqli_fetch_assoc($subject_count)) {
                                                echo ("
                                                <h6 class='mb-0'>" . $subject_row['sub_count'] . "</h6>
                                                ");
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </a>
                            <a href="admin_home.php?class" class="hover-translateY-elements col-sm-6 col-xl-4">
                                <div class="primary-card rounded d-flex align-items-center justify-content-between p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="60" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                    </svg>
                                    <div class="ms-3">
                                        <p class="mb-2">Class</p>
                                        <?php
                                        $class_count = mysqli_query($conn, "SELECT COUNT(*) AS class_count FROM class");
                                        if ($class_count) {
                                            while ($class_row = mysqli_fetch_assoc($class_count)) {
                                                echo ("
                                                <h6 class='mb-0'>" . $class_row['class_count'] . "</h6>
                                                ");
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </a>
                            <a href="admin_home.php?questions" class="hover-translateY-elements col-sm-6 col-xl-4">
                                <div class="primary-card rounded d-flex align-items-center justify-content-between p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-question-diamond-fill" viewBox="0 0 16 16">
                                        <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098zM5.495 6.033a.237.237 0 0 1-.24-.247C5.35 4.091 6.737 3.5 8.005 3.5c1.396 0 2.672.73 2.672 2.24 0 1.08-.635 1.594-1.244 2.057-.737.559-1.01.768-1.01 1.486v.105a.25.25 0 0 1-.25.25h-.81a.25.25 0 0 1-.25-.246l-.004-.217c-.038-.927.495-1.498 1.168-1.987.59-.444.965-.736.965-1.371 0-.825-.628-1.168-1.314-1.168-.803 0-1.253.478-1.342 1.134-.018.137-.128.25-.266.25zm2.325 6.443c-.584 0-1.009-.394-1.009-.927 0-.552.425-.94 1.01-.94.609 0 1.028.388 1.028.94 0 .533-.42.927-1.029.927" />
                                    </svg>
                                    <div class="ms-3">
                                        <p class="mb-2">Questions</p>
                                        <?php
                                        $question_count = mysqli_query($conn, "SELECT COUNT(*) AS question_count FROM questions");
                                        if ($question_count) {
                                            while ($question_row = mysqli_fetch_assoc($question_count)) {
                                                echo ("
                                        <h6 question='mb-0'>" . $question_row['question_count'] . "</h6>
                                        ");
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </a>
                            <a href="admin_home.php?results" class="hover-translateY-elements col-sm-6 col-xl-4">
                                <div class="primary-card rounded d-flex align-items-center justify-content-between p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16">
                                        <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864z" />
                                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z" />
                                    </svg>
                                    <div class="ms-3">
                                        <p class="mb-2">Results</p>
                                        <?php
                                        $result_count = mysqli_query($conn, "SELECT COUNT(*) AS result_count FROM results");
                                        if ($result_count) {
                                            while ($result_row = mysqli_fetch_assoc($result_count)) {
                                                echo ("
                                        <h6 result='mb-0'>" . $result_row['result_count'] . "</h6>
                                        ");
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </a>
                            <a href="admin_home.php?users" class="hover-translateY-elements col-sm-6 col-xl-4">
                                <div class="primary-card rounded d-flex align-items-center justify-content-between p-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z" />
                                    </svg>
                                    <div class="ms-3">
                                        <p class="mb-2">Users</p>
                                        <?php
                                        $user_count = mysqli_query($conn, "SELECT COUNT(*) AS user_count FROM users");
                                        if ($user_count) {
                                            while ($user_row = mysqli_fetch_assoc($user_count)) {
                                                echo ("
                                                <h6 user='mb-0'>" . $user_row['user_count'] . "</h6>
                                                ");
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                }

                if (isset($_GET['subject'])) {
                    include('./admin_subject.php');
                }

                if (isset($_GET['class'])) {
                    include('./admin_class.php');
                }

                if (isset($_GET['questions'])) {
                    include('./admin_questions.php');
                }

                if (isset($_GET['results'])) {
                    include('./admin_results.php');
                }

                if (isset($_GET['users'])) {
                    include('./admin_users.php');
                }

                if (isset($_GET['profile'])) {
                    include('./admin_profile.php');
                }
                ?>
            </section>
        </div>
    </main>

    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>