<?php
session_start();
include 'db.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$score = 0;
foreach ($_POST as $qid => $answer) {
    $id = str_replace('q', '', $qid);
    $stmt = $conn->prepare("SELECT correct FROM questions WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        if ($row['correct'] == $answer) {
            $score++;
        }
    }
}
?>
<html>
<head>
    <title>Result</title>
    <style>
        body {
            background: linear-gradient(135deg, #FFD1DC 0%, #FFF5BA 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(255, 192, 203, 0.6);
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Your Score: <?php echo "$score / " . count($_POST); ?></h2>
    <a href="index.php">Try Again</a> | <a href="logout.php">Exit</a>
</div>
</body>
</html>
