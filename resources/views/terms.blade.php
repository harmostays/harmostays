<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions</title>
    <style>
        /* Basic Styling */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            background-color: #f9f9f9;
        }

        /* Layout Container */
        .container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        /* Sidebar Styling */
        .sidebar {
            flex: 1;
            max-width: 200px;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .sidebar h3 {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #007bff;
            font-size: 0.9em;
            display: block;
            padding: 8px 0;
            transition: color 0.3s;
        }

        .sidebar ul li a:hover, .sidebar ul li a.active {
            color: #0056b3;
            font-weight: bold;
        }

        /* Content Area Styling */
        .content {
            flex: 3;
            padding: 20px;
        }

        .content-section {
            display: none;
            text-align: center;
            font-size: 0.95em;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
        }

        .content-section.active {
            display: block;
        }

        /* Responsive Styling */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                max-width: 100%;
                border-right: none;
                border-bottom: 1px solid #ddd;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <h3>About HarmoStays</h3>
            <ul>
                <li><a href="#" onclick="showSection('about')" class="active">About HarmoStays</a></li>
                <li><a href="#" onclick="showSection('terms')">Terms & Conditions</a></li>
                <li><a href="#" onclick="showSection('privacy')">Privacy Policy</a></li>
                <li><a href="#" onclick="showSection('contact')">Contact Us</a></li>
                <li><a href="#" onclick="showSection('help')">Help & Support</a></li>
                <li><a href="#" onclick="showSection('careers')">Careers</a></li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="content">
            <div id="about" class="content-section active">
                <h1>About HarmoStays</h1>
                <p>Welcome to HarmoStays! We are dedicated to offering you the best travel experiences across Kenya’s coastal region. Our mission is to make your stay memorable and hassle-free.</p>
            </div>

            <div id="terms" class="content-section">
                <h1>Terms & Conditions</h1>
                <p>By using HarmoStays, you agree to comply with our terms and conditions, ensuring a safe and pleasant experience for all users.</p>
            </div>

            <div id="privacy" class="content-section">
                <h1>Privacy Policy</h1>
                <p>Your privacy is important to us. We ensure that all your personal information is handled with the utmost care.</p>
            </div>

            <div id="contact" class="content-section">
                <h1>Contact Us</h1>
                <p>If you have any questions, feel free to reach out through our contact page or email us at support@harmostays.com.</p>
            </div>

            <div id="help" class="content-section">
                <h1>Help & Support</h1>
                <p>Our support team is here to help you with any inquiries you may have about our services or bookings.</p>
            </div>

            <div id="careers" class="content-section">
                <h1>Careers</h1>
                <p>Join the HarmoStays team and help us redefine the travel experience across Kenya. Check our Careers page for open positions.</p>
            </div>
        </div>
    </div>

    <!-- JavaScript for Tab Navigation -->
    <script>
        function showSection(sectionId) {
            // Remove 'active' class from all content sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.classList.remove('active'));

            // Hide all sidebar links' 'active' classes
            const links = document.querySelectorAll('.sidebar ul li a');
            links.forEach(link => link.classList.remove('active'));

            // Show the selected section
            document.getElementById(sectionId).classList.add('active');
            event.target.classList.add('active');
        }
    </script>
</body>
</html>
