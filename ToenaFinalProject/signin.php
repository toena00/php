<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    if ($username === "") {
        $error = "Please enter your name.";
    } else {
        $_SESSION['username'] = htmlspecialchars($username);
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fff0f5; text-align: center; padding-top: 80px; }
        input { padding: 10px; font-size: 18px; border-radius: 8px; border: 1px solid #ccc; }
        button { background: #ffb6c1; border: none; padding: 10px 25px; font-size: 18px; border-radius: 8px; cursor: pointer; margin-left: 10px; }
        button:hover { background: #f48fb1; }
        .error { color: red; margin-top: 15px; }
    </style>
</head>
<body>
    <h1>Sign In</h1>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Enter your name" required>
        <button type="submit">Sign In</button>
    </form>
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
</body>
</html>