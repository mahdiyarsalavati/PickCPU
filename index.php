<?php
session_start();

$questions = [
    1 => "How much do you want to spend on a CPU? (Just give a number in US dollars)",
    2 => "Do you like making and editing videos, like for YouTube or your own projects?",
    3 => "Do you often switch between many apps and tasks at the same time?",
    4 => "Are you into creating things online, like blogging, graphic design, or other creative stuff?",
    5 => "Do you like playing new video games that are really engaging?",
    6 => "Are you going to use your device for different kinds of tasks?",
    7 => "Do you want to carry your device and use it on the go?",
    8 => "Will you be programming or writing code on your device?",
    9 => "Do you prefer using a different operating system than macOS?",
    10 => "Do you want to use a device that you can use for more than 5 years?"
];




$totalQuestions = count($questions);

$currentQuestion = 1;
if (isset($_GET['q'])) {
    $currentQuestion = (int) $_GET['q'];
}

$progress = ($currentQuestion - 1) / $totalQuestions * 100;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['answer']) && isset($_POST['question'])) {
        if ($_POST['question'] == 1) { // Budget question
            $_SESSION['userBudget'] = $_POST['answer'];
        } else {
            $_SESSION['answers'][$_POST['question']] = ($_POST['answer'] === 'yes') ? 1 : 0;
        }

        $nextQuestion = $currentQuestion + 1;
        if (array_key_exists($nextQuestion, $questions)) {
            header("Location: index.php?q={$nextQuestion}");
            exit;
        } else {
            header("Location: final.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pick CPU</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="fav.ico">
</head>

<body>
    <header>
        <a href="index.php">
            <img src="logo.png" alt="Pick CPU Logo" style="height: 75px; width: auto;">
        </a>
    </header>


    <div class="progress-bar">
        <div class="progress" style="width: <?php echo $progress; ?>%;"></div>
    </div>


    <div class="questionnaire">
        <h1>Question
            <?php echo $currentQuestion; ?> of
            <?php echo $totalQuestions; ?>
        </h1>
        <div class="question">
            <?php echo $questions[$currentQuestion]; ?>
        </div>
        <div class="button-container">
            <?php if ($currentQuestion == 1): ?>
                <div class="form-container">
                    <form method="POST" class="budget-form">
                        <input type="number" name="answer" placeholder="Enter your budget" class="input-field">
                        <input type="hidden" name="question"
                            value="<?php echo htmlspecialchars(isset($currentQuestion) ? $currentQuestion : ''); ?>">
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>
            <?php else: ?>
                <form method="POST">
                    <button type="submit" name="answer" value="no" class="no">No</button>
                    <input type="hidden" name="question" value="<?php echo $currentQuestion; ?>">
                </form>
                <form method="POST">
                    <button type="submit" name="answer" value="yes" class="yes">Yes</button>
                    <input type="hidden" name="question" value="<?php echo $currentQuestion; ?>">
                </form>
            <?php endif; ?>
        </div>
    </div>



    <footer>
        <p>©
            <?php echo date("Y"); ?> Pick CPU. By Mahdiyar Salavati & Sahand Masoudi. All rights reserved.
        </p>
    </footer>


</body>

</html>