<?php
include("configASL.php");
session_start();
if(isset($_SESSION['aid']))
{
	header("location:home.php");
}
if(!empty($_POST))
{
	$aid=mysqli_real_escape_string($al,$_POST['aid']);
	$pass=mysqli_real_escape_string($al,sha1($_POST['pass']));
	$sql=mysqli_query($al,"select * from admin where aid='$aid' and password='$pass'");
	if(mysqli_num_rows($sql)==1)
	{
		$_SESSION['aid']=$_POST['aid'];
		header("location:home.php");
	}
	else
	{
		?>
        <script type="text/javascript">
		alert("Incorrect Admin ID or Password");
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
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
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

    /* Content Container Styling */
    #content {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: slideInUp 1.5s ease-in-out;
		margin-left:60px;
		margin-right: 40px;
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

    /* Input Field Styling */
    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        border-color: #3498db;
        outline: none;
    }

    /* Button Styling */
    input[type="submit"] {
        background: #3498db;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    input[type="submit"]:hover {
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

    /* Link Styling */
    .link {
        color: #3498db;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .link:hover {
        color: #2980b9;
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
        <span class="tag"></span>
    </div>

    <div id="content" align="center">
        <span class="SubHead">Admin Login</span>
        <form method="post" action="">
            <div id="table">
                <div class="tr">
                    <div class="td">
                        <label>Admin ID : </label>
                    </div>
                    <div class="td">
                        <input type="text" name="aid" size="25" required />
                    </div>
                </div>
                <div class="tr">
                    <div class="td">
                        <label>Password : </label>
                    </div>
                    <div class="td">
                        <input type="password" name="pass" size="25" required />
                    </div>
                </div>
            </div>
            <div class="tdd">
                <input type="submit" value="Login" />
            </div>
        </form>
        <br>
        <center>
            <span class="SubHead" style="font-weight:100;">Student Feedback <a href="feedback.php" class="link">Click Here</a></span>
        </center>
    </div>
</body>
</html>