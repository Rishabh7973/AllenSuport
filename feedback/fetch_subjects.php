<?php
include("configASL.php");

if (isset($_GET['faculty_id'])) {
    $faculty_id = $_GET['faculty_id'];

    // Fetch subjects for the selected faculty
    $query = mysqli_query($al, "SELECT s1, s2, s3, s4, s5 FROM faculty WHERE faculty_id='$faculty_id'");
    $row = mysqli_fetch_array($query);

    // Generate options for non-null subjects
    $options = "<option value='NA' disabled selected> - - Select Subject - -</option>";
    if (!empty($row['s1'])) {
        $options .= "<option value='" . $row['s1'] . "'>" . $row['s1'] . "</option>";
    }
    if (!empty($row['s2'])) {
        $options .= "<option value='" . $row['s2'] . "'>" . $row['s2'] . "</option>";
    }
    if (!empty($row['s3'])) {
        $options .= "<option value='" . $row['s3'] . "'>" . $row['s3'] . "</option>";
    }
    if (!empty($row['s4'])) {
        $options .= "<option value='" . $row['s4'] . "'>" . $row['s4'] . "</option>";
    }
    if (!empty($row['s5'])) {
        $options .= "<option value='" . $row['s5'] . "'>" . $row['s5'] . "</option>";
    }

    echo $options;
}
?>