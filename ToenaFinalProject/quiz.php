<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

// Save or get question count
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qcount'])) {
    $_SESSION['qcount'] = (int)$_POST['qcount'];
}
$qcount = $_SESSION['qcount'] ?? 5;

// Timer in seconds based on question count
$timerSeconds = 180; // 3 mins for 5 questions
if ($qcount == 10) $timerSeconds = 360; // 6 mins
if ($qcount == 15) $timerSeconds = 600; // 10 mins

// Get first N questions ordered by id ascending
$stmt = $conn->prepare("SELECT * FROM questions ORDER BY id ASC LIMIT ?");
$stmt->bind_param("i", $qcount);
$stmt->execute();
$result = $stmt->get_result();
$questions = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 20px;
            background: #fff;
            transition: background 0.5s ease;
        }
        /* Background stripes after quiz starts */
        body.quiz-started {
            background-image:
                repeating-linear-gradient(90deg, #fff7cc 0, #fff7cc 20px, #ffd9d9 20px, #ffd9d9 40px),
                repeating-linear-gradient(0deg, #fff7cc 0, #fff7cc 20px, #ffd9d9 20px, #ffd9d9 40px);
        }
        .timer {
            font-size: 22px;
            font-weight: bold;
            color: #d32f2f;
            margin-bottom: 25px;
            text-align: center;
        }
        .question {
            margin-bottom: 25px;
            background: #fff0f5;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(255,182,193,0.5);
        }
        .question strong {
            font-size: 18px;
        }
        input[type="radio"] {
            margin-right: 8px;
        }
        #result {
            display: none;
            text-align: center;
            margin-top: 30px;
            font-size: 22px;
            font-weight: bold;
            color: #d32f2f;
        }
        #result a {
            margin: 15px;
            color: #555;
            text-decoration: none;
            font-weight: 600;
            border: 2px solid #ffd9d9;
            padding: 8px 15px;
            border-radius: 5px;
            background: #fff7cc;
            transition: background-color 0.3s ease;
        }
        #result a:hover {
            background: #ffd9d9;
        }
        input[type="submit"] {
            background-color: #ffb6c1;
            color: #5d4037;
            border: none;
            padding: 12px 25px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #f48fb1;
        }
    </style>
    <script>
        let timeLeft = <?php echo $timerSeconds; ?>;
        let timerInterval;

        function startTimer() {
            document.body.classList.add('quiz-started');
            const timerEl = document.getElementById('timer');
            timerInterval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById('quizForm').style.display = 'none';
                    const result = document.getElementById('result');
                    result.style.display = 'block';
                    result.innerHTML = 'Time\'s up! You lose.<br><br>' +
                        '<a href="index.php">Start Over</a>' +
                        '<a href="signout.php">Exit</a>';
                } else {
                    let minutes = Math.floor(timeLeft / 60);
                    let seconds = timeLeft % 60;
                    timerEl.textContent = `Time Left: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                    timeLeft--;
                }
            }, 1000);
        }

        window.onload = startTimer;
    </script>
</head>
<body>

    <div class="timer" id="timer">Time Left: <?php echo floor($timerSeconds/60) . ":00"; ?></div>

    <form id="quizForm" method="POST" action="submit_quiz.php">
        <?php foreach ($questions as $index => $q): ?>
            <div class="question">
                <strong>Q<?php echo $index + 1; ?>:</strong> <?php echo htmlspecialchars($q['question']); ?><br><br>
                <label><input type="radio" name="q<?php echo $index; ?>" value="a" required> A. <?php echo htmlspecialchars($q['a']); ?></label><br>
                <label><input type="radio" name="q<?php echo $index; ?>" value="b"> B. <?php echo htmlspecialchars($q['b']); ?></label><br>
                <label><input type="radio" name="q<?php echo $index; ?>" value="c"> C. <?php echo htmlspecialchars($q['c']); ?></label><br>
                <label><input type="radio" name="q<?php echo $index; ?>" value="d"> D. <?php echo htmlspecialchars($q['d']); ?></label><br>
            </div>
        <?php endforeach; ?>
        <input type="submit" value="Submit Quiz">
    </form>

    <div id="result"></div>
