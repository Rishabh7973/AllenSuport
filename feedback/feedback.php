<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login'])) {
    header("Location: /Allensuport/users/index.php"); // Redirect to login page if not logged in
    exit();
}

// Database connection
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "cms";

$conn = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("Could not connect database");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch the CRN of the logged-in user
$logged_in_user = $_SESSION['login']; // Get the logged-in user's email
$sql = "SELECT CRN FROM users WHERE userEmail = '$logged_in_user'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $logged_in_crn = $row['CRN']; // Get the CRN of the logged-in user
} else {
    $logged_in_crn = ""; // Default value if CRN is not found
}

mysqli_close($conn); // Close the connection
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>FACULTY FEEDBACK SYSTEM</title>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            background-image: url('https://www.transparenttextures.com/patterns/brushed-alum.png'); /* Subtle pattern background */
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        /* Top Header Styling */
        #topHeader {
            background-color: #005f73;
            color: white;
            padding-bottom: 10px;
            text-align: center;
            font-size: 24px;
            width: 50%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .tag {
            font-size: 18px;
            color: #e9c46a;
        }

        /* Content Area Styling */
        #content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
            animation: slideIn 1s ease-out;
            margin-top: 50px;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .SubHead {
            font-size: 20px;
            color: #2a9d8f;
            margin-bottom: 20px;
        }

        /* Form and Table Styling */
        #table {
            display: table;
            width: 100%;
        }

        .tr {
            display: table-row;
        }

        .td, .tdd {
            display: table-cell;
            padding: 10px;
        }

        label {
            color: #264653;
        }

        input[type="text"], input[type="button"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        input[type="button"], input[type="submit"] {
            background-color: #2a9d8f;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="button"]:hover, input[type="submit"]:hover {
            background-color: #21867a;
        }

        /* Animation for buttons */
        input[type="button"], input[type="submit"] {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div id="topHeader">
        FACULTY FEEDBACK SYSTEM<br />
        <span class="tag">STUDENT FEEDBACK</span>
    </div>

    <div id="content" align="center">
        <span class="SubHead">Student Feedback Step I</span>
        <form method="post" action="feedback_step_2.php">
            <div id="table">
                <div class="tr">
                    <div class="td">
                        <label>Roll No : </label>
                    </div>
                    <div class="td">
                        <!-- Display the CRN in a read-only input field -->
                        <input type="text" name="roll" value="<?php echo htmlspecialchars($logged_in_crn); ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="tdd">
                <input type="submit" value="NEXT" />&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" onClick="window.location='http://localhost/Allensuport/users/dashboard.php'" value="BACK">
            </div>
        </form>
    </div>
</body>
</html>