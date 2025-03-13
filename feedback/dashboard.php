<?php
/*session manage code */
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


// Database connection for the first database (cms)
$link1 = mysqli_connect("localhost", "root", "", "cms");

// Check connection for the first database
if (!$link1) {
    die("First database connection failed: " . mysqli_connect_error());
}

// Database connection for the second database (feedback)
$link2 = mysqli_connect("localhost", "root", "", "feedback");

// Check connection for the second database
if (!$link2) {
    die("Second database connection failed: " . mysqli_connect_error());
}

// Fetch data for Faculty Ratings (Maximum Average)
$facultyData = array();
$query1 = "SELECT faculty_id, name, Avg(Percent) as MaxPer FROM feeds GROUP BY faculty_id ORDER BY MaxPer DESC LIMIT 7";
$res1 = mysqli_query($link2, $query1);

if ($res1 === false) {
    die("SQL query for faculty ratings failed: " . mysqli_error($link2));
}

while ($row = mysqli_fetch_array($res1)) {
    $facultyData[] = array(
        "label" => $row["name"], // Faculty name
        "y" => (float)$row["MaxPer"] // Maximum average rating
    );
}

// Fetch data for Student Feedback Statistics
$feedbackData = array();

// Query to fetch total students from the first database
$query2 = "SELECT (SELECT COUNT(crn) FROM users) AS crn_count";
$res2 = mysqli_query($link1, $query2);

if ($res2 === false) {
    die("SQL query for total students failed: " . mysqli_error($link1));
}

$crn_count = 0;
while ($row = mysqli_fetch_array($res2)) {
    $crn_count = (int)$row["crn_count"];
    $feedbackData[] = array(
        "label" => "Total Students",
        "y" => $crn_count
    );
}

// Query to fetch feedback given from the second database
$query3 = "SELECT COUNT(DISTINCT roll) AS roll_count FROM feeds";
$res3 = mysqli_query($link2, $query3);

if ($res3 === false) {
    die("SQL query for feedback given failed: " . mysqli_error($link2));
}

$roll_count = 0;
while ($row = mysqli_fetch_array($res3)) {
    $roll_count = (int)$row["roll_count"];
    $feedbackData[] = array(
        "label" => "Feedback Given",
        "y" => $roll_count
    );
}

// Calculate percentages for feedback data
$total_count = $crn_count + $roll_count;
foreach ($feedbackData as &$dataPoint) {
    $dataPoint["y"] = ($dataPoint["y"] / $total_count) * 100;
}

// Fetch comments from the feedback database
$comments = array();
$query4 = "SELECT c.comment, c.faculty_id, f.name AS faculty_name, f.s1, f.s2, f.s3, f.s4, f.s5 
           FROM comments c 
           JOIN faculty f ON c.faculty_id = f.faculty_id";
$res4 = mysqli_query($link2, $query4);

if ($res4 === false) {
    die("SQL query for comments failed: " . mysqli_error($link2));
}

while ($row = mysqli_fetch_array($res4)) {
    $comments[] = array(
        "comment" => $row["comment"],
        "faculty_name" => $row["faculty_name"],
        "subjects" => array($row["s1"], $row["s2"], $row["s3"], $row["s4"], $row["s5"])
    );
}

// Store comments in session
$_SESSION['comments'] = $comments;
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Dashboard</title>
<style>
    /* General Styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .card-container {
        display: flex;
        justify-content: space-between;
        width: 90%;
        max-width: 1200px;
        gap: 20px; /* Space between cards */
    }

    .card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        flex: 1; /* Equal width for both cards */
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    #chartContainer1, #chartContainer2 {
        height: 370px;
        width: 100%;
    }

    .chart-title {
        font-size: 1.5em;
        color: #444;
        text-align: center;
        margin-bottom: 10px;
    }

    .chart-subtitle {
        font-size: 1em;
        color: #666;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Comments Section Styling */
    .comments-section {
        margin-top: 40px;
        width: 90%;
        max-width: 1200px;
    }

    .comments-title {
        font-size: 1.5em;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .comment-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .comment-card h3 {
        margin: 0;
        color: #2575fc;
    }

    .comment-card p {
        margin: 10px 0 0;
        color: #555;
    }

    /* Button Styling */
    input[type="button"] {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 1em;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        outline: none;
        margin-top: 20px;
    }

    input[type="button"]:hover {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    input[type="button"]:active {
        transform: translateY(0);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    input[type="button"]:focus {
        box-shadow: 0 0 0 3px rgba(37, 117, 252, 0.5);
    }

    @media (max-width: 768px) {
        input[type="button"] {
            padding: 10px 20px;
            font-size: 0.9em;
        }
    }

    @media (max-width: 480px) {
        input[type="button"] {
            padding: 8px 16px;
            font-size: 0.8em;
        }
    }
</style>
<script>
window.onload = function() {
    // Chart 1: Faculty Ratings (Maximum Average)
    var chart1 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Faculty Ratings (Maximum Percentage)"
        },
        axisY: {
            title: "Rating"
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.##",
            dataPoints: <?php echo json_encode($facultyData, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart1.render();

    // Chart 2: Student Feedback Statistics
    var chart2 = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        title: {
            text: "Student Feedback Statistics"
        },
        subtitles: [{
            text: "Percentage of Students and Feedback Given"
        }],
        data: [{
            type: "pie",
            yValueFormatString: "#,##0.00\"%\"",
            indexLabel: "{label} ({y}%)",
            dataPoints: <?php echo json_encode($feedbackData, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart2.render();
}
</script>
</head>
<body>
    <h1>Feedback and Faculty Ratings Dashboard</h1>

    <div class="card-container">
        <div class="card">
            <div class="chart-title">Faculty Ratings (Maximum Percentage)</div>
            <div id="chartContainer1"></div>
        </div>

        <div class="card">
            <div class="chart-title">Student Feedback Statistics</div>
            <div class="chart-subtitle">Percentage of Students and Feedback Given</div>
            <div id="chartContainer2"></div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="comments-section">
        <div class="comments-title">Feedback Comments</div>
        <?php
        if (!empty($_SESSION['comments'])) {
            foreach ($_SESSION['comments'] as $comment) {
                echo "<div class='comment-card'>";
                echo "<h3>Faculty: " . $comment['faculty_name'] . "</h3>";
                echo "<p>Subjects: " . implode(", ", array_filter($comment['subjects'])) . "</p>";
                echo "<p>Comment: " . $comment['comment'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No comments found.</p>";
        }
        ?>
    </div>

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <input type="button" onClick="window.location='home.php'" value="BACK">
</body>
</html>