<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "configASL.php"; // Include your database configuration file
session_start();

// Debug session variables
 ($_SESSION['roll'] ?? 'Not set') . "<br>";
 ($_SESSION['faculty_id'] ?? 'Not set') . "<br>";

// Store roll and faculty_id in session if submitted
if (isset($_POST['roll'])) {
    $_SESSION['roll'] = $_POST['roll'];
}

if (isset($_POST['faculty_id'])) {
    $_SESSION['faculty_id'] = $_POST['faculty_id'];
}

// Fetch Faculty Name
$faculty_query = mysqli_query($al, "SELECT * FROM faculty WHERE faculty_id='" . $_SESSION['faculty_id'] . "'");
if (!$faculty_query) {
    die("Faculty query failed: " . mysqli_error($al));
}
$faculty_data = mysqli_fetch_array($faculty_query);
$_SESSION['name'] = $faculty_data['name'];

// Debug faculty data
 $_SESSION['name'] . "<br>";

// Fetch subjects taught by the faculty
$subjects_query = mysqli_query($al, "SELECT s1, s2, s3, s4, s5 FROM faculty WHERE faculty_id='" . $_SESSION['faculty_id'] . "'");
if (!$subjects_query) {
    die("Subjects query failed: " . mysqli_error($al));
}
$subjects_data = mysqli_fetch_array($subjects_query);



// Fetch feedback data for the student
$feedback_query = mysqli_query($al, "SELECT subject FROM feeds WHERE roll='" . $_SESSION['roll'] . "' AND faculty_id='" . $_SESSION['faculty_id'] . "'");
if (!$feedback_query) {
    die("Feedback query failed: " . mysqli_error($al));
}
$feedback_subjects = [];
while ($row = mysqli_fetch_array($feedback_query)) {
    $feedback_subjects[] = $row['subject'];
}


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
        padding: 20px;
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
        width: 350px;
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
        text-align: center;
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
        font-weight: bold;
    }

    input[type="text"], select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border-radius: 4px;
        border: 1px solid #ddd;
        box-sizing: border-box;
    }

    input[type="text"]:disabled {
        background-color: #f0f0f0;
        color: #555;
    }

    input[type="button"], input[type="submit"] {
        background-color: #2a9d8f;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin: 5px;
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
        <span class="SubHead">Step III</span>
        <form method="post" action="feedback_step_4.php">
            <div id="table">
                <div class="tr">
                    <div class="td">
                        <label>Roll No : </label>
                    </div>
                    <div class="td">
                        <input type="text" disabled size="5" value="<?php echo $_SESSION['roll']; ?>" />
                        <input type="hidden" value="<?php echo $_SESSION['roll']; ?>" name="roll" />
                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <label>Faculty : </label>
                    </div>
                    <div class="td">
                        <input type="text" disabled size="25" value="<?php echo $_SESSION['name']; ?>" />
                        <input type="hidden" value="<?php echo $_SESSION['faculty_id']; ?>" name="faculty_id" />
                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <label>Subject : </label>
                    </div>
                    <div class="td">
                        <select name="subject" required>
                            <option value="NA" disabled selected> - - Select Subject - -</option>
                            <?php
                            // Loop through each subject and check if feedback has been submitted
                            $subject_keys = ['s1', 's2', 's3', 's4', 's5']; // Use only string keys
                            foreach ($subject_keys as $key) {
                                $subject = $subjects_data[$key];
                                if (!empty($subject)) {
                                    $disabled = in_array($subject, $feedback_subjects) ? 'disabled' : '';
                                    echo "<option value='$subject' $disabled>$subject</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="tdd">
                <input type="button" onClick="window.location='feedback_step_2.php'" value="BACK">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="NEXT" />
            </div>
        </form>
    </div>
</body>
</html>