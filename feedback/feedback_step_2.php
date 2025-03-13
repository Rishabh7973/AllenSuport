<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Feedback System</title>
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

    /* Exit button specific styling */
    input[type="button"][onClick*="exit.php"] {
        background-color: #e76f51;
    }

    input[type="button"][onClick*="exit.php"]:hover {
        background-color: #d45a3d;
    }
</style>
</head>

<body>
<?php
include "configASL.php";
session_start();
if(isset($_POST['roll']))
{
    $_SESSION['roll']=$_POST['roll'];
}
?>
<div id="topHeader">
   FACULTY FEEDBACK SYSTEM<br />
    <span class="tag">STUDENT FEEDBACK </span>
</div>

<div id="content" align="center">
    <span class="SubHead">Step II</span>
    <form method="post" action="feedback_step_3.php">
        <div id="table">
            <div class="tr">
                <div class="td">
                    <label>Roll No : </label>
                </div>
                <div class="td">
                    <input type="text" disabled size="5" value="<?php echo $_SESSION['roll'];?>" />
                </div>
            </div>
            <div class="tr">
                <div class="td">
                    <label>Faculty : </label>
                </div>
                <div class="td">
                    <select name="faculty_id" required>
                        <option value="NA" disabled selected> - - Select Faculty - -</option>
                        <?php
                        $x=mysqli_query($al,"select * from faculty");
                        while($y=mysqli_fetch_array($x))
                        {
                        ?>
                        <option value="<?php echo $y['faculty_id'];?>"><?php echo $y['name'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="tdd">
            <input type="button" onClick="window.location='feedback.php'" value="BACK">&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" onClick="window.location='exit.php'" value="EXIT">&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="NEXT" />
        </div>
    </form>
</div>
</body>
</html>