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

if(!empty($_POST))
{
	$faculty_id=$_POST['faculty_id'];
	//Fetch Name
	$name = mysqli_fetch_array(mysqli_query($al,"SELECT * FROM faculty WHERE faculty_id='".$faculty_id."'"));
	$subject=$_POST['subject'];
	$sql=mysqli_query($al,"select * from feeds where faculty_id='$faculty_id' AND subject='$subject'");
	while($z=mysqli_fetch_array($sql))
	{
		$q1 = $q1 + $z['q1'];
		$q2 = $q2 + $z['q2'];
		$q3 = $q3 + $z['q3'];
		$q4 = $q4 + $z['q4'];
		$q5 = $q5 + $z['q5'];
		$q6 = $q6 + $z['q6'];
		$q7 = $q7 + $z['q7'];
		$q8 = $q8 + $z['q8'];
		$q9 = $q9 + $z['q9'];
		$q10 = $q10 + $z['q10'];
		$total = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9 + $q10;
		$s++;
        $Avg=(float)$total/10;
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Feedback System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Added for responsiveness -->
<style>
    /* General Body Styling */
    body {
        margin: 0;
        padding: 20px;
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        min-height: 100vh;
        overflow-y: auto; /* Allow vertical scrolling */
        animation: fadeIn 1.5s ease-in-out;
    }

    /* Top Header Styling */
    #topHeader {
        text-align: center;
        font-size: 2.5em;
        color: #333;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        animation: slideInDown 1s ease-in-out;
        margin: 20px 0;
    }

    /* Content Styling */
    #content {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        max-width: 90%; /* Flexible width */
        margin: 20px auto;
        animation: slideInUp 1s ease-in-out;
    }

    /* SubHead Styling */
    .SubHead {
        font-size: 1.8em;
        color: #2c3e50;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        animation: fadeIn 1.5s ease-in-out;
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
        animation: fadeIn 2s ease-in-out;
    }

    table td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    table tr:last-child td {
        border-bottom: none;
    }

    table tr td:first-child {
        font-weight: bold;
        color: #34495e;
    }

    /* Button Styling */
    input[type="button"] {
        background: #3498db;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    input[type="button"]:hover {
        background: #2980b9;
        transform: scale(1.05);
    }

    /* Comments Section Styling */
    td[colspan="2"] {
        text-align: center;
        font-style: italic;
        color: #7f8c8d;
        padding: 15px;
        animation: fadeIn 2.5s ease-in-out;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInDown {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideInUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        #topHeader {
            font-size: 2em; /* Smaller header font size */
        }

        #content {
            padding: 15px;
            max-width: 95%; /* Wider on smaller screens */
        }

        .SubHead {
            font-size: 1.5em; /* Smaller subhead font size */
        }

        table td {
            padding: 6px; /* Reduced padding */
        }

        input[type="button"] {
            padding: 8px 16px; /* Smaller buttons */
            font-size: 0.9em;
        }
    }

    @media (max-width: 480px) {
        #topHeader {
            font-size: 1.5em; /* Even smaller header font size */
        }

        .SubHead {
            font-size: 1.2em; /* Smaller subhead font size */
        }

        table td {
            padding: 4px; /* Minimal padding */
            font-size: 0.9em; /* Smaller font size */
        }

        input[type="button"] {
            padding: 6px 12px; /* Even smaller buttons */
            font-size: 0.8em;
        }
    }

    /* Print Styles */
    @media print {
        body {
            background: white;
            color: black;
            font-size: 10pt;
            margin: 0;
            padding: 0;
            display: block;
        }

        #topHeader {
            font-size: 14pt;
            text-align: center;
            margin-bottom: 10px;
        }

        #content {
            width: 100%;
            padding: 0;
            box-shadow: none;
            border-radius: 0;
            background: white;
        }

        .SubHead {
            font-size: 12pt;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }

        table td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        table tr td:first-child {
            font-weight: bold;
        }

        input[type="button"] {
            display: none;
        }

        @page {
            size: A4;
            margin: 0.5cm;
        }
    }
</style>
</head>

<!-- ... (Keep the PHP and CSS parts unchanged) ... -->

<body>
<div id="topHeader">
    FACULTY FEEDBACK SYSTEM<br />
    <span class="tag"></span>
</div>

<div id="content" align="center">
    <span class="SubHead">Student Feedback Analysis</span>

    <table border="0" cellpadding="4" cellspacing="4">
        <tr><td style="font-weight:bold;">Faculty Name : </td><td><?php echo $name['name'];?></td></tr>
        <tr><td style="font-weight:bold;">Subject : </td><td><?php echo $subject;?></td></tr>
        
        <!-- Updated Questions -->
        <tr><td style="font-weight:bold;">1. Teaching Effectiveness:<br>
            <small>Effectiveness in explaining course material</small></td>
            <td><?php echo number_format($q1/$s, 2);?></td></tr></lable>

        <tr><td style="font-weight:bold;">2. Student Engagement:<br>
            <small>Class participation and activities</small></td>
            <td><?php echo number_format($q2/$s, 2);?></td></tr>

        <tr><td style="font-weight:bold;">3. Use of Technology:<br>
            <small>Effective use of digital tools</small></td>
            <td><?php echo number_format($q3/$s, 2);?></td></tr>

        <tr><td style="font-weight:bold;">4. Course Relevance:<br>
            <small>Alignment with industry trends</small></td>
            <td><?php echo number_format($q4/$s, 2);?></td></tr>

        <tr><td style="font-weight:bold;">5. Assignment Clarity:<br>
            <small>Clear project explanations</small></td>
            <td><?php echo number_format($q5/$s, 2);?></td></tr>

        <tr><td style="font-weight:bold;">6. Evaluation Methods:<br>
            <small>Fairness in assessments</small></td>
            <td><?php echo number_format($q6/$s, 2);?></td></tr>

        <tr><td style="font-weight:bold;">7. Faculty Availability:<br>
            <small>Accessibility outside class</small></td>
            <td><?php echo number_format($q7/$s, 2);?></td></tr>

        <tr><td style="font-weight:bold;">8. Classroom Environment:<br>
            <small>Learning-conducive atmosphere</small></td>
            <td><?php echo number_format($q8/$s, 2);?></td></tr>

        <tr><td style="font-weight:bold;">9. Communication Skills:<br>
            <small>Clarity in delivery</small></td>
            <td><?php echo number_format($q9/$s, 2);?></td></tr>

        <tr><td style="font-weight:bold;">10. Overall Satisfaction:<br>
            <small>Complete course experience</small></td>
            <td><?php echo number_format($q10/$s, 2);?></td></tr>

        <tr><td style="font-weight:bold;">Total Responses :</td><td><?php echo $s;?></td></tr>
        <tr><td style="font-weight:bold;">Average Rating :</td><td><?php echo number_format($Avg/$s, 2);?></td></tr>

        <!-- Comments Section -->
        <tr><td style="font-weight:bold;" colspan="2" align="center">
            Improvement Suggestions</td></tr>
        <tr><td colspan="2">
            <?php $cc = mysqli_query($al, "SELECT * FROM comments WHERE faculty_id = '".$faculty_id."' ORDER BY id DESC");
            while($pr = mysqli_fetch_array($cc)) {
                echo "<div class='comment'>".htmlspecialchars($pr['comment'])."</div>";
            }
            ?>
        </td></tr>
    </table>

    <input type="button" onClick="window.print();" value="PRINT">
    <input type="button" onClick="window.location='feeds.php'" value="BACK">
</div>
</body>
</html>
</html>