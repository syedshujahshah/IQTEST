<?php
session_start();
require_once 'db.php';

// Calculate score
$questions = array(
    1 => 'A', 2 => 'A', 3 => 'A', 4 => 'A', 5 => 'C',
    6 => 'C', 7 => 'A', 8 => 'B', 9 => 'D', 10 => 'C',
    11 => 'A', 12 => 'B', 13 => 'A', 14 => 'A', 15 => 'D',
    16 => 'A', 17 => 'C', 18 => 'C', 19 => 'A', 20 => 'D'
);

$correct_answers = 0;
$user_answers = $_SESSION['answers'];

foreach ($questions as $q_num => $correct_answer) {
    if (isset($user_answers[$q_num - 1]) && $user_answers[$q_num - 1] == $correct_answer) {
        $correct_answers++;
    }
}

// Calculate IQ score (scaled from 70-160)
$percentage = ($correct_answers / 20) * 100;
$iq_score = round(70 + ($percentage * 0.9));

// Time taken
$time_taken = time() - $_SESSION['start_time'];
$minutes = floor($time_taken / 60);
$seconds = $time_taken % 60;

// Store results in database
try {
    $stmt = $pdo->prepare("INSERT INTO iq_test_results (ip_address, score, correct_answers, total_questions, time_taken, test_date) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$_SERVER['REMOTE_ADDR'], $iq_score, $correct_answers, 20, $time_taken]);
} catch (PDOException $e) {
    // Handle error silently
}

// Store results in session for display
$_SESSION['test_results'] = array(
    'iq_score' => $iq_score,
    'correct_answers' => $correct_answers,
    'total_questions' => 20,
    'percentage' => $percentage,
    'time_taken' => $time_taken
);

// Redirect to results
header('Location: results.php');
exit;
?>
