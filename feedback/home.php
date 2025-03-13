<?php
include("configASL.php");
session_start();
if(!isset($_SESSION['aid']))
{
    header("location:index.php");
}
$aid=$_SESSION['aid'];
$x=mysqli_query($al,"select * from admin where aid='$aid'");
$y=mysqli_fetch_array($x);
$name=$y['name'];

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Feedback System</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background: #f0f2f5;
    }

    #topHeader {
        background: #2c3e50;
        color: white;
        padding: 25px;
        text-align: center;
        font-size: 28px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    #topHeader .tag {
        font-size: 16px;
        color: #ecf0f1;
        display: block;
        margin-top: 10px;
    }

    #content {
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .SubHead {
        font-size: 32px;
        color: #2c3e50;
        margin-bottom: 40px;
        animation: slideIn 1s ease-out;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .button-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        padding: 20px;
    }

    .card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        text-decoration: none;
        color: #34495e;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .card::before {
        content: "";
        display: block;
        width: 120px;
        height: 120px;
        background: #ecf0f1;
        border-radius: 50%;
        margin: 20px auto;
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23999" width="64px" height="64px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>');
        background-repeat: no-repeat;
        background-position: center;
        background-size: 60%;
    }

    .card:nth-child(1)::before { background-color: #e8f4f8; }
    .card:nth-child(2)::before { background-color: #f9e8f0; }
    .card:nth-child(3)::before { background-color: #e8f8f1; }
    .card:nth-child(4)::before { background-color: #f8f1e8; }

    .card h3 {
        margin: 15px 0;
        font-size: 20px;
        font-weight: 600;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .button-container {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>

<body>
<div id="topHeader">
    Faculty Feedback System<br />
    <span class="tag">STUDENT FEEDBACK SYSTEM</span>
</div>

<div id="content" align="center">
    <span class="SubHead">Welcome Admin <?php echo $name;?></span>
    
    <div class="button-container">
    <a href="dashboard.php" class="card">
            <h3>DashBoard</h3>
        </a>
        <a href="feeds.php" class="card">
            <h3>Feedback</h3>
        </a>
        <a href="manageFaculty.php" class="card">
            <h3>Manage Faculty</h3>
        </a>
        <a href="report.php" class="card">
            <h3>Faculty Report</h3>
        </a>
        <a href="changePass.php" class="card">
            <h3>Change Password</h3>
        </a>
        <a href="logout.php" class="card">
            <h3>Logout</h3>
        </a>
    </div>
</div>
</body>
</html>