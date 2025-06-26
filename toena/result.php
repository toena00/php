<?php
include 'db.php';

$level = $_POST['level'] ?? 'quick';
$question_counts = ['quick' => 10, 'normal' => 15, 'deep' => 20];
$count = $question_counts[$level] ?? 10;

$score = 0;
for ($i = 0; $i < $count; $i++) {
  $score += (int)($_POST["q$i"] ?? 0);
}

$avg = $score / $count;

if ($avg <= 1.75) {
  $result = "Your mental health seems stable. Keep maintaining a healthy lifestyle.";
} elseif ($avg <= 2.5) {
  $result = "You may be experiencing some stress. Consider practicing relaxation techniques.";
} elseif ($avg <= 3.25) {
  $result = "You may be facing moderate mental health struggles. Seek support if needed.";
} else {
  $result = "High signs of mental health concerns. It's recommended to consult a professional.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quiz Results</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Your Mental Health Check Result</h2>
    <p><?= $result ?></p>
    <a href="resources.php" class="btn">View Resources</a>
    <a href="index.php" class="btn">Take Another Quiz</a>
  </div>
</body>
</html>

<?php
/* =============== FILE: resources.php =============== */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mental Health Resources</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Helpful Resources</h2>
    <ul style="list-style-type:none; padding-left:0;">
      <li><a class="btn" href="https://www.mentalhealth.org.uk/">Mental Health Foundation</a></li>
      <li><a class="btn" href="https://www.headspace.com/">Headspace – Meditation App</a></li>
      <li><a class="btn" href="https://www.samaritans.org/">Samaritans – Crisis Support</a></li>
      <li><a class="btn" href="https://www.nimh.nih.gov/">NIMH – Mental Health Info</a></li>
    </ul>
    <a href="index.php" class="btn">Back to Home</a>
  </div>
</body>
</html>