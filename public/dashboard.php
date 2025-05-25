<?php
// dashboard.php — Main landing page for the scoring web application
// Provides navigation links to Admin Panel, Judge Portal, and Public Scoreboard
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Scoring Web App | Dashboard</title>
    
    <!-- External CSS for the app styling -->
    <link rel="stylesheet" href="assets/style.css">
    
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <!-- Internal styles specific to dashboard layout and responsiveness -->
    <style>
        /* Base styling for body and typography */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        
        /* Container to center content with max width and padding */
        .container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
        }
        
        /* Main heading styling */
        h1 {
            font-size: 42px;
            margin-bottom: 20px;
            color: #222;
        }
        
        /* Subheading/paragraph styling */
        p {
            font-size: 18px;
            margin-bottom: 40px;
            color: #555;
        }
        
        /* Flex container to hold navigation cards */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
        }
        
        /* Individual card styling for the portal links */
        .card {
            background: white;
            padding: 30px 20px;
            width: 280px;
            border-radius: 14px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.08);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        /* Hover effect to lift card slightly and increase shadow */
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1);
        }
        
        /* Icon styling inside the cards */
        .card i {
            font-size: 60px;
            color: #007bff;
            margin-bottom: 20px;
        }
        
        /* Card heading */
        .card h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #222;
        }
        
        /* Link button styling inside the cards */
        .card a {
            display: inline-block;
            padding: 12px 25px;
            background: #007bff;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        
        /* Hover effect for buttons */
        .card a:hover {
            background: #0056b3;
        }
        
        /* Footer styling */
        footer {
            margin-top: 60px;
            color: #777;
            font-size: 14px;
        }
        
        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Page main heading -->
        <h1>The Scoring Web App</h1>
        <!-- Introductory text -->
        <p>Select your portal below to get started.</p>

        <!-- Navigation cards container -->
        <div class="card-container">
            <!-- Admin Panel navigation card -->
            <div class="card">
                <i class="fas fa-user-shield"></i>
                <h2>Admin Panel</h2>
                <a href="admin.php">Go to Admin</a>
            </div>

            <!-- Judge Portal navigation card -->
            <div class="card">
                <i class="fas fa-users"></i>
                <h2>Judge Portal</h2>
                <a href="judge.php">Go to Judge</a>
            </div>

            <!-- Public Scoreboard navigation card -->
            <div class="card">
                <i class="fas fa-chart-bar"></i>
                <h2>Public Scoreboard</h2>
                <a href="index.php">View Scoreboard</a>
            </div>
        </div>

        <!-- Footer with copyright -->
        <footer>
            &copy; <?php echo date("Y"); ?> Scoring Web App | Designed by Naserian Ruth Munkushi
        </footer>
    </div>
</body>
</html>
