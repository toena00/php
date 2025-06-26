<?php
include 'db.php';

$level = $_GET['level'] ?? 'quick';

$questions_all = [
    'quick' => [
        "How often do you feel stressed during the day?",
        "Do you find it hard to relax after a busy day?",
        "How frequently do you feel sad or down?",
        "Do you have trouble sleeping because of worry?",
        "How often do you feel overwhelmed by your responsibilities?",
        "Do you find it easy to focus on tasks?",
        "How often do you feel anxious without an obvious reason?",
        "Do you enjoy activities you used to find fun?",
        "How often do you feel fatigued or low on energy?",
        "Do you feel supported by friends or family?"
    ],
    'normal' => [
        "How often do you feel stressed during the day?",
        "Do you find it hard to relax after a busy day?",
        "How frequently do you feel sad or down?",
        "Do you have trouble sleeping because of worry?",
        "How often do you feel overwhelmed by your responsibilities?",
        "Do you find it easy to focus on tasks?",
        "How often do you feel anxious without an obvious reason?",
        "Do you enjoy activities you used to find fun?",
        "How often do you feel fatigued or low on energy?",
        "Do you feel supported by friends or family?",
        "How often do you have mood swings that affect your day?",
        "Do you experience physical symptoms like headaches when stressed?",
        "How comfortable are you sharing your feelings with others?",
        "Do you find it difficult to control negative thoughts?",
        "How often do you experience irritability or anger?"
    ],
    'deep' => [
        "How often do you feel stressed during the day?",
        "Do you find it hard to relax after a busy day?",
        "How frequently do you feel sad or down?",
        "Do you have trouble sleeping because of worry?",
        "How often do you feel overwhelmed by your responsibilities?",
        "Do you find it easy to focus on tasks?",
        "How often do you feel anxious without an obvious reason?",
        "Do you enjoy activities you used to find fun?",
        "How often do you feel fatigued or low on energy?",
        "Do you feel supported by friends or family?",
        "How often do you have mood swings that affect your day?",
        "Do you experience physical symptoms like headaches when stressed?",
        "How comfortable are you sharing your feelings with others?",
        "Do you find it difficult to control negative thoughts?",
        "How often do you experience irritability or anger?",
        "Do you have recurring thoughts that disturb your peace?",
        "How often do you feel hopeless about the future?",
        "Do you avoid social situations because of anxiety?",
        "Have you experienced panic attacks in the past month?",
        "Do you have a support system you can rely on during tough times?"
    ]
];

$questions = $questions_all[$level] ?? $questions_all['quick'];
$count = count($questions);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Quiz - <?= ucfirst($level) ?> Check</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">
    <h2><?= ucfirst($level) ?> Mental Health Quiz</h2>
    <form action="result.php" method="post">
      <input type="hidden" name="level" value="<?= htmlspecialchars($level) ?>" />
      <?php foreach ($questions as $index => $question): ?>
        <p><?= htmlspecialchars($question) ?></p>
        <label><input type="radio" name="q<?= $index ?>" value="1" required> Rarely</label>
        <label><input type="radio" name="q<?= $index ?>" value="2"> Sometimes</label>
        <label><input type="radio" name="q<?= $index ?>" value="3"> Often</label>
        <label><input type="radio" name="q<?= $index ?>" value="4"> Always</label>
      <?php endforeach; ?>
      <br /><button class="btn" type="submit">Submit Quiz</button>
    </form>
  </div>
</body>
</html>