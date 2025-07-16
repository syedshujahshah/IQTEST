<?php
session_start();

if (!isset($_SESSION['test_results'])) {
    header('Location: index.php');
    exit;
}

$results = $_SESSION['test_results'];
$iq_score = $results['iq_score'];
$correct_answers = $results['correct_answers'];
$percentage = $results['percentage'];
$time_taken = $results['time_taken'];

$minutes = floor($time_taken / 60);
$seconds = $time_taken % 60;

// Determine IQ category and feedback
function getIQCategory($score) {
    if ($score >= 140) return array('Genius', 'Exceptional intelligence - top 0.1% of population');
    if ($score >= 130) return array('Very Superior', 'Highly gifted - top 2% of population');
    if ($score >= 120) return array('Superior', 'Above average intelligence - top 10% of population');
    if ($score >= 110) return array('High Average', 'Above average cognitive abilities');
    if ($score >= 90) return array('Average', 'Normal intelligence range');
    if ($score >= 80) return array('Low Average', 'Below average but within normal range');
    return array('Below Average', 'Consider additional cognitive training');
}

$category = getIQCategory($iq_score);

// Generate personalized recommendations
function getRecommendations($score, $correct) {
    $recommendations = array();
    
    if ($score >= 130) {
        $recommendations[] = "Consider pursuing advanced academic or professional challenges";
        $recommendations[] = "Explore complex problem-solving activities and puzzles";
        $recommendations[] = "Consider mentoring others in logical reasoning";
    } elseif ($score >= 110) {
        $recommendations[] = "Continue challenging yourself with complex problems";
        $recommendations[] = "Practice pattern recognition exercises regularly";
        $recommendations[] = "Consider learning new languages or skills";
    } else {
        $recommendations[] = "Practice logical reasoning exercises daily";
        $recommendations[] = "Work on mathematical problem-solving skills";
        $recommendations[] = "Try brain training games and puzzles";
        $recommendations[] = "Read more to improve verbal reasoning";
    }
    
    return $recommendations;
}

$recommendations = getRecommendations($iq_score, $correct_answers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your IQ Test Results</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .results-container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .results-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #ecf0f1;
        }

        .results-title {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .completion-message {
            color: #27ae60;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .score-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .score-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .score-number {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .score-label {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 15px;
        }

        .score-category {
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-item {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            text-align: center;
            border-left: 4px solid #3498db;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 1rem;
            font-weight: 500;
        }

        .analysis-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .analysis-title {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .analysis-text {
            color: #34495e;
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .recommendations {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .recommendations h3 {
            font-size: 1.6rem;
            margin-bottom: 20px;
        }

        .recommendation-list {
            list-style: none;
            padding: 0;
        }

        .recommendation-list li {
            padding: 10px 0;
            padding-left: 30px;
            position: relative;
            font-size: 1.1rem;
            line-height: 1.5;
        }

        .recommendation-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 10px;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .progress-bar-container {
            background: #ecf0f1;
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
            margin: 20px 0;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(45deg, #3498db, #2980b9);
            border-radius: 10px;
            transition: width 2s ease;
            width: <?php echo $percentage; ?>%;
            position: relative;
        }

        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .primary-btn {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
        }

        .secondary-btn {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .share-section {
            text-align: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #ecf0f1;
        }

        @media (max-width: 768px) {
            .results-container {
                padding: 20px;
            }
            
            .results-title {
                font-size: 2rem;
            }
            
            .score-number {
                font-size: 3rem;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .action-btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="results-container">
        <div class="results-header">
            <h1 class="results-title">🎉 Test Complete!</h1>
            <p class="completion-message">Congratulations on completing the IQ assessment</p>
        </div>

        <div class="score-section">
            <div class="score-card">
                <div class="score-number"><?php echo $iq_score; ?></div>
                <div class="score-label">Your IQ Score</div>
                <div class="score-category"><?php echo $category[0]; ?></div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number"><?php echo $correct_answers; ?>/20</div>
                <div class="stat-label">Correct Answers</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo round($percentage); ?>%</div>
                <div class="stat-label">Accuracy Rate</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo $minutes; ?>:<?php echo str_pad($seconds, 2, '0', STR_PAD_LEFT); ?></div>
                <div class="stat-label">Time Taken</div>
            </div>
        </div>

        <div class="progress-bar-container">
            <div class="progress-bar">
                <div class="progress-text"><?php echo round($percentage); ?>% Correct</div>
            </div>
        </div>

        <div class="analysis-section">
            <h2 class="analysis-title">📊 Your Performance Analysis</h2>
            <p class="analysis-text">
                <strong><?php echo $category[1]; ?></strong>
            </p>
            <p class="analysis-text">
                You scored <?php echo $iq_score; ?> on this IQ assessment, which places you in the <strong><?php echo $category[0]; ?></strong> intelligence category. 
                You answered <?php echo $correct_answers; ?> out of 20 questions correctly, achieving an accuracy rate of <?php echo round($percentage); ?>%.
            </p>
            <?php if ($iq_score >= 120): ?>
            <p class="analysis-text">
                Your performance demonstrates strong analytical thinking and problem-solving abilities. You excel in logical reasoning and pattern recognition.
            </p>
            <?php elseif ($iq_score >= 100): ?>
            <p class="analysis-text">
                You show solid cognitive abilities with good potential for improvement. Focus on practicing different types of reasoning problems.
            </p>
            <?php else: ?>
            <p class="analysis-text">
                There's great potential for improvement! Regular practice with logic puzzles and reasoning exercises can help enhance your cognitive abilities.
            </p>
            <?php endif; ?>
        </div>

        <div class="recommendations">
            <h3>🎯 Personalized Recommendations</h3>
            <ul class="recommendation-list">
                <?php foreach ($recommendations as $recommendation): ?>
                <li><?php echo $recommendation; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="action-buttons">
            <a href="javascript:void(0)" onclick="retakeTest()" class="action-btn primary-btn">Retake Test</a>
            <a href="javascript:void(0)" onclick="shareResults()" class="action-btn secondary-btn">Share Results</a>
        </div>

        <div class="share-section">
            <p style="color: #7f8c8d; font-size: 0.95rem;">
                * This test provides an estimate of cognitive abilities and should not be considered a professional psychological assessment.
            </p>
        </div>
    </div>

    <script>
        function retakeTest() {
            if (confirm('Are you sure you want to retake the test? Your current results will be lost.')) {
                // Clear session and redirect
                fetch('clear_session.php', {method: 'POST'})
                    .then(() => {
                        window.location.href = 'index.php';
                    });
            }
        }

        function shareResults() {
            const text = `I just scored ${<?php echo $iq_score; ?>} on an IQ test! That puts me in the ${<?php echo json_encode($category[0]); ?>} category. 🧠✨`;
            
            if (navigator.share) {
                navigator.share({
                    title: 'My IQ Test Results',
                    text: text,
                    url: window.location.origin
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                navigator.clipboard.writeText(text + ' ' + window.location.origin)
                    .then(() => {
                        alert('Results copied to clipboard!');
                    })
                    .catch(() => {
                        alert('Share text: ' + text);
                    });
            }
        }

        // Animate progress bar on load
        window.addEventListener('load', function() {
            const progressBar = document.querySelector('.progress-bar');
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.width = '<?php echo $percentage; ?>%';
            }, 500);
        });
    </script>
</body>
</html>
