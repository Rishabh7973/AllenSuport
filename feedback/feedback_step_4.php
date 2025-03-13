<?php
include "configASL.php";
session_start();

$sql=mysqli_query($al,"select * from feeds where roll='".mysqli_real_escape_string($al,$_POST['roll'])."' AND name='".mysqli_real_escape_string($al,$_POST['faculty'])."' AND subject='".mysqli_real_escape_string($al,$_POST['subject'])."'");

if(mysqli_num_rows($sql)>0)
{
	?>
    <script type="text/javascript">
	alert('Feedback already submitted');
	window.location='feedback_step_3.php';
	</script>
    <?php
}

if(isset($_POST['roll']))
{
	$_SESSION['roll']=$_POST['roll'];
}

if(isset($_POST['faculty_id']))
{
	$_SESSION['faculty_id']=$_POST['faculty_id'];
}

if(isset($_POST['subject']))
{
	$_SESSION['subject']=$_POST['subject'];
}
//Fetch Questions
$q = mysqli_fetch_array(mysqli_query($al, "SELECT * FROM questions WHERE id = '1'"));
$parameters = array("Poor","Fair","Good","Very Good","Excellent");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>FACULTY FEEDBACK SYSTEM</title>
<style>
    /* Professional CSS with animations */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        margin: 0;
        padding: 0;
        min-height: 100vh;
        animation: gradientBG 15s ease infinite;
    }

    @keyframes gradientBG {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
    }

    #topHeader {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        color: #ffffff;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
    }

    #content {
        background: rgba(255,255,255,0.95);
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        margin: 120px auto 40px;
        padding: 2rem;
        width: 85%;
        max-width: 700px;
        animation: formEntrance 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        transform-origin: top;
    }

    @keyframes formEntrance {
        0% {
            opacity: 0;
            transform: translateY(-50px) scale(0.95);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .tr {
        display: flex;
        justify-content: space-between;
        margin: 1rem 0;
        padding: 0.5rem;
        background: #f8f9fa;
        border-radius: 8px;
        transition: transform 0.3s ease;
    }

    .tr:hover {
        transform: translateX(10px);
    }

    .td {
        flex: 1;
        padding: 0 1rem;
    }

    input[type="text"], textarea {
        border: 2px solid #e9ecef;
        border-radius: 6px;
        padding: 0.8rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    input[type="text"]:focus, textarea:focus {
        border-color: #3498db;
        box-shadow: 0 0 8px rgba(52,152,219,0.2);
    }

    input[type="radio"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        border: 2px solid #3498db;
        border-radius: 50%;
        margin-right: 8px;
        position: relative;
        top: 4px;
        transition: all 0.3s ease;
    }

    input[type="radio"]:checked {
        background: #3498db;
        box-shadow: 0 0 8px rgba(52,152,219,0.3);
    }

    input[type="button"], input[type="submit"] {
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 1rem;
        margin: 1rem;
        transition: all 0.4s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    input[type="button"]:hover, input[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52,152,219,0.3);
    }

    .SubHead {
        color: #2c3e50;
        font-size: 1.5rem;
        margin: 1rem 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .tddd {
        margin: 1.5rem 0;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    hr {
        border: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #3498db, transparent);
        margin: 2rem 0;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    .tag {
        font-size: 0.9rem;
        color: #e9ecef;
        margin-top: 0.5rem;
        display: block;
    }
</style>
</head>

<body>
<div id="topHeader">
	FACULTY FEEDBACK SYSTEM<br />
    <span class="tag">STUDENT FEEDBACK </span>
</div>

<div id="content" align="center">
<span class="SubHead">Step III</span>
<form method="post" action="feedback_step_5.php">

<div id="table"> 
    <div class="tr">
		<div class="td">
        	<label>Roll No : </label>
        </div>
        <div class="td">
			<input type="text" disabled size="5" value="<?php echo $_SESSION['roll'];?>" />
            <input type="hidden" value="<?php echo $_SESSION['roll'];?>" name="roll" />
        </div>
    </div>
     <div class="tr">
     <div class="td">
        	<label>Faculty : </label>
        </div>
        

     <div class="td">
			<input type="text" disabled size="25" value="<?php echo $_SESSION['name'];?>" />
            <input type="hidden" value="<?php echo $_SESSION['faculty_id'];?>" name="faculty_id" />
            
        </div>
      </div>
      
      
      <div class="tr">
     <div class="td">
        	<label>Subject : </label>
        </div>
        

     <div class="td">
			<input type="text" disabled size="25" value="<?php echo $_SESSION['subject'];?>"/>
            <input type="hidden" value="<?php echo $_SESSION['subject'];?>" name="subject" />
        </div>
      </div>
      
</div>
<hr style="width:100%;">

	<?php
		for($i=1;$i<=10;$i++)
		{
			?>
            <div class="tddd">
				<span class="text"><?php echo $i;?>. <?php echo  $q['q'.$i];?> <br>
                <?php 
						for($j=1;$j<=5;$j++)
						{
							?>
                        <label><input type="radio" required value="<?php echo $j;?>" name="q<?php echo $i;?>" /><?php echo $parameters[$j-1];?>&nbsp;&nbsp;</label>
                        <?php } ?> </span>
                        				</div>
                                        	<hr style="width:100%;"> <?php } ?>
                                         <div class="tddd">
                                         <textarea name="comment" cols="40" required placeholder="Enter Comments and Suggestions"></textarea>
                                         </div>
        	<input type="button" onClick="window.location='feedback_step_3.php'" value="BACK">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="SUBMIT" onClick="return confirm('Are you sure?')" />
            <br>
<br>

        </div>
   
    <br>
</div>
</form>
<br>

</body>
</html>