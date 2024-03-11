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
        <?php
        if (isset($_GET["quiz"])) {
        ?>
            <h3 class="text-center fw-bold">Select Your Class</h3>
            <div class='container pt-4 px-4 mb-5'>
                <hr>
                <div class='row g-4' id="animatedRow">
                    <?php
                    $class_details = mysqli_query($conn, "SELECT * FROM class");
                    if ($class_details) {
                        while ($class_details_row = mysqli_fetch_assoc($class_details)) {
                            echo ("                           
                            <a href='user_quiz_select.php?class=" . $class_details_row['classid'] . "' class='hover-translateY-elements col-sm-6 col-xl-4'>
                                <div class='primary-card rounded d-flex align-items-center justify-content-between p-4'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' fill='currentColor' class='m-3 bi bi-people' viewBox='0 0 16 16'>
                                <path d='M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4'/>
                              </svg>
                                    <div class='ms-3'>
                                        <p class='mb-2 text-center'> CLASS </p>
                                        <h6 class='mb-0 fw-bold'>" . $class_details_row['classname'] . "th ( " . $class_details_row['termid']  . " )</h6>
                                    
                                    </div>
                                </div>
                            </a>
                        ");
                        }
                    }

                    ?>
                    <hr>
                </div>
            <?php
        } ?>
        </div>
    </main>
    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>

<?php
if (isset($_GET["class"])) {
    $classid = $_GET['class'];

    echo ("
    <h3 class='text-center fw-bold'>Select Your Subject</h3>

    <div class='container pt-4 px-4 mb-5'><hr>
        <div class='row g-4' id='animatedRow'>
        ");
    $subject_details = mysqli_query($conn, "SELECT * FROM subjects");
    if ($subject_details) {
        while ($subject_details_row = mysqli_fetch_assoc($subject_details)) {
            echo ("                           
                    <a href='user_quiz.php?class=$classid&subject=" . $subject_details_row['subjectid'] . "' class='hover-translateY-elements col-sm-6 col-xl-4'>
                        <div class='primary-card rounded d-flex align-items-center justify-content-between p-4'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='50' height='50' fill='currentColor' class='m-3 bi bi-clipboard2-data' viewBox='0 0 16 16'>
                                <path d='M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z' />
                                <path d='M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z' />
                                <path d='M10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm4-3a1 1 0 0 0-1 1v3a1 1 0 1 0 2 0V9a1 1 0 0 0-1-1' />
                            </svg>
                            <div class='ms-3'>
                                <p class='mb-2 text-center'> Subject </p>
                                <h6 class='mb-0 fw-bold'>" . $subject_details_row['subject'] . "</h6>
                            </div>
                        </div>
                    </a>
                ");
        }
    }
    echo ("
            </div>
        <hr>
    </div>");
}
?>

