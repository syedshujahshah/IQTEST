<?php
session_start();

// Initialize quiz session
if (!isset($_SESSION['quiz_started'])) {
    $_SESSION['quiz_started'] = true;
    $_SESSION['current_question'] = 1;
    $_SESSION['answers'] = array();
    $_SESSION['start_time'] = time();
}

// Quiz questions array
$questions = array(
    1 => array(
        'question' => 'What comes next in the sequence: 2, 6, 12, 20, 30, ?',
        'options' => array('A' => '42', 'B' => '40', 'C' => '38', 'D' => '44'),
        'correct' => 'A',
        'type' => 'numerical'
    ),
    2 => array(
        'question' => 'If all Bloops are Razzles and all Razzles are Lazzles, then all Bloops are definitely Lazzles.',
        'options' => array('A' => 'True', 'B' => 'False', 'C' => 'Cannot be determined', 'D' => 'Sometimes true'),
        'correct' => 'A',
        'type' => 'logical'
    ),
    3 => array(
        'question' => 'Which number should replace the question mark? 3, 7, 15, 31, 63, ?',
        'options' => array('A' => '127', 'B' => '125', 'C' => '129', 'D' => '131'),
        'correct' => 'A',
        'type' => 'pattern'
    ),
    4 => array(
        'question' => 'A car travels 60 miles in 1.5 hours. At this rate, how far will it travel in 4 hours?',
        'options' => array('A' => '160 miles', 'B' => '180 miles', 'C' => '150 miles', 'D' => '140 miles'),
        'correct' => 'A',
        'type' => 'numerical'
    ),
    5 => array(
        'question' => 'Which word does not belong with the others?',
        'options' => array('A' => 'Cat', 'B' => 'Dog', 'C' => 'Bird', 'D' => 'Fish'),
        'correct' => 'C',
        'type' => 'logical'
    ),
    6 => array(
        'question' => 'If you rearrange the letters "CIFAIPC", you would have the name of a(n):',
        'options' => array('A' => 'City', 'B' => 'Animal', 'C' => 'Ocean', 'D' => 'Country'),
        'correct' => 'C',
        'type' => 'verbal'
    ),
    7 => array(
        'question' => 'What is the next number in the series: 1, 4, 9, 16, 25, ?',
        'options' => array('A' => '36', 'B' => '35', 'C' => '30', 'D' => '49'),
        'correct' => 'A',
        'type' => 'pattern'
    ),
    8 => array(
        'question' => 'If 5 machines can make 5 widgets in 5 minutes, how long would it take 100 machines to make 100 widgets?',
        'options' => array('A' => '100 minutes', 'B' => '5 minutes', 'C' => '1 minute', 'D' => '10 minutes'),
        'correct' => 'B',
        'type' => 'logical'
    ),
    9 => array(
        'question' => 'Which of the following is the odd one out?',
        'options' => array('A' => '121', 'B' => '144', 'C' => '169', 'D' => '196'),
        'correct' => 'D',
        'type' => 'numerical'
    ),
    10 => array(
        'question' => 'Complete the analogy: Book is to Reading as Fork is to:',
        'options' => array('A' => 'Drawing', 'B' => 'Writing', 'C' => 'Eating', 'D' => 'Stirring'),
        'correct' => 'C',
        'type' => 'verbal'
    ),
    11 => array(
        'question' => 'What comes next: O, T, T, F, F, S, S, E, ?',
        'options' => array('A' => 'N', 'B' => 'I', 'C' => 'T', 'D' => 'E'),
        'correct' => 'A',
        'type' => 'pattern'
    ),
    12 => array(
        'question' => 'If you have 6 black socks and 6 white socks in a drawer, what is the minimum number you must take out to guarantee a matching pair?',
        'options' => array('A' => '2', 'B' => '3', 'C' => '4', 'D' => '6'),
        'correct' => 'B',
        'type' => 'logical'
    ),
    13 => array(
        'question' => 'Which number is missing: 2, 3, 5, 8, 13, 21, ?',
        'options' => array('A' => '34', 'B' => '29', 'C' => '26', 'D' => '31'),
        'correct' => 'A',
        'type' => 'pattern'
    ),
    14 => array(
        'question' => 'A clock shows 3:15. What is the angle between the hour and minute hands?',
        'options' => array('A' => '7.5°', 'B' => '15°', 'C' => '22.5°', 'D' => '30°'),
        'correct' => 'A',
        'type' => 'numerical'
    ),
    15 => array(
        'question' => 'Which word can be made from these letters: TNESIL?',
        'options' => array('A' => 'LISTEN', 'B' => 'SILENT', 'C' => 'ENLIST', 'D' => 'All of the above'),
        'correct' => 'D',
        'type' => 'verbal'
    ),
    16 => array(
        'question' => 'If A = 1, B = 2, C = 3... what does LOVE equal?',
        'options' => array('A' => '54', 'B' => '57', 'C' => '60', 'D' => '63'),
        'correct' => 'A',
        'type' => 'numerical'
    ),
    17 => array(
        'question' => 'What is the next shape in the pattern: Circle, Square, Triangle, Circle, Square, ?',
        'options' => array('A' => 'Circle', 'B' => 'Square', 'C' => 'Triangle', 'D' => 'Pentagon'),
        'correct' => 'C',
        'type' => 'pattern'
    ),
    18 => array(
        'question' => 'If it takes 8 men 10 hours to build a wall, how long would it take 4 men?',
        'options' => array('A' => '5 hours', 'B' => '16 hours', 'C' => '20 hours', 'D' => '40 hours'),
        'correct' => 'C',
        'type' => 'logical'
    ),
    19 => array(
        'question' => 'Which number should replace the question mark? 144, 121, 100, 81, 64, ?',
        'options' => array('A' => '49', 'B' => '36', 'C' => '25', 'D' => '16'),
        'correct' => 'A',
        'type' => 'pattern'
    ),
    20 => array(
        'question' => 'Complete the sentence: "All birds can fly" is:',
        'options' => array('A' => 'Always true', 'B' => 'Sometimes true', 'C' => 'Never true', 'D' => 'False'),
        'correct' => 'D',
        'type' => 'logical'
    )
);

