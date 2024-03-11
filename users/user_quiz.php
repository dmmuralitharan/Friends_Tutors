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
        $questions = array();
        $question_number = 1;
        $class_id = $_GET['class'];
        $subject_id = $_GET['subject'];
        $question_details = mysqli_query($conn, "SELECT * FROM questions WHERE classid='$class_id' AND subjectid='$subject_id' ORDER BY RAND()");
        if ($question_details) {
            if (mysqli_num_rows($question_details) > 0) {
                echo ("<form action='' method='post' class='mb-5 mx-3'>");
                while ($question_row = mysqli_fetch_assoc($question_details)) {
                    $question_id = $question_row["qid"];
                    $correct_answer = $question_row["answers"];
                    $question_text = $question_row["questiontext"];
                    $options = $question_row["options"];
                    $question_properties = array("question_id" => $question_id, "question_text" => $question_text, "options" => $options, "correct_answer"=> $correct_answer);
                    array_push($questions, $question_properties);
                    $options = explode(",", $options);
                    shuffle($options);
                    $option1 = $options[0];
                    $option2 = $options[1];
                    $option3 = $options[2];
                    $option4 = $options[3];
                    echo ("
                        <div class='question-wrapper'>
                            <div class='question-section'>
                                <span>$question_number ) <span> 
                                <span>$question_text</span>
                            </div>
                            <div class='options-section'>
                                <input type='hidden' name='question_id$question_number' value='$question_id'>
                                <div class='option'>
                                <input type='radio' class='question-option' id='q$question_number-opt1' name='q$question_number' value='$option1'>
                                <label for='q$question_number-opt1'>$option1</label>
                                </div>
                                <div class='option'>
                                <input type='radio' class='question-option' id='q$question_number-opt2' name='q$question_number' value='$option2'>
                                <label for='q$question_number-opt2'>$option2</label>
                                </div>
                                <div class='option'>
                                <input type='radio' class='question-option' id='q$question_number-opt3' name='q$question_number' value='$option3'>
                                <label for='q$question_number-opt3'>$option3</label>
                                </div>
                                <div class='option'>
                                <input type='radio' class='question-option' id='q$question_number-opt4' name='q$question_number' value='$option4'>
                                <label for='q$question_number-opt4'>$option4</label>
                                </div>
                            </div>
                        </div>
                        ");
                    $question_number++;
                }
                echo ("
                    <div class='option d-flex justify-content-end mx-5'>
                    <input type='submit' name='quiz-check' class='btn fw-bold btn-primary-clr  px-5'>
                    </div>
                    </form>
                    ");
            } else {
                echo ("<h3 class='text-center text-danger'>No Questions Available</h3>");
            }
        } else {
            echo ("ERROR" . mysqli_error($conn));
        }
        ?>
    </main>
    <script src="../src/bootstrap/js/bootstrap.min.js"></script>
    <script src="../src/js/script.js"></script>
</body>

</html>

<?php
if (isset($_POST['quiz-check'])) {
    $points = 0;
    $answers = array();
    for ($i = 1; $i <= count($questions); $i++) {
        $qid = "question_id$i";
        $question_id = $_POST[$qid];
        $qtemp = "q$i";
        $selected_answer = $_POST[$qtemp];

        array_push($answers, array('qid' => $question_id, 'answer' => $selected_answer));
    } 

    foreach ($questions as $question) {
        foreach ($answers as $answer) {
            if ($question['question_id'] === $answer['qid'] && $question['correct_answer'] === $answer['answer']) {
                $points++;
            }
        }
    }

    $quiz_id = generateRandomUniqueNumber();
    $username= $_SESSION['username'];

    $result_insert = mysqli_query($conn,"INSERT into results VALUES('$quiz_id','$class_id','$subject_id','$username','$points', CURRENT_TIMESTAMP())");
    if ($result_insert) {
        resultMessage($points, count($questions));
        echo ("
			<script>
			setTimeout(() => {
				window.location.href ='./user_home.php';
			}, 3000);
			</script>
			");
	} else {
		echo "Error: " . mysqli_error($conn);
	}
}

?>