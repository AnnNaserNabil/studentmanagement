<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses We Offer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
            color: white;
        }

        .header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 10px;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
            animation: fadeInUp 1s ease-out;
        }

        .header p {
            font-size: 1.3rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .course-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out both;
        }

        .course-card:nth-child(1) { animation-delay: 0.1s; }
        .course-card:nth-child(2) { animation-delay: 0.2s; }
        .course-card:nth-child(3) { animation-delay: 0.3s; }

        .course-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .course-card:hover::before {
            transform: scaleX(1);
        }

        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        }

        .course-header {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        .course-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 16px;
            transition: transform 0.3s ease;
        }

        .undergraduate .course-icon {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
        }

        .graduate .course-icon {
            background: linear-gradient(135deg, #4ecdc4, #6fd4d1);
        }

        .phd .course-icon {
            background: linear-gradient(135deg, #45b7d1, #64c5f2);
        }

        .course-card:hover .course-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .course-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .course-list {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 24px;
            margin: 24px 0;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }

        .undergraduate .course-list {
            border-left-color: #ff6b6b;
        }

        .graduate .course-list {
            border-left-color: #4ecdc4;
        }

        .phd .course-list {
            border-left-color: #45b7d1;
        }

        .course-item {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
            transition: all 0.2s ease;
        }

        .course-item:last-child {
            border-bottom: none;
        }

        .course-item:hover {
            background: rgba(255,255,255,0.7);
            border-radius: 8px;
            padding-left: 8px;
        }

        .course-code {
            font-weight: 600;
            color: #495057;
            min-width: 80px;
        }

        .course-name {
            flex: 1;
            margin-left: 12px;
            color: #343a40;
        }

        .course-credits {
            background: #e9ecef;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #6c757d;
        }

        .course-details {
            margin: 24px 0;
        }

        .detail-section {
            margin-bottom: 16px;
        }

        .detail-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .detail-title::before {
            content: '•';
            color: #6c757d;
            margin-right: 8px;
            font-size: 1.2em;
        }

        .detail-content {
            color: #6c757d;
            padding-left: 16px;
        }

        .apply-btn {
            width: 100%;
            padding: 16px 24px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            overflow: hidden;
        }

        .apply-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .apply-btn:hover::before {
            left: 100%;
        }

        .apply-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .apply-btn:active {
            transform: translateY(0);
        }

        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.2);
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #667eea;
            display: block;
        }

        .stat-label {
            color: #6c757d;
            font-weight: 500;
            margin-top: 4px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.5rem;
            }

            .courses-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .course-card {
                padding: 24px;
            }

            .course-header {
                flex-direction: column;
                text-align: center;
            }

            .course-icon {
                margin-right: 0;
                margin-bottom: 12px;
            }
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .notification.show {
            transform: translateX(0);
        }
          button {
            background-color: #007BFF; 
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        button:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Courses We Offer</h1>
            <p>Discover your path to excellence in Computer Science & Engineering</p>
        </div>

        <div class="courses-grid">
            <div class="course-card undergraduate">
                <div class="course-header">
                    <div class="course-icon">🎓</div>
                    <h3 class="course-title">Undergraduate Program</h3>
                </div>
                
                <div class="course-list">
                    <div class="course-item">
                        <span class="course-code">CSE 101</span>
                        <span class="course-name">Introduction to Computer Science</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 110</span>
                        <span class="course-name">Programming Language I</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 111</span>
                        <span class="course-name">Programming Language II</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 220</span>
                        <span class="course-name">Data Structures</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 221</span>
                        <span class="course-name">Algorithms</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 310</span>
                        <span class="course-name">Object-Oriented Programming</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 342</span>
                        <span class="course-name">Computer Systems Engineering</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 427</span>
                        <span class="course-name">Machine Learning</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 428</span>
                        <span class="course-name">Image Processing</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                </div>

                <div class="course-details">
                    <div class="detail-section">
                        <div class="detail-title">Suggested Books</div>
                        <div class="detail-content">Appropriate book for the language chosen by the course teacher.</div>
                    </div>
                    <div class="detail-section">
                        <div class="detail-title">Assessment</div>
                        <div class="detail-content">Quiz + Assignments + Mid Term Exam + Lab + Final Exam</div>
                    </div>
                </div>

                <button class="apply-btn" onclick="showNotification('Undergraduate Program')">Apply Now</button>
            </div>

            <div class="course-card graduate">
                <div class="course-header">
                    <div class="course-icon">🚀</div>
                    <h3 class="course-title">Graduate Program</h3>
                </div>
                
                <div class="course-list">
                    <div class="course-item">
                        <span class="course-code">CSE 432</span>
                        <span class="course-name">Speech Recognition and Synthesis</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 460</span>
                        <span class="course-name">VLSI Design</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 461</span>
                        <span class="course-name">Introduction to Robotics</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 462</span>
                        <span class="course-name">Fault-Tolerant Systems</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 470</span>
                        <span class="course-name">Software Engineering</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 471</span>
                        <span class="course-name">Systems Analysis and Design</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 472</span>
                        <span class="course-name">Human-Computer Interface</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 473</span>
                        <span class="course-name">Financial Engineering & Technology</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                </div>

                <div class="course-details">
                    <div class="detail-section">
                        <div class="detail-title">Suggested Books</div>
                        <div class="detail-content">Appropriate book for the language chosen by the course teacher.</div>
                    </div>
                    <div class="detail-section">
                        <div class="detail-title">Assessment</div>
                        <div class="detail-content">Quiz + Assignments + Mid Term Exam + Lab + Final Exam</div>
                    </div>
                </div>

                <button class="apply-btn" onclick="showNotification('Graduate Program')">Apply Now</button>
            </div>

            <div class="course-card phd">
                <div class="course-header">
                    <div class="course-icon">🔬</div>
                    <h3 class="course-title">PhD Program</h3>
                </div>
                
                <div class="course-list">
                    <div class="course-item">
                        <span class="course-code">CSE 701</span>
                        <span class="course-name">Advanced Research Methodologies</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 702</span>
                        <span class="course-name">Advanced Topics in Artificial Intelligence</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 703</span>
                        <span class="course-name">Distributed Systems and Cloud Computing</span>
                        <span class="course-credits">3 credits</span>
                    </div>
                    <div class="course-item">
                        <span class="course-code">CSE 704</span>
                        <span class="course-name">Research Seminar and Dissertation</span>
                        <span class="course-credits">12 credits</span>
                    </div>
                </div>

                <div class="course-details">
                    <div class="detail-section">
                        <div class="detail-title">Suggested Books</div>
                        <div class="detail-content">Research papers and publications selected by the supervisor.</div>
                    </div>
                    <div class="detail-section">
                        <div class="detail-title">Assessment</div>
                        <div class="detail-content">Research Proposal + Seminar Presentation + Thesis Defense</div>
                    </div>
                </div>

                <button class="apply-btn" onclick="showNotification('PhD Program')">Apply Now</button>
            </div>
        </div>

        <div class="stats-section">
            <div class="stat-card">
                <span class="stat-number">27</span>
                <span class="stat-label">Total Courses</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">3</span>
                <span class="stat-label">Program Levels</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">100%</span>
                <span class="stat-label">Success Rate</span>
            </div>
        </div>
    </div>

    <div class="notification" id="notification">
        Application submitted successfully!
    </div>
<button onclick="window.location.href='program_select.html'">Go to Program Select</button>

    <script>
        function showNotification(program) {
            const notification = document.getElementById('notification');
            notification.textContent = `${program} application submitted successfully!`;
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Add smooth scrolling animation on load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.course-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            });

            cards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>
</html>
