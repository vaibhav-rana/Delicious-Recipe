<?php
	session_start();
	require_once("../connection.php");
	extract($_REQUEST);
	if($_SESSION['name']=='')
	{
		header("location:..//index.php");
		exit();
	}
	if(isset($update))
	{
		$q=mysql_query("select * from login where email='".$_SESSION['email']."'");
		$a=mysql_fetch_array($q);
	 	if(md5($old)==$a['password'])
		{
			if($new==$confirm)
			{
				mysql_query("update signup set password='".md5($new)."' where email='".$_SESSION['email']."'");
				mysql_query("update login set password='".md5($new)."' where email='".$_SESSION['email']."'");
				echo '<script language="javascript">';
				echo 'alert("Password Successfully Updated")';
				echo '</script>';				
			}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("Confirm password not match")';
				echo '</script>';
			}
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Old Password Not Match")';
			echo '</script>';
		}
	}
	$name1=$_FILES['file']['name'];
	$size1=$_FILES['file']['size'];
	$type1=$_FILES['file']['type'];
	if(!is_dir("../user_recipe"))
	{
		mkdir("../user_recipe");
	}
	if(isset($upload))
	{
		if($type1=='application/pdf' || $type1=='application/vnd.openxmlformats-officedocument.presentationml.presentation' || $type1=='application/vnd.openxmlformats-officedocument.wordprocessingml.document' || $type1=='text/plain')
		{
			$path="../user_recipe/".$name1;
			mysql_query("insert into user_recipe set name='".$name1."',type='".$type1."',path='".$path."'");
			move_uploaded_file($_FILES['file']['tmp_name'],$path);
			echo '<script language="javascript">';
			echo 'alert("Successfully Uploaded")';
			echo '</script>';
		
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Only Pdf, Word file, Text Are Uploaded.")';
			echo '</script>';
		}
	}
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <title>Delicious Recipes</title>
    <link rel="stylesheet" type="text/css" href="vendors/css/Grid.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/ionicons.css">
    <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="resource/css/style_user.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="row" data-aos="fade-down">
                <img src="resource/img/logo.png" alt="logo" class="logo">
                <h3>Delicious Recipes</h3>
            </div>
        </nav>
    </header>
    <section>
        <div class="row">
            <h2>Welcome <?php echo $_SESSION['name']?></h2>
        </div>
        <div class="row">
            <div class="col span-1-of-4 box">
                <a href="#" id="button1"><i class="ion-person"></i><br>Profile</a>
            </div>
            <div class="col span-1-of-4 box">
                <a href="#" id="button2"><i class="ion-android-upload"></i><br>Upload Recipe</a>
            </div>
            <div class="col span-1-of-4 box">
                <a href="#" id="button3"><i class="ion-edit"></i><br>Change Password</a>
            </div>
            <div class="col span-1-of-4 box">
                <a href="../index.php?logout=Successfully"><i class="ion-log-out"></i><br>Log Out</a>
            </div>
        </div>
    </section>
    <!--modal for Profile-->
     <div class="bg-modal1">
        <div class="modal-content1">
            <div class="close1">+</div>
            <p>Name :- <?php echo $_SESSION['name']?></p>
            <p>Email :- <?php echo $_SESSION['email']?></p>
            <p>Mobile no. :- <?php echo $_SESSION['mobile']?></p>
        </div>
    </div>
    <!---->
    <!--modal for Upload-->
     <div class="bg-modal2">
        <div class="modal-content2">
            <div class="close2">+</div>
            <form action="#" method="post" enctype="multipart/form-data">
                <input type="file" name="file">
                <input type="submit" name="upload" value="Upload">
            </form>
            <p>Note :- Recipe name &amp; category mentioned in document.</p>
        </div>
    </div>
    <!---->
    <!--modal for Change password-->
     <div class="bg-modal3">
        <div class="modal-content3">
            <div class="close3">+</div>
            <form action="#" method="post">
                <input type="password" name="old" placeholder="Old Password">
                <input type="password" name="new" placeholder="New Password">
                <input type="password" name="confirm" placeholder="Confirm Password">
                <input type="submit" name="update" value="Update">
            </form>
        </div>
    </div>
    <!---->
    <script type="text/javascript">
        document.getElementById('button1').addEventListener('click',
            function(){
                document.querySelector('.bg-modal1').style.display='flex';
        });
        document.querySelector('.close1').addEventListener('click',
            function(){
                document.querySelector('.bg-modal1').style.display='none';
        });
        document.getElementById('button2').addEventListener('click',
            function(){
                document.querySelector('.bg-modal2').style.display='flex';
        });
        document.querySelector('.close2').addEventListener('click',
            function(){
                document.querySelector('.bg-modal2').style.display='none';
        });
        document.getElementById('button3').addEventListener('click',
            function(){
                document.querySelector('.bg-modal3').style.display='flex';
        });
        document.querySelector('.close3').addEventListener('click',
            function(){
                document.querySelector('.bg-modal3').style.display='none';
        });
    </script>  
</body>
</html>
