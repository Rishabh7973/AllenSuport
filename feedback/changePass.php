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
$old=$y['password'];

if(!empty($_POST))
{
	$p1=sha1($_POST['p1']);
	$p2=sha1($_POST['p2']);
	if($old==$p1)
	{
		$u=mysqli_query($al,"update admin set password='$p2' where aid='$aid'");
	}
	if($u==true)
	{
		?>
        <script type="application/javascript">
		alert('Successfully changed password');
		</script>
        <?php } else { ?> <script type="application/javascript">
		alert('Incorrect old password');
		</script><?php }
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
        padding: 0;
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        background-size: cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
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
    }

    /* Content Styling */
    #content {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        width: 400px;
        animation: slideInUp 1s ease-in-out;
		margin-left: 60px;
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

    /* Form Styling */
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Table Styling */
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

    .td label {
        font-weight: bold;
        color: #34495e;
    }

    .td input[type="password"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1em;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .td input[type="password"]:focus {
        border-color: #3498db;
        box-shadow: 0 0 8px rgba(52, 152, 219, 0.5);
    }

    /* Button Styling */
    input[type="submit"], input[type="button"] {
        background: #3498db;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        transition: background 0.3s ease, transform 0.3s ease;
        margin: 10px 0;
    }

    input[type="submit"]:hover, input[type="button"]:hover {
        background: #2980b9;
        transform: scale(1.05);
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
    <span class="SubHead">Change Password</span>
    <br>
    <br>
    <form method="post" action="">
        <div id="table">
            <div class="tr">
                <div class="td">
                    <label>Old Password : </label>
                </div>
                <div class="td">
                    <input type="password" name="p1" size="25" required placeholder="Enter Old Password" />
                </div>
            </div>
            <div class="tr">
                <div class="td">
                    <label>New Password : </label>
                </div>
                <div class="td">
                    <input type="password" name="p2" size="25" required placeholder="Enter New Password" />
                </div>
            </div>
        </div>
        <div class="tdd">
            <input type="submit" value="CHANGE PASSWORD" />
        </div>
        <br>
        <br>
        <input type="button" onClick="window.location='home.php'" value="BACK">
    </form>
    <br>
    <br>
</div>
</body>
</html>