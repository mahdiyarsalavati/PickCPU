<?php
session_start();

if (!isset($_SESSION['answers']) || !isset($_SESSION['userBudget'])) {
    header("Location: index.php");
    exit;
}

$answers = $_SESSION['answers'];
$userBudget = $_SESSION['userBudget'];
unset($_SESSION['answers']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result - Pick CPU</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <a href="index.php">
            <img src="logo.png" alt="Pick CPU Logo" style="height: 75px; width: auto;">
        </a>
    </header>



    <div class="questionnaire">
        <h1>Pick CPU Result</h1>

        <?php

        $cpuModels = [
            "Intel Xeon W-11855M" => [450, 1, 1, 1, 1, 1, 0, 0, 1, 1],
            "Intel Core i5-11500" => [208.5, 0, 0, 1, 0, 0, 1, 0, 1, 1],
            "Intel Core i7-11390H" => [426, 1, 0, 0, 0, 0, 0, 1, 0, 0],
            "Intel Core i7-11700F" => [225.99, 0, 1, 0, 0, 1, 0, 1, 0, 0],
            "AMD Ryzen 5 5600X" => [156.41, 0, 0, 1, 0, 1, 0, 0, 0, 1],
            "AMD Ryzen 7 5800X3D" => [289.55, 1, 1, 1, 0, 0, 0, 0, 1, 1],
            "Intel Core i9-11900T" => [439.00, 1, 0, 0, 0, 0, 1, 0, 1, 0],
            "AMD Ryzen Threadripper PRO 5965WX" => [1999.99, 1, 1, 1, 1, 1, 0, 0, 0, 1],
            "AMD Ryzen 5 5600X3D" => [190.00, 1, 0, 1, 0, 1, 0, 0, 0, 1],
            "AMD Ryzen 9 5900" => [299.99, 1, 1, 1, 0, 1, 0, 0, 0, 1],
            "AMD Ryzen 7 5800" => [289.55, 1, 1, 0, 0, 1, 1, 0, 0, 0],
            "Intel Pentium Gold G7400" => [89.99, 0, 0, 0, 0, 0, 1, 0, 1, 1],
            "Intel Core i5-12400T" => [149.99, 0, 0, 1, 0, 0, 1, 0, 1, 1],
            "Intel Xeon w9-3475X" => [3739.00, 1, 1, 1, 1, 1, 0, 0, 1, 1],
            "AMD Ryzen Threadripper PRO 5975WX" => [2699.99, 1, 1, 1, 1, 1, 0, 0, 1, 1],
            "Intel Core i3-13100T" => [128.67, 0, 0, 0, 0, 0, 1, 0, 1, 1],
            "AMD Ryzen 5 5600" => [161.00, 0, 0, 1, 0, 1, 0, 0, 0, 1],
            "AMD Ryzen Threadripper PRO 5945WX" => [1899.99, 1, 1, 1, 1, 1, 0, 0, 0, 1],
            "AMD Ryzen Threadripper PRO 5995WX" => [5699.99, 1, 1, 1, 1, 1, 0, 0, 0, 1],
            "AMD Ryzen 7 5700G" => [169.99, 1, 1, 0, 0, 1, 0, 0, 1, 0],
            "AMD Ryzen 9 6900HX" => [2548.99, 1, 1, 0, 0, 1, 0, 0, 0, 1],
            "AMD Ryzen 7 7735HS" => [500.00, 1, 1, 0, 0, 1, 0, 0, 0, 1],
            "Intel Core i7-11850H" => [395.00, 1, 0, 1, 0, 1, 1, 0, 1, 0],
            "Intel Core i5-11400F" => [119.99, 0, 0, 0, 0, 0, 0, 0, 1, 0],
            "AMD Ryzen 7 PRO 5750G" => [360, 1, 1, 0, 0, 1, 1, 0, 0, 0],
            "Intel Xeon E-2378" => [362, 1, 1, 0, 0, 0, 0, 0, 1, 1],
            "Intel Core i3-12100T" => [139.99, 0, 0, 0, 0, 0, 1, 0, 1, 1],
            "AMD Ryzen 7 PRO 5750GE" => [198.98, 1, 1, 0, 0, 1, 1, 0, 0, 0],
            "Intel Core i5-11400" => [139.99, 0, 0, 0, 0, 0, 0, 0, 1, 0],
            "Intel Xeon w5-2445" => [500.00, 1, 1, 0, 0, 1, 0, 1, 1, 0],
            "Intel Core i9-12900TE" => [455, 1, 1, 1, 0, 1, 1, 0, 1, 1],
            "AMD Ryzen 9 5980HX" => [1800, 1, 1, 1, 0, 1, 0, 0, 0, 1],
            "AMD Ryzen 5 5600G" => [181.11, 0, 0, 1, 0, 1, 0, 0, 0, 1],
            "Intel Core i7-1265U" => [400, 0, 0, 0, 0, 1, 1, 0, 1, 1],
            "AMD EPYC 9554" => [1999.99, 1, 1, 0, 0, 1, 0, 1, 0, 1],
            "Intel Core i7-11800H" => [350.00, 1, 1, 0, 0, 1, 0, 0, 1, 0],
            "Intel Core i5-11500H" => [218.99, 1, 1, 0, 0, 1, 0, 0, 1, 0],
            "AMD Ryzen 5 PRO 5650G" => [210.00, 1, 1, 0, 0, 1, 0, 1, 1, 0],
            "AMD Ryzen 7 6800H" => [1299.99, 1, 1, 0, 0, 1, 0, 0, 0, 1],
            "AMD Ryzen 7 PRO 6850HS" => [1200, 1, 1, 0, 0, 1, 0, 1, 0, 1],
            "Intel Core i5-1235U" => [309.00, 0, 0, 0, 0, 1, 1, 0, 1, 1],
            "AMD Ryzen 5 5500" => [100.00, 0, 0, 1, 0, 1, 0, 0, 1, 1],
            "AMD Ryzen 9 6900HS" => [1999.98, 1, 0, 0, 0, 1, 0, 0, 1, 1],
            "Intel Core i7-11600H" => [399, 0, 1, 1, 0, 0, 1, 0, 1, 0],
            "Intel Core i7-1195G7" => [426.00, 1, 0, 0, 0, 0, 1, 0, 1, 0],
            "Intel Core i7-11375H" => [482.00, 1, 1, 0, 0, 1, 1, 0, 1, 0],
            "Intel Core i3-1215U" => [120.00, 0, 0, 0, 0, 0, 1, 0, 1, 0],
            "Intel Core i5-11320H" => [309.00, 1, 0, 0, 0, 0, 0, 1, 1, 0],
            "AMD Ryzen 5 PRO 5650GE" => [326.00, 1, 1, 1, 0, 1, 0, 1, 1],
            "AMD Ryzen 9 5900HX" => [450.00, 1, 1, 1, 1, 1, 0, 0, 1, 1],
            "Intel Core i5-11400H" => [155.89, 1, 0, 0, 0, 0, 0, 0, 1, 0],
            "AMD Ryzen 7 6800HS" => [1350.00, 1, 1, 1, 0, 1, 0, 1, 1, 1],
            "AMD Ryzen 7 7735U" => [280.00, 1, 0, 0, 0, 1, 0, 0, 1, 1],
            "AMD Ryzen 7 PRO 6850U" => [1550.00, 1, 0, 1, 0, 1, 1, 0, 1, 1],
            "AMD Ryzen 5 PRO 6650H" => [1422, 1, 1, 1, 0, 1, 1, 0, 1, 1],
            "AMD Ryzen 5 6600H" => [400.00, 1, 0, 1, 0, 1, 1, 0, 1, 1],
            "AMD Ryzen 9 PRO 6950H" => [2100.00, 1, 1, 1, 0, 1, 0, 0, 1, 1],
            "AMD Ryzen 7 7736U" => [350.00, 1, 0, 1, 0, 1, 0, 0, 1, 1],
            "AMD Ryzen 3 PRO 5350G" => [124.00, 0, 0, 0, 0, 1, 1, 0, 1, 0],
            "Intel Core i9-9900KS" => [600.00, 1, 1, 1, 0, 1, 0, 0, 1, 0],
            "Intel Core i9-10900KF" => [654.00, 1, 1, 1, 0, 1, 0, 0, 1, 0],
            "Intel Core i9-10900K" => [700.00, 1, 1, 1, 1, 1, 0, 0, 1, 0],
            "Intel Core i5-11260H" => [250.00, 1, 1, 0, 0, 0, 0, 1, 1, 0],
            "Intel Core i5-1155G7" => [340, 1, 1, 0, 0, 1, 1, 1, 1, 0],
            "AMD Ryzen 7 6800U" => [459.99, 1, 1, 0, 0, 1, 0, 0, 1, 1],
            "Intel Core i7-1165G7" => [426.93, 1, 0, 1, 0, 0, 1, 0, 1, 0],
            "AMD Ryzen 7 5800H" => [899.99, 1, 1, 1, 0, 1, 1, 0, 1, 0],
            "Apple M1" => [300, 0, 1, 0, 0, 0, 1, 0, 0, 0],
            "Apple M1 Pro" => [350, 0, 1, 1, 0, 0, 1, 0, 0, 0],
            "Apple M1 Max" => [400, 0, 1, 1, 0, 0, 1, 1, 0, 0],
            "Apple M2" => [320, 1, 0, 1, 0, 0, 1, 0, 0, 0],
            "Apple M2 Pro" => [370, 0, 1, 0, 0, 1, 1, 0, 0, 1],
            "Apple M2 Max" => [420, 1, 1, 1, 0, 1, 1, 1, 0, 1],
            "Apple M3" => [350, 1, 1, 0, 0, 0, 1, 1, 0, 0],
            "Apple M3 Pro" => [400, 1, 1, 1, 0, 1, 1, 1, 0, 0],
            "Apple M3 Max" => [450, 1, 1, 1, 1, 1, 1, 1, 0, 1],
        ];

        $userResponses = array_values($answers);

        function calculateSimilarity($userResponses, $cpuModel, $weights)
        {
            $similarity = 0;
            for ($i = 1; $i < count($cpuModel); $i++) {
                if ($userResponses[$i - 1] == $cpuModel[$i]) {
                    $similarity += $weights[$i - 1];
                }
            }
            return $similarity;
        }

        // Define weights for each preference (based on importance)
        $preferenceWeights = [3, 1.5, 2.5, 1, 1, 2, 2, 1, 3, 1];

        $bestMatch = null;
        $maxSimilarity = 0;
        $alternativeSuggestions = [];

        foreach ($cpuModels as $modelName => $cpuModel) {
            if ($cpuModel[0] <= $userBudget) {
                $similarity = calculateSimilarity($userResponses, $cpuModel, $preferenceWeights);

                if ($similarity > $maxSimilarity) {
                    $maxSimilarity = $similarity;
                    $bestMatch = $modelName;
                }
            } else {
                if ($cpuModel[0] <= $userBudget * 1.1) {
                    $alternativeSuggestions[$modelName] = $cpuModel[0];
                }
            }
        }

        if ($bestMatch !== null) {
            echo "<p style='font-size: 25px; color: #fff;'>Based on your answers and budget, the recommended CPU model is: <h1 style='font-size: 45px; color: #fff;'>$bestMatch</h1></p>";
        } else {
            echo "<p style='font-size: 25px; color: #fff;'>No perfect match found within your budget.</p>";
            if (!empty($alternativeSuggestions)) {
                echo "<p style='font-size: 25px; color: #fff;'>However, here are some close alternatives:</p>";
                foreach ($alternativeSuggestions as $model => $price) {
                    echo "<p style='font-size: 20px; color: #fff;'>$model for $$price</p>";
                }
            } else {
                echo "<p style='font-size: 25px; color: #fff;'>Please adjust your preferences or budget.</p>";
            }
        }
        ?>
        <p>Thank you for your responses.</p>
        <a href="index.php">
            <button class="btn">
                <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1"
                    class="sparkle">
                    <path
                        d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z">
                    </path>
                </svg>

                <span class="text">Start Over</span>
            </button>
        </a>
    </div>


    <footer>
        <p>©
            <?php echo date("Y"); ?> Pick CPU. By Mahdiyar Salavati & Sahand Masoudi. All rights reserved.
        </p>
    </footer>

</body>

</html>