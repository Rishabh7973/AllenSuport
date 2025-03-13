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
// PHP code to fetch data from the database
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "feedback"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from faculty and feeds tables
$sql = "
    SELECT 
        f.faculty_id, 
        f.name, 
        f.s1, 
        f.s2, 
        f.s3, 
        f.s4, 
        f.s5, 
        AVG(fd.Avg) AS Avg, 
        AVG(fd.Percent) AS percent 
    FROM 
        faculty f 
    LEFT JOIN 
        feeds fd 
    ON 
        f.faculty_id = fd.faculty_id 
    GROUP BY 
        f.faculty_id 
    ORDER BY 
        Avg DESC
";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error executing query: " . $conn->error); // Display the SQL error
}

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Filter out null values for subjects
        $subjects = array_filter([$row['s1'], $row['s2'], $row['s3'], $row['s4'], $row['s5']], function ($value) {
            return !is_null($value) && $value !== '';
        });
        $row['subjects'] = implode(", ", $subjects); // Combine non-null subjects into a single string
        $data[] = $row;
    }
} else {
    echo "No data found in the faculty table."; // Display a message if no data is found
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Reports</title>
    <style>
        /* Modern CSS for styling the page */
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f4f7f6;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        /* Highlighting based on Avg */
        .highlight-green {
            background-color: #87c796; /* Green for Avg 4-5 */
        }

        .highlight-yellow {
            background-color: #eadba8; /* Yellow for Avg 3-4 */
        }

        .highlight-red {
            background-color: #e48c91; /* Red for Avg below 3 */
        }

        /* Subject list styling */
        .subject-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .subject-list li {
            padding: 5px 0;
        }

        
        /* Print-specific styles */
        @media print {
            body {
                background-color: white;
                color: black;
            }

            .print-button {
                display: none;
            }

            table {
                box-shadow: none;
                border: 1px solid #000;
            }

            th {
                background-color: #3498db !important;
                color: white !important;
            }

            .highlight-green, .highlight-yellow, .highlight-red {
                background-color: transparent !important;
            }
        }
            /* Button Container Styling */
.button-container {
    display: flex;
    justify-content: center;
    gap: 20px; /* Space between buttons */
    margin-top: 30px;
    margin-bottom: 20px;
}

/* Common Button Styling */
.button-container a, .button-container input[type="button"] {
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
    text-decoration: none;
    text-align: center;
}

/* Hover Effect */
.button-container a:hover, .button-container input[type="button"]:hover {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.3);
    transform: translateY(-2px);
}

/* Active Effect */
.button-container a:active, .button-container input[type="button"]:active {
    transform: translateY(0);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

/* Focus Effect */
.button-container a:focus, .button-container input[type="button"]:focus {
    box-shadow: 0 0 0 3px rgba(37, 117, 252, 0.5);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .button-container {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .button-container a, .button-container input[type="button"] {
        width: 80%;
        padding: 10px 20px;
        font-size: 0.9em;
    }
}

@media (max-width: 480px) {
    .button-container a, .button-container input[type="button"] {
        padding: 8px 16px;
        font-size: 0.8em;
    }
}
    </style>
</head>
<body>
    <h1>Faculty Reports</h1>
    <table id="facultyTable">
        <thead>
            <tr>
                <th>Faculty ID</th>
                <th>Name</th>
                <th>Subjects</th>
                <th>Subject-wise Details</th>
                <th>Percentage</th>
                <th>Average Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) {
                foreach ($data as $row) {
                    // Determine the highlight class based on Avg
                    $highlightClass = '';
                    if ($row['Avg'] >= 4) {
                        $highlightClass = 'highlight-green'; // Green for Avg 4-5
                    } elseif ($row['Avg'] >= 2) {
                        $highlightClass = 'highlight-yellow'; // Yellow for Avg 3-4
                    } else {
                        $highlightClass = 'highlight-red'; // Red for Avg below 2
                    }

                    echo "<tr class='{$highlightClass}'>
                            <td>{$row['faculty_id']}</td>
                            <td>{$row['name']}</td>
                            <td>
                                <ul class='subject-list'>";
                    // List all subjects in a structured manner
                    foreach (['s1', 's2', 's3', 's4', 's5'] as $subject) {
                        $subjectName = $row[$subject];
                        if (!empty($subjectName)) {
                            echo "<li>{$subjectName}</li>";
                        }
                    }
                    echo "</ul>
                            </td>
                            <td>";

                    // Fetch subject-wise averages
                    $facultyId = (int)$row['faculty_id']; // Ensure faculty_id is an integer
                    $subjectSql = "
                        SELECT 
                            subject, 
                            AVG(Avg) AS subject_avg 
                        FROM 
                            feeds 
                        WHERE 
                            faculty_id = {$facultyId} 
                        GROUP BY 
                            subject
                    ";
                    $subjectResult = $conn->query($subjectSql);

                    // Check if the query was successful
                    if ($subjectResult === false) {
                        echo "<div>Error fetching subject details: " . $conn->error . "</div>";
                    } else {
                        $subjectAverages = [];
                        if ($subjectResult->num_rows > 0) {
                            while ($subjectRow = $subjectResult->fetch_assoc()) {
                                $subjectAverages[$subjectRow['subject']] = $subjectRow['subject_avg'];
                            }
                        }

                        echo "<ul class='subject-list'>";
                        // List all subjects with their averages
                        foreach (['s1', 's2', 's3', 's4', 's5'] as $subject) {
                            $subjectName = $row[$subject];
                            if (!empty($subjectName)) {
                                $avg = $subjectAverages[$subjectName] ?? 0;
                                echo "<li>{$subjectName}: Avg: " . number_format($avg, 2) . " | Percentage: " . number_format($avg * 20, 2) . "%</li>";
                            }
                        }
                        echo "</ul>";
                    }

                    echo "</td>
                            <td>" . number_format($row['percent'], 2) . "%</td>
                            <td>" . number_format($row['Avg'], 2) . "</td>
                          </tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Button Container -->
<div class="button-container">
    <a href="javascript:window.print()" class="print-button">Print Report</a>
    <input type="button" onClick="window.location='home.php'" value="BACK">
</div>
</body>
</html>

<?php
// Close the database connection after all operations are done
$conn->close();
?>