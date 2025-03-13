<?php
include("configASL.php");
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['aid'])) {
    header("location:index.php");
}

$aid = $_SESSION['aid'];
$x = mysqli_query($al, "SELECT * FROM admin WHERE aid='$aid'");
$y = mysqli_fetch_array($x);
$name = $y['name'];
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Feedback System</title>
    <style>
        /* General Body Styling */
    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        overflow: hidden;
    }

    /* Top Header Styling */
    #topHeader {
        font-size: 2.5em;
        font-weight: bold;
        color: #2c3e50;
        text-align: center;
        margin-top: 20px;
        animation: fadeInDown 1.5s ease-in-out;
    }

    .tag {
        font-size: 0.6em;
        color: #7f8c8d;
        display: block;
        margin-top: 10px;
    }

    /* Content Container Styling */
    #content {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: slideInUp 1.5s ease-in-out;
        width: 90%;
        max-width: 500px;
        margin-left: 60px;
    }

    /* Form Styling */
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Table-like Layout for Form */
    #table {
        display: table;
        width: 100%;
    }

    .tr {
        display: table-row;
    }

    .td {
        display: table-cell;
        padding: 10px;
    }

    .tdd {
        margin-top: 20px;
    }

    /* Input and Select Field Styling */
    input[type="text"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    select:focus {
        border-color: #3498db;
        outline: none;
    }

    /* Button Styling */
    input[type="submit"],
    input[type="button"] {
        background: #3498db;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.3s ease;
        margin: 5px;
    }

    input[type="submit"]:hover,
    input[type="button"]:hover {
        background: #2980b9;
        transform: scale(1.05);
    }

    /* Subhead Styling */
    .SubHead {
        font-size: 1.5em;
        color: #34495e;
        margin-bottom: 20px;
        animation: fadeIn 2s ease-in-out;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    </style>
</head>
<body>
    <div id="topHeader">
        Faculty Feedback System<br />
        <span class="tag">Evaluation of Feedback</span>
    </div>

    <div id="content" align="center">
        <span class="SubHead"><b>Student Feedback</span>
        <br><br>
        <form method="post" action="feeds_2.php">
            <div id="table">
                <div class="tr">
                    <div class="td">
                        <label>Faculty : </label>
                    </div>
                    <div class="td">
                        <select name="faculty_id" id="faculty_id" required onchange="fetchSubjects(this.value)">
                            <option value="NA" disabled selected> - - Select Faculty - -</option>
                            <?php
                            $x = mysqli_query($al, "SELECT * FROM faculty");
                            while ($y = mysqli_fetch_array($x)) {
                                echo "<option value='" . $y['faculty_id'] . "'>" . $y['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <label>Subject : </label>
                    </div>
                    <div class="td">
                        <select name="subject" id="subject" required>
                            <option value="NA" disabled selected> - - Select Subject - -</option>
                            <!-- Subjects will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                </div>
            </div>
            <div class="tdd">
                <input type="button" onClick="window.location='home.php'" value="BACK">
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="NEXT" />
            </div>
        </form>
    </div>

    <script>
        // JavaScript function to fetch subjects based on selected faculty
        function fetchSubjects(facultyId) {
            if (facultyId === "NA") {
                document.getElementById("subject").innerHTML = "<option value='NA' disabled selected> - - Select Subject - -</option>";
                return;
            }

            // Fetch subjects using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "fetch_subjects.php?faculty_id=" + facultyId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("subject").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>