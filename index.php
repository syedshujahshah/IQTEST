<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional IQ Test - Measure Your Intelligence</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .hero-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
            border-radius: 50%;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: white;
            font-weight: bold;
        }

        h1 {
            color: #2c3e50;
            font-size: 2.8rem;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 1.3rem;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin: 40px 0;
        }

        .feature {
            text-align: center;
            padding: 20px;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #3498db, #2980b9);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .feature h3 {
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .feature p {
            color: #7f8c8d;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .start-btn {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
            padding: 18px 50px;
            border: none;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 30px rgba(231, 76, 60, 0.3);
        }

        .start-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(231, 76, 60, 0.4);
        }

        .info-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            text-align: left;
        }

        .info-section h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .info-list {
            list-style: none;
            padding: 0;
        }

        .info-list li {
            padding: 10px 0;
            border-bottom: 1px solid #ecf0f1;
            color: #34495e;
            font-size: 1.1rem;
        }

        .info-list li:before {
            content: "✓";
            color: #27ae60;
            font-weight: bold;
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 20px;
            }
            
            h1 {
                font-size: 2.2rem;
            }
            
            .subtitle {
                font-size: 1.1rem;
            }
            
            .features {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="hero-section">
            <div class="logo">IQ</div>
            <h1>Professional IQ Test</h1>
            <p class="subtitle">Discover your cognitive abilities with our scientifically designed intelligence assessment</p>
            
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">🧠</div>
                    <h3>Logical Reasoning</h3>
                    <p>Test your ability to think logically and solve complex problems</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🔢</div>
                    <h3>Numerical Skills</h3>
                    <p>Evaluate your mathematical and numerical reasoning capabilities</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🎯</div>
                    <h3>Pattern Recognition</h3>
                    <p>Assess your ability to identify patterns and relationships</p>
                </div>
            </div>
            
            <button class="start-btn" onclick="startTest()">Start IQ Test</button>
        </div>
        
        <div class="info-section">
            <h2>What to Expect</h2>
            <ul class="info-list">
                <li>20 carefully crafted questions covering multiple cognitive areas</li>
                <li>Approximately 15-20 minutes to complete</li>
                <li>Instant results with detailed analysis</li>
                <li>Personalized feedback on your cognitive strengths</li>
                <li>Comparison with global intelligence standards</li>
            </ul>
        </div>
    </div>

    <script>
        function startTest() {
            // Add a smooth transition effect
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            
            setTimeout(() => {
                window.location.href = 'quiz.php';
            }, 500);
        }
    </script>
</body>
</html>
