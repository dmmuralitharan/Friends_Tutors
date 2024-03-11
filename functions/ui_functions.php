<?php

function alertMessage($status, $message)
{
    if ($status === 'Success') {
        $imgPath = '../src/icons/verified.png';
    } elseif ($status === 'Error') {
        $imgPath = '../src/icons/wrong.png';
    }

    echo ("
        <div id='overlay'></div>
        <div id='alert-message-modal'>
            <div id='alert-header'>
                <div id='alert-header-title'>" . $status . "</div>
                <button id='close-modal' class='close-modal'>&times;</button>
            </div>
            <div id='alert-body'>
                <img src='$imgPath' alt='Status Image'>
                <p>" . $message . "</p>
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                alertModal();
                clearFormData();
            });
            </script>
        </div>
        ");
}

function resultMessage($points, $question_count)
{
    if ($points >= 15) {
        $imagePath = '../src/icons/happy0.png';
        $imagePath2 = '../src/icons/happy.png';
    } elseif ($points < 15 && $points > 5) {
        $imagePath = '../src/icons/appreciate0.png';
        $imagePath2 = '../src/icons/appreciate.png';
    } elseif ($points <= 5) {
        $imagePath = '../src/icons/sad0.png';
        $imagePath2 = '../src/icons/sad.png';
    }

    echo ("
    <div id='overlay'></div>
    <div id='alert-message-modal' style='width:500px;'>
        <div id='alert-header'>
            <div id='alert-header-title'>Result</div>
            <button id='close-modal' class='close-modal'>&times;</button>
        </div>
        <div id='alert-body'>
            <img src='$imagePath' alt='Status Image'>
            <h1> $points / $question_count </h1>
            <img src='$imagePath2' alt='Status Image'>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            alertModal();
            clearFormData();
        });
        </script>
    </div>
    ");
}

function generateRandomUniqueNumber()
{
    $length = 8;
    $characters = '0123456789';

    $randomNumber = '';
    for ($i = 0; $i < $length; $i++) {
        $randomNumber .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomNumber;
}

function shortenText($text)
{
    $max_length = 10;
    if (strlen($text) > $max_length) {
        $shortenedText = substr($text, 0, $max_length) . "...";
    } else {
        $shortenedText = $text;
    }
    return $shortenedText;
}
