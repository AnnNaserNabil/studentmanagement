<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Centers Directory</title>
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

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2980b9, #3498db);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .centers-grid {
            padding: 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 25px;
        }

        .center-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .center-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, #3498db, #2980b9);
            transition: width 0.3s ease;
        }

        .center-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .center-card:hover::before {
            width: 8px;
        }

        .center-name {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .center-description {
            color: #7f8c8d;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .center-tag {
            display: inline-block;
            background: linear-gradient(135deg, #ecf0f1, #bdc3c7);
            color: #2c3e50;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .medical { --accent: #e74c3c; }
        .research { --accent: #9b59b6; }
        .student { --accent: #f39c12; }
        .education { --accent: #27ae60; }
        .development { --accent: #34495e; }
        .innovation { --accent: #e67e22; }
        .language { --accent: #16a085; }

        .center-card.medical::before,
        .center-card.medical .center-tag { background: linear-gradient(135deg, #e74c3c, #c0392b); color: white; }
        
        .center-card.research::before,
        .center-card.research .center-tag { background: linear-gradient(135deg, #9b59b6, #8e44ad); color: white; }
        
        .center-card.student::before,
        .center-card.student .center-tag { background: linear-gradient(135deg, #f39c12, #e67e22); color: white; }
        
        .center-card.education::before,
        .center-card.education .center-tag { background: linear-gradient(135deg, #27ae60, #229954); color: white; }
        
        .center-card.development::before,
        .center-card.development .center-tag { background: linear-gradient(135deg, #34495e, #2c3e50); color: white; }
        
        .center-card.innovation::before,
        .center-card.innovation .center-tag { background: linear-gradient(135deg, #e67e22, #d35400); color: white; }
        
        .center-card.language::before,
        .center-card.language .center-tag { background: linear-gradient(135deg, #16a085, #138d75); color: white; }

        .stats-bar {
            background: #f8f9fa;
            padding: 20px 40px;
            display: flex;
            justify-content: space-around;
            border-top: 1px solid #e9ecef;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #2980b9;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            .centers-grid {
                grid-template-columns: 1fr;
                padding: 20px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .stats-bar {
                flex-direction: column;
                gap: 15px;
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Academic Centers Directory</h1>
            <p>Comprehensive facilities supporting education, research, and student development</p>
        </div>

        <div class="centers-grid">
            <div class="center-card medical fade-in">
                <h2 class="center-name">Medical Centre</h2>
                <p class="center-description">Providing comprehensive healthcare services and medical support for students, faculty, and staff with qualified medical professionals.</p>
                <span class="center-tag">Healthcare</span>
            </div>

            <div class="center-card research fade-in">
                <h2 class="center-name">Wazed Miah Science Research Centre</h2>
                <p class="center-description">Advanced research facility dedicated to scientific innovation and discovery, fostering cutting-edge research in various scientific disciplines.</p>
                <span class="center-tag">Research</span>
            </div>

            <div class="center-card student fade-in">
                <h2 class="center-name">Students Counselling and Guidance Centre</h2>
                <p class="center-description">Supporting student mental health and academic success through professional counseling services and guidance programs.</p>
                <span class="center-tag">Support</span>
            </div>

            <div class="center-card language fade-in">
                <h2 class="center-name">The Language Centre</h2>
                <p class="center-description">Enhancing communication skills and language proficiency through specialized language learning programs and resources.</p>
                <span class="center-tag">Language</span>
            </div>

            <div class="center-card education fade-in">
                <h2 class="center-name">Teacher-Student Centre</h2>
                <p class="center-description">Facilitating effective teaching and learning through innovative educational approaches and faculty-student collaboration.</p>
                <span class="center-tag">Education</span>
            </div>

            <div class="center-card education fade-in">
                <h2 class="center-name">Special Needs Education Centre (SNEC)</h2>
                <p class="center-description">Dedicated to providing inclusive education and specialized support services for students with diverse learning needs.</p>
                <span class="center-tag">Inclusive</span>
            </div>

            <div class="center-card development fade-in">
                <h2 class="center-name">Center for Human Resource Development (CHRD)</h2>
                <p class="center-description">Focused on professional development, training programs, and capacity building for institutional growth and excellence.</p>
                <span class="center-tag">Development</span>
            </div>

            <div class="center-card innovation fade-in">
                <h2 class="center-name">Research Innovation Centre</h2>
                <p class="center-description">Promoting entrepreneurship, innovation, and technology transfer to bridge the gap between research and industry applications.</p>
                <span class="center-tag">Innovation</span>
            </div>
        </div>

        <div class="stats-bar">
            <div class="stat">
                <span class="stat-number">8</span>
                <span class="stat-label">Total Centers</span>
            </div>
            <div class="stat">
                <span class="stat-number">5</span>
                <span class="stat-label">Categories</span>
            </div>
            <div class="stat">
                <span class="stat-number">100%</span>
                <span class="stat-label">Active</span>
            </div>
        </div>
    </div>

    <script>
        // Add fade-in animation on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = `${Math.random() * 0.3}s`;
                }
            });
        });

        document.querySelectorAll('.center-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>