$current_q = $_SESSION['current_question'];
$total_questions = count($questions);

// Handle form submission
if ($_POST && isset($_POST['answer'])) {
    $_SESSION['answers'][$current_q - 1] = $_POST['answer'];
    
    if ($current_q < $total_questions) {
        $_SESSION['current_question']++;
        header('Location: quiz.php');
        exit;
    } else {
        header('Location: process_quiz.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQ Test - Question <?php echo $current_q; ?></title>
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

        .quiz-container {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        .quiz-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ecf0f1;
        }

        .quiz-title {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .progress-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .question-counter {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
        }

        .progress-bar {
            width: 200px;
            height: 8px;
            background: #ecf0f1;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            transition: width 0.3s ease;
            width: <?php echo ($current_q / $total_questions) * 100; ?>%;
        }

        .question-section {
            margin-bottom: 40px;
        }

        .question-type {
            display: inline-block;
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .question-text {
            font-size: 1.4rem;
            color: #2c3e50;
            line-height: 1.6;
            margin-bottom: 30px;
            font-weight: 500;
        }

        .options-container {
            display: grid;
            gap: 15px;
            margin-bottom: 40px;
        }

        .option {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }

        .option:hover {
            background: #e3f2fd;
            border-color: #2196f3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.2);
        }

        .option.selected {
            background: linear-gradient(45deg, #4caf50, #45a049);
            color: white;
            border-color: #4caf50;
        }

        .option-label {
            width: 40px;
            height: 40px;
            background: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .option.selected .option-label {
            background: rgba(255, 255, 255, 0.2);
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-btn {
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .next-btn {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            opacity: 0.5;
            pointer-events: none;
        }

        .next-btn.active {
            opacity: 1;
            pointer-events: auto;
        }

        .next-btn.active:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
        }

        .timer {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .quiz-container {
                padding: 20px;
            }
            
            .quiz-header {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
            
            .progress-info {
                flex-direction: column;
                gap: 15px;
            }
            
            .question-text {
                font-size: 1.2rem;
            }
            
            .option {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <div class="quiz-header">
            <h1 class="quiz-title">IQ Test Assessment</h1>
            <div class="progress-info">
                <div class="question-counter">
                    Question <?php echo $current_q; ?> of <?php echo $total_questions; ?>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
                <div class="timer" id="timer">15:00</div>
            </div>
        </div>

        <div class="question-section">
            <div class="question-type"><?php echo ucfirst($questions[$current_q]['type']); ?> Reasoning</div>
            <div class="question-text"><?php echo $questions[$current_q]['question']; ?></div>
        </div>

        <form method="POST" id="quizForm">
            <div class="options-container">
                <?php foreach ($questions[$current_q]['options'] as $key => $option): ?>
                <div class="option" onclick="selectOption('<?php echo $key; ?>')">
                    <div class="option-label"><?php echo $key; ?></div>
                    <div class="option-text"><?php echo $option; ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <input type="hidden" name="answer" id="selectedAnswer">
            
            <div class="navigation">
                <div></div>
                <button type="submit" class="nav-btn next-btn" id="nextBtn">
                    <?php echo ($current_q == $total_questions) ? 'Finish Test' : 'Next Question'; ?>
                </button>
            </div>
        </form>
    </div>

    <script>
        let selectedAnswer = null;
        let timeLeft = 900; // 15 minutes in seconds

        function selectOption(answer) {
            // Remove previous selection
            document.querySelectorAll('.option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selection to clicked option
            event.currentTarget.classList.add('selected');
            
            selectedAnswer = answer;
            document.getElementById('selectedAnswer').value = answer;
            
            // Enable next button
            const nextBtn = document.getElementById('nextBtn');
            nextBtn.classList.add('active');
        }

        // Timer functionality
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('timer').textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                document.getElementById('quizForm').submit();
            }
            
            timeLeft--;
        }

        // Start timer
        setInterval(updateTimer, 1000);

        // Prevent form submission without selection
        document.getElementById('quizForm').addEventListener('submit', function(e) {
            if (!selectedAnswer) {
                e.preventDefault();
                alert('Please select an answer before proceeding.');
            }
        });

        // Auto-submit on Enter key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && selectedAnswer) {
                document.getElementById('quizForm').submit();
            }
        });
    </script>
</body>
</html>
