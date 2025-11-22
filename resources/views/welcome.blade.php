<!DOCTYPE html>
<html>
<head>
    <title>HungryBird - Course Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
            background-color: #ffffff;
        }

        header {
            background: linear-gradient(135deg, #4A70A9 0%, #73AF6F 50%, #5A9454 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        nav {
            display: flex;
            gap: 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            transition: opacity 0.3s;
        }

        nav a:hover {
            opacity: 0.8;
        }

        .hero {
            background: linear-gradient(135deg, #4A70A9 0%, #73AF6F 50%, #5A9454 100%);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 40px;
            line-height: 1.6;
            opacity: 0.95;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .cta-buttons a {
            padding: 14px 32px;
            background: white;
            color: #4A70A9;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .cta-buttons a:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .cta-buttons a.secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid white;
        }

        .cta-buttons a.secondary:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 20px;
        }

        .features-section {
            margin-bottom: 80px;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 50px;
            text-align: center;
            color: #333;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .feature-card {
            padding: 30px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #4A70A9;
            transition: all 0.3s;
        }

        .feature-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

        .feature-card h3 {
            font-size: 18px;
            margin-bottom: 12px;
            color: #333;
            font-weight: 600;
        }

        .feature-card p {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
        }

        .footer {
            background: #f8f9fa;
            padding: 40px 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #e0e0e0;
        }

        .image-section {
            text-align: center;
            margin-bottom: 60px;
        }

        .image-section img {
            max-width: 400px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="brand">HungryBird</div>
            <nav>
                <a href="/courses">Courses</a>
                <a href="/instructor-register">Teach</a>
                <a href="/admin/login">Admin</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Learn & Teach Online</h1>
            <p>Join thousands of students learning from expert instructors in our comprehensive course management system</p>
            <div class="cta-buttons">
                <a href="/courses">Browse Courses</a>
                <a href="/instructor-register" class="secondary">Become an Instructor</a>
            </div>
        </div>
    </section>

    <main class="main-content">
        <section class="features-section">
            <h2 class="section-title">Why Choose HungryBird?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <h3>Expert Instructors</h3>
                    <p>Learn from experienced professionals who are passionate about teaching and sharing their expertise with students worldwide.</p>
                </div>
                <div class="feature-card">
                    <h3>Quality Content</h3>
                    <p>Access carefully curated courses designed with industry standards and best practices to ensure your learning success.</p>
                </div>
                <div class="feature-card">
                    <h3>Learn at Your Pace</h3>
                    <p>Study whenever you want, wherever you want. No strict deadlines, just learning that fits your schedule perfectly.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2025 HungryBird. All rights reserved.</p>
    </footer>
</body>
</html>
