<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Start Quiz</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #fff0f5; padding: 50px; text-align: center; }
        select, button { font-size: 20px; padding: 12px 20px; border-radius: 10px; border: 2px solid #ffd9d9; margin-top: 20px; cursor: pointer; }
        button { background: #ffb6c1; color: #5d4037; border: none; }
        button:hover { background: #f48fb1; }
        a { display: block; margin-top: 30px; color: #5d4037; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
    <form method="POST" action="quiz.php">
        <label for="qcount">Choose number of questions:</label><br>
        <select name="qcount" id="qcount" required>
            <option value="5">5 Questions (3 minutes)</option>
            <option value="10">10 Questions (6 minutes)</option>
            <option value="15">15 Questions (10 minutes)</option>
        </select><br>
        <button type="submit">Start Quiz</button>
    </form>

    <a href="signout.php">Sign Out</a>
</body>
</html>