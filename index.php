<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Sequence Operations</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Number Sequence Operations</h1>
    <form method="POST">
        <label for="input-numbers">Input your numbers (comma-separated)</label>
        <input type="text" id="input-numbers" name="numbers" placeholder="e.g., 5, 25, 13, 8, 45, 6, 11">
        <input type="submit" value="Submit">
    </form>
    
    <?php
    $numbers = [];

    // Check if the form is submitted and process the input
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["numbers"])) {
        $input = $_POST["numbers"];
        // Convert input string to an array of numbers
        $numbers = array_map('floatval', array_filter(array_map('trim', explode(',', $input)), 'is_numeric'));
        
        // Display the number sequence
        if (!empty($numbers)) {
            echo "<p>Given sequence of numbers: " . implode(", ", $numbers) . "</p>";

            // Show buttons after input is processed
            echo '<form method="POST">
                    <input type="hidden" name="numbers" value="' . htmlspecialchars($input) . '">
                    <button name="action" value="max">Show Max</button>
                    <button name="action" value="min">Show Min</button>
                    <button name="action" value="sort-min-max">Sort Min to Max</button>
                    <button name="action" value="sort-max-min">Sort Max to Min</button>
                </form>';
        }
    }

    // Handle the button actions
    if (!empty($numbers)) {
        if (isset($_POST["action"])) {
            $action = $_POST["action"];

            // Function to find the maximum number
            if ($action === "max") {
                $maxNumber = $numbers[0];
                for ($i = 1; $i < count($numbers); $i++) {
                    if ($numbers[$i] > $maxNumber) {
                        $maxNumber = $numbers[$i];
                    }
                }
                echo "<p>Max Number: $maxNumber</p>";
            }

            // Function to find the minimum number
            if ($action === "min") {
                $minNumber = $numbers[0];
                for ($i = 1; $i < count($numbers); $i++) {
                    if ($numbers[$i] < $minNumber) {
                        $minNumber = $numbers[$i];
                    }
                }
                echo "<p>Min Number: $minNumber</p>";
            }

            // Function to sort numbers from smallest to largest
            if ($action === "sort-min-max") {
                $sortedNumbers = $numbers;
                for ($i = 0; $i < count($sortedNumbers) - 1; $i++) {
                    for ($j = $i + 1; $j < count($sortedNumbers); $j++) {
                        if ($sortedNumbers[$i] > $sortedNumbers[$j]) {
                            $temp = $sortedNumbers[$i];
                            $sortedNumbers[$i] = $sortedNumbers[$j];
                            $sortedNumbers[$j] = $temp;
                        }
                    }
                }
                echo "<p>Sorted Min to Max: " . implode(", ", $sortedNumbers) . "</p>";
            }

            // Function to sort numbers from largest to smallest
            if ($action === "sort-max-min") {
                $sortedNumbers = $numbers;
                for ($i = 0; $i < count($sortedNumbers) - 1; $i++) {
                    for ($j = $i + 1; $j < count($sortedNumbers); $j++) {
                        if ($sortedNumbers[$i] < $sortedNumbers[$j]) {
                            $temp = $sortedNumbers[$i];
                            $sortedNumbers[$i] = $sortedNumbers[$j];
                            $sortedNumbers[$j] = $temp;
                        }
                    }
                }
                echo "<p>Sorted Max to Min: " . implode(", ", $sortedNumbers) . "</p>";
            }
        }
    }
    ?>
</body>
</html>
