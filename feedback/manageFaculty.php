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
    $fc=$_POST['fc'];
    $sub1=$_POST['sub1'];
    $sub2=$_POST['sub2'];
    $sub3=$_POST['sub3'];
    $sub4=$_POST['sub4'];
    $sub5=$_POST['sub5'];
    $faculty_id = uniqid();
    $u=mysqli_query($al,"insert into faculty(faculty_id,name,s1,s2,s3,s4,s5) values('$faculty_id','$fc','$sub1','$sub2','$sub3','$sub4','$sub5')");
    if($u==true)
    {
        ?>
        <script type="application/javascript">
        alert('Successfully added');
        </script>
        <?php
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student Feedback System</title>
<style>
    
     /* General Body Styling */
     body {
        margin: 0;
        padding: 20px;
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        min-height: 100vh;
        overflow-y: auto;
        animation: fadeIn 1.5s ease-in-out;
    }

    /* Top Header Styling */
    #topHeader {
        text-align: center;
        font-size: 5vw;
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
        max-width: 90%;
        margin: 20px auto;
        animation: slideInUp 1s ease-in-out;
        overflow-x: auto;
    }

    /* SubHead Styling */
    .SubHead {
        font-size: 1.5em;
        color: #2c3e50;
        font-weight: bold;
        text-align: center;
        margin: 15px 0;
        animation: fadeIn 1.5s ease-in-out;
    }

    /* Responsive Table Container */
    .table-container {
        overflow-x: auto;
        width: 100%;
        margin: 20px 0;
    }

    /* Form Styling */
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    /* Table Styling */
    #table {
        display: table;
        width: 100%;
        min-width: 500px;
    }

    .tr {
        display: table-row;
    }

    .td {
        display: table-cell;
        padding: 10px;
        min-width: 150px;
    }

    /* Responsive Table Cells */
    @media (max-width: 768px) {
        .td {
            padding: 8px;
            min-width: 120px;
        }
    }

    /* Button Styling */
    input[type="submit"], input[type="button"] {
        background: #3498db;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        transition: all 0.3s ease;
        margin: 10px 0;
        width: auto;
    }

    /* Responsive Input Fields */
    .td input[type="text"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    @media (max-width: 768px) {
        #topHeader {
            font-size: 2em;
        }
        
        #content {
            padding: 15px;
            max-width: 95%;
        }
        
        .SubHead {
            font-size: 1.2em;
        }
        
        input[type="submit"], input[type="button"] {
            padding: 10px 20px;
            font-size: 0.9em;
        }
    }

    @media (max-width: 480px) {
        .td {
            display: block;
            width: 100%;
            box-sizing: border-box;
        }
        
        .tr {
            display: block;
            margin-bottom: 15px;
        }
        
        #table {
            min-width: unset;
        }
        
        .td input[type="text"] {
            width: 100%;
        }
    }

    /* Scrollbar Styling */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
</head>

<body>
<div id="topHeader">
    Faculty Feedback System<br />
    <span class="tag"></span>
</div>
<br>
<br>
<br>
<br>

<div id="content" align="center">
    <br>
    <br>
    <span class="SubHead">Add Faculty</span>
    <br>
    <br>
    <form method="post" action="">
        <div id="table">
            <div class="tr">
                <div class="td">
                    <label>Faculty : </label>
                </div>
                <div class="td">
                    <input type="text" name="fc" size="25" required placeholder="Enter Faculty Name" />
                </div>
            </div>
            <div class="tr">
                <div class="td">
                    <label>Subject I : </label>
                </div>
                <div class="td">
                    <input type="text" name="sub1" size="25" required placeholder="Enter Subject I" />
                </div>
            </div>
            <div class="tr">
                <div class="td">
                    <label>Subject II : </label>
                </div>
                <div class="td">
                    <input type="text" name="sub2" size="25" required placeholder="Enter Subject II" />
                </div>
            </div>
            <div class="tr">
                <div class="td">
                    <label>Subject III : </label>
                </div>
                <div class="td">
                    <input type="text" name="sub3" size="25"  placeholder="Enter Subject III" />
                </div>
            </div>
            <div class="tr">
                <div class="td">
                    <label>Subject IV : </label>
                </div>
                <div class="td">
                    <input type="text" name="sub4" size="25"  placeholder="Enter Subject IV" />
                </div>
            </div>
            <div class="tr">
                <div class="td">
                    <label>Subject V : </label>
                </div>
                <div class="td">
                    <input type="text" name="sub5" size="25"  placeholder="Enter Subject V" />
                </div>
            </div>
        </div>
        <div class="tdd">
            <input type="submit" value="ADD FACULTY" />
        </div>
    </form>
    <br>
    <br>
    <span class="SubHead">Manage Faculty</span>
    <br>
    <br>
    <table border="0" cellpadding="3" cellspacing="3">
        <tr style="font-weight:bold;">
            <td>Sr. No.</td>
            <td>Name</td>
            <td>Subject I</td>
            <td>Subject II</td>
            <td>Subject III</td>
            <td>Subject IV</td>
            <td>Subject V</td>
            <td>Delete</td>
        </tr>
        <?php
        $sr=1;
        $h=mysqli_query($al,"select * from faculty");
        while($j=mysqli_fetch_array($h))
        {
            ?>
            <tr>
                <td><?php echo $sr;$sr++;?></td>
                <td><?php echo $j['name'];?></td>
                <td><?php echo $j['s1'];?></td>
                <td><?php echo $j['s2'];?></td>
                <td><?php echo $j['s3'];?></td>
                <td><?php echo $j['s4'];?></td>
                <td><?php echo $j['s5'];?></td>
                <td align="center"><a href="delete.php?del=<?php echo $j['id'];?>" onClick="return confirm('Are you sure?')" style="text-decoration:none;font-size:18px;color:rgba(255,0,4,1.00);">[x]</a></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <input type="button" onClick="window.location='home.php'" value="BACK">
    <br>
    <br>
</div>
</body>
</html>