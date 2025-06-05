<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global University - Excellence in Education</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: white;
            font-weight: bold;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .university-name {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 20px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .about-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .about-section h2 {
            font-size: 2.5rem;
            margin-bottom: 25px;
            color: #333;
            position: relative;
        }

        .about-section h2:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 20px;
            text-align: justify;
        }

        .info-cards {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .info-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-card .icon {
            width: 30px;
            height: 30px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .info-item {
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .info-item strong {
            color: #333;
            display: inline-block;
            min-width: 120px;
        }

        .links-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .link-category {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .link-category h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .link-list {
            list-style: none;
        }

        .link-list li {
            margin-bottom: 12px;
        }

        .link-list a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: block;
            padding: 8px 15px;
            border-radius: 8px;
            background: rgba(102, 126, 234, 0.05);
        }

        .link-list a:hover {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            transform: translateX(5px);
        }

        .contact-info {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .contact-info h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .contact-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .contact-item {
            padding: 15px;
            background: rgba(102, 126, 234, 0.05);
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .contact-item strong {
            display: block;
            color: #333;
            margin-bottom: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            color: white;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .university-name {
                font-size: 2rem;
            }
            
            .header {
                padding: 20px;
            }
            
            .about-section, .info-card, .link-category {
                padding: 20px;
            }
            
            .links-section {
                grid-template-columns: 1fr;
            }
        }

        .badge-description {
            background: rgba(102, 126, 234, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
            font-style: italic;
        }

        .highlight {
            background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            padding: 3px 8px;
            border-radius: 5px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">GU</div>
            <h1 class="university-name">Global University</h1>
            <p class="subtitle">Excellence in Education • Innovation in Research • Global Impact</p>
        </header>

        <div class="main-content">
            <section class="about-section">
                <h2>About Global University</h2>
                <p class="about-text">
                    Global University, accustomed as a fully residential public university established in <span class="highlight">1970</span>, has now <span class="highlight">36 departments</span> and <span class="highlight">Six Faculties</span> along with <span class="highlight">Four institutes</span>, with more than <span class="highlight">fifteen thousand students</span>, and about <span class="highlight">Five hundred academics</span> adherent to teaching and research.
                </p>
                <p class="about-text">
                    The sprawling attractive campus is anchored 30 kilometres from the capital Dhaka, well connected with a civic highway. The first assembly of Independent Bangladesh granted the university its Charter in 1973 under which the university is being operated.
                </p>
                <div class="badge-description">
                    <strong>University Badge:</strong> The badge of the university bears the national flower 'white lily' (Lilium candidum) with three petals surrounded by strips of a traditional floral design with the name of the university in Bangla encircling in a semi-circle like a band of flowers.
                </div>
                <p class="about-text">
                    Located at Savar near Dhaka, Global University is one of the leading Universities in Bangladesh. The University is a residential one. It was formally launched on <span class="highlight">12 January 1971</span> by its first vice-chancellor Rear Admiral S.M. Ahsan, Governor of former East Pakistan. After Emergence of Bangladesh the Government enacted the Global University Act. 1973, which repealed the previous ordinance and renamed the University as Global University. The University owes its present shape to this act under which it is now functioning.
                </p>
            </section>

            <aside class="info-cards">
                <div class="info-card">
                    <h3><span class="icon">ℹ</span>Quick Facts</h3>
                    <div class="info-item"><strong>Name:</strong> Global University</div>
                    <div class="info-item"><strong>Type:</strong> Public University</div>
                    <div class="info-item"><strong>Establishment:</strong> 20th August, 1970</div>
                    <div class="info-item"><strong>Governed By:</strong> The Global University Act, 1973</div>
                    <div class="info-item"><strong>Academic Year:</strong> 1st July to 30th June</div>
                    <div class="info-item"><strong>Land Area:</strong> 56 Acre</div>
                </div>

                <div class="info-card">
                    <h3><span class="icon">📍</span>Location</h3>
                    <div class="info-item"><strong>Address:</strong> Barishal Sadar, Bangladesh</div>
                    <div class="info-item"><strong>Distance:</strong> 170km from Dhaka</div>
                    <div class="info-item"><strong>Campus:</strong> Fully Residential</div>
                </div>
            </aside>
        </div>

        <section class="links-section">
            <div class="link-category">
                <h3>📋 Useful Links</h3>
                <ul class="link-list">
                    <li><a href="#noc">NOC & GO</a></li>
                    <li><a href="#download">Download Form</a></li>
                    <li><a href="#result">Result</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                </ul>
            </div>

            <div class="link-category">
                <h3>🎓 Admission Links</h3>
                <ul class="link-list">
                    <li><a href="#bachelor">Bachelor (Honours) Admission</a></li>
                    <li><a href="#masters">Masters Admission</a></li>
                    <li><a href="#phd"> PhD Admission</a></li>
                    <li><a href="#weekend">Weekend & Evening Courses</a></li>
                </ul>
            </div>

            <div class="link-category">
                <h3>🔗 Other Services</h3>
                <ul class="link-list">
                    <li><a href="#webmail">Web Mail</a></li>
                    <li><a href="#insurance">Claim for Student Health Insurance</a></li>
                    <li><a href="#email">Apply for Student Email ID</a></li>
                    <li><a href="#health-card">Health Card Data Collection Form</a></li>
                </ul>
            </div>
        </section>

        <section class="contact-info">
            <h3>📞 Contact Information</h3>
            <div class="contact-details">
                <div class="contact-item">
                    <strong>PABX:</strong>
                    7791045-51
                </div>
                <div class="contact-item">
                    <strong>Fax:</strong>
                    880-2-7791052
                </div>
                <div class="contact-item">
                    <strong>Email:</strong>
                    registrar@globaluniv.edu
                </div>
                <div class="contact-item">
                    <strong>Website:</strong>
                    https://globaluniv.edu
                </div>
            </div>
        </section>

        <footer class="footer">
            <p>&copy; 2024 Global University. All rights reserved. | Excellence in Education Since 1970</p>
        </footer>
    </div>
</body>
</html>