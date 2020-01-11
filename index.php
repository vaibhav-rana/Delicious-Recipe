<?php
	session_start();
	require_once("connection.php");
	extract($_REQUEST);
	if(isset($signup))
	{
		if($password==$retype)
		{
			if($_SESSION['cc']==$captcha)
			{
				mysql_query("insert into signup set name='".$name."',password='".md5($password)."',email='".$email."',mobile='".$mobileno."'");
				mysql_query("insert into login set email='".$email."',password='".md5($password)."'");
				echo '<script language="javascript">';
				echo 'alert("SUCCESSFULLY SIGNUP")';
				echo '</script>';			
			}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("Captcha Not Match")';
				echo '</script>';			
			
			}
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Password Not Match")';
			echo '</script>';
		}
	}
	if(isset($_COOKIE["email"]) && isset($_COOKIE["password"]))
	{
			$ce=$_COOKIE["email"];
			$cp=$_COOKIE["password"];
	}
	if(isset($signin))
	{
		if($_SESSION['cc']==$cap)
		{
			$q=mysql_query("select * from login where email='".$email1."'");
			$a=mysql_fetch_array($q);
			if($email1==$a[1] && md5($password1)==$a[2])
			{
				if(isset($me))
				{
					setcookie("email",$email1,time()+1*24*60*60);
					setcookie("password",$password1,time()+1*24*60*60);					
				}
				$q1=mysql_query("select * from signup where email='".$email1."'");
				$a1=mysql_fetch_array($q1);
				$_SESSION['name']=$a1['name'];
				$_SESSION['email']=$email1;
				$_SESSION['mobile']=$a1['mobile'];								
				header("location:user/index.php	");
				exit();
			}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("Invalid email & password")';
				echo '</script>';
			}
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Captcha Not Match")';
			echo '</script>';
		}
	}
	if(isset($feedback))
	{
		mysql_query("insert into feedback set name='".$name2."',email='".$email2."',mobile='".$mobile2."',message='".$message."'");
		echo '<script language="javascript">';
		echo 'alert("Thanks for giving feedback..☻☻☻")';
		echo '</script>';
	}
	$l=$_GET['logout'];
	if(!empty($l))
	{
		session_unset();
	}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <title>Delicious Recipes</title>
    <link rel="stylesheet" type="text/css" href="Vendors/css/Grid.css">
    <link rel="stylesheet" type="text/css" href="Vendors/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="Vendors/css/ionicons.css">
    <link rel="stylesheet" type="text/css" href="Resourcs/css/style.css">
    <link rel="stylesheet" type="text/css" href="Vendors/css/aos.css"> 
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="row" data-aos="fade-down">
                <img src="Resourcs/img/logo.png" alt="logo" class="logo">
                <ul class="main-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#paneer-recipes">Recipes</a></li>
                    <li><a href="#" id="button1">Sign In</a></li>
                    <li><a href="#" id="button2">Sign up</a></li>
                </ul>
            </div>
        </nav>
        <div class="header-text row">
            <h1 data-aos="zoom-in-down">Delicious Recipes</h1>
            <a data-aos="fade-up" class="btn btn-full" href="#best-recipes">Check our recipes</a>
        </div>
    </header>
    <!--Modal section for signin-->
    <div class="bg-modal">
        <div class="modal-content">
            <div class="close">+</div>
            <h3>SignIn Here</h3>
            <form action="#" method="post">
                <input type="email" name="email1" placeholder="Email" autocomplete="off" value="<?php echo $ce?>">
                <input type="password" name="password1" placeholder="Password" autocomplete="off" value="<?php echo $cp?>">
                <img src="mix_captcha.php">
                <input type="text" name="cap" placeholder="Captcha Here" autocomplete="off">
                <input type="checkbox" name="me"><p>Remember me</p>
                <a href="#">Forget Password?</a>
                <input type="submit" name="signin" value="SignIn">
            </form>
        </div>
    </div>
    <!---->
    <!--Modal section for signup-->
    <div class="bg-modal1">
        <div class="modal-content1">
            <div class="close1">+</div>
            <h3>SignUp Here</h3>
            <form action="#" method="post">
                <input type="text" name="name" placeholder="Name" autocomplete="off" required>
                <input type="email" name="email" placeholder="E-mail" autocomplete="off" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="retype" placeholder="Re-Type Password" required>
                <input type="text" name="mobileno" placeholder="Mobile no." autocomplete="off" required maxlength="10">
                <img src="mix_captcha.php">
                <input type="text" name="captcha" placeholder="Captcha Here" autocomplete="off" required>
                <input type="submit" name="signup" value="SignUp">
            </form>
        </div>
    </div>
    <!---->
    <section class="best-recipe" id="best-recipes">
        <div class="row">
            <h2 data-aos="zoom-in">Our <span>Special</span> Recipes</h2>
        </div>
        <div class="row">
            <div class="col span-1-of-3">
                <div class="best-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/kaju-masala-recipe-1.jpg" alt="Kaju Curry">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Kaju Curry" target="_blank">Kaju Curry</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-3">
                <div class="best-img">
                    <img data-aos="zoom-out" src="Resourcs/img/shahi-paneer-recipe.jpg" alt="Shahi Paneer">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Shahi Paneer" target="_blank">Shahi Paneer</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-3">
                <div class="best-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/malai-kofta.jpg" alt="Malai Kofta">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Malai Kofta" target="_blank">Malai Kofta</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="paneer-recipe" id="paneer-recipes">
        <div class="row">
            <h2 data-aos="zoom-in">Paneer Recipes</h2>
        </div>
        <div class="row">
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/paneer_recipe/khoya-paneer.jpg" alt="Khoya Paneer">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Khoya Paneer" target="_blank">Khoya Paneer</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="fade-left" src="Resourcs/img/paneer_recipe/kadai-paneer.jpg" alt="Kadai Paneer">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Kadai Paneer" target="_blank">Kadai Paneer</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="fade-right" src="Resourcs/img/paneer_recipe/shahi-paneer-recipe.jpg" alt="Shahi Paneer">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Shahi Paneer" target="_blank">Shahi Paneer</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/paneer_recipe/handi-paneer.jpg" alt="Handi Paneer">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Handi Paneer" target="_blank">Handi Paneer</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/paneer_recipe/matar-paneer.jpg" alt="Matar Paneer">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Matar Paneer" target="_blank">Matar Paneer</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="fade-left" src="Resourcs/img/paneer_recipe/Oven-Paneer-Tikka.jpg" alt="Oven Paneer Tikka">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Oven Paneer Tikka" target="_blank">Paneer Tikka</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="fade-right" src="Resourcs/img/paneer_recipe/paneer-bhurji.jpg" alt="Paneer Bhurji">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Paneer Bhurji" target="_blank">Paneer Bhurji</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/paneer_recipe/paneer-butter-masala.jpg" alt="Paneer Butter Masala">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Paneer Butter Masala" target="_blank">Paneer Butter</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/paneer_recipe/Chana_Masala_with_Paneer.jpg" alt="Chana Masala">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Chana Masala" target="_blank">Chana Masala</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="fade-left" src="Resourcs/img/paneer_recipe/malai-kofta.jpg" alt="Malai Kofta">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Malai Kofta" target="_blank">Malai Kofta</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="fade-right" src="Resourcs/img/paneer_recipe/paneer-kolhapuri.jpg" alt="Paneer Kolhapuri">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Paneer Kolahapuri" target="_blank">Kolhapuri</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/paneer_recipe/paneer-korma.jpg" alt="Paneer Korma">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Paneer korma" target="_blank">Paneer Korma</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/paneer_recipe/paneer-makhani-recipe.jpg" alt="Paneer Makhani">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Paneer Makhani" target="_blank">Makhani</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="fade-left" src="Resourcs/img/paneer_recipe/paneer-tikka-pizza.jpg" alt="Paneer Pizza">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Paneer Tikka Pizza" target="_blank">paneer Pizza</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="fade-right" src="Resourcs/img/paneer_recipe/paneer-tikka.jpg" alt="Paneer Tikka">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Paneer Tikka" target="_blank">Paneer Tikka</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="paneer-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/paneer_recipe/panner-curry.jpg" alt="Paneer Curry">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Paneer Curry" target="_blank">Paneer Curry</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="gujrati-recipe" id="guj-recipes">
        <div class="row">
            <h2 data-aos="zoom-in">Gujarati Recipes</h2>
        </div>
        <div class="row">
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/gujrati_dishes/khamman.jpg" alt="Khamman">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Khamman" target="_blank">Khamman</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="fade-left" src="Resourcs/img/gujrati_dishes/fafda.jpg" alt="Fafda">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Fafda" target="_blank">Fafda</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="fade-right" src="Resourcs/img/gujrati_dishes/dabeli.jpg" alt="Dabeli">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Dabeli" target="_blank">Dabeli</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/gujrati_dishes/handvo.jpg" alt="Handvo">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Handvo" target="_blank">Handvo</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/gujrati_dishes/dal_dhokli.jpg" alt="Dal Dhokli">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Dal Dhokli" target="_blank">Dal Dhokli</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="fade-left" src="Resourcs/img/gujrati_dishes/khandvi.jpg" alt="Khandvi">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Khandvi" target="_blank">Khandvi</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="fade-right" src="Resourcs/img/gujrati_dishes/patra.jpg" alt="Patra">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Patra" target="_blank">Patra</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/gujrati_dishes/muthiya.jpg" alt="Muthiya">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Muthiya" target="_blank">Muthiya</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/gujrati_dishes/sev_khamni.jpeg" alt="Sev Khamni">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Sev Khamni" target="_blank">Sev Khamni</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="fade-left" src="Resourcs/img/gujrati_dishes/sev_tometa_nu_shaak.jpg" alt="Sev Tometa">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Sev Tometa" target="_blank">Sev Tometa</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="fade-right" src="Resourcs/img/gujrati_dishes/thepla.jpg" alt="Thepla">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Thepla" target="_blank">Thepla</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="guj-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/gujrati_dishes/undhiyu.jpg" alt="Undhiyu">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Undhiyu" target="_blank">Undhiyu</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="rajasthani-recipe" id="raj-recipes">
        <div class="row">
            <h2 data-aos="zoom-in">Rajasthani Recipes</h2>
        </div> 
        <div class="row">
            <div class="col span-1-of-4">
                <div class="raj-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/rajasthani_dishes/dal_bati_churma.jpg" alt="Dal Bati Churma">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Dal Bati" target="_blank">Dal Bati</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="raj-img">
                    <img data-aos="fade-left" src="Resourcs/img/rajasthani_dishes/gatte_ki_khichdi.jpg" alt="Gatte Ki Khichdi">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Gatte Khichdi" target="_blank">Gatte Khichdi</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="raj-img">
                    <img data-aos="fade-right" src="Resourcs/img/rajasthani_dishes/shahi_gatte.jpg" alt="Shahi Gatte">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Shahi Gatte" target="_blank">Shahi Gatte</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="raj-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/rajasthani_dishes/rajasthani_kadi.jpg" alt="Rajasthani Kadhi">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Kadhi" target="_blank">Kadhi</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col span-1-of-4">
                <div class="raj-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/rajasthani_dishes/bajri_methi_dhebra.jpg" alt="Methi Bajra Poori">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Methi Puri" target="_blank">Methi Puri</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="raj-img">
                    <img data-aos="fade-left" src="Resourcs/img/rajasthani_dishes/bundi_raita.jpg" alt="Bundi Raita">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Boondi Raita" target="_blank">Boondi Raita</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="raj-img">
                    <img data-aos="fade-right" src="Resourcs/img/rajasthani_dishes/ghevar.jpg" alt="Ghevar">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Ghaver" target="_blank">Ghevar</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="raj-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/rajasthani_dishes/gujia.jpg" alt="Gujia">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Gujiya" target="_blank">Gujiya</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="marathi-recipe" id="mar-recipes">
        <div class="row">
            <h2 data-aos="zoom-in">Marathi Recipes</h2>
        </div>
        <div class="row">
            <div class="col span-1-of-4">
                <div class="marathi-img">
                    <img data-aos="zoom-in-right" src="Resourcs/img/marathi_dishes/pav_bhaji.jpg" alt="Pav Bhaji">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Pav Bhaji" target="_blank">Pav Bhaji</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="marathi-img">
                    <img data-aos="fade-left" src="Resourcs/img/marathi_dishes/puran_poli.jpg" alt="Puran Poli">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Puran Poli" target="_blank">Puran Poli</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="marathi-img">
                    <img data-aos="fade-right" src="Resourcs/img/marathi_dishes/misal_pav.jpg" alt="Misal Pav">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Misal Pav" target="_blank">Misal Pav</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-4">
                <div class="marathi-img">
                    <img data-aos="zoom-in-left" src="Resourcs/img/marathi_dishes/vada_pav.jpg" alt="Vada Pav">
                    <div class="overlay-text">
                        <div class="title">
                            <h3><a href="open/index.php?name=Vada Pav" target="_blank">Vada Pav</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="customer">
            <div class="row">
                <h2 data-aos="zoom-in">Our Customers Love</h2>
            </div>
            <div class="row">
                <div class="col span-1-of-3">
                    <blockquote data-aos="flip-up">
                        This website is so good for indian food recipes. here food recipe is so easy, i always prefer this website for delicious recipe, and also making a food process is easy.
                        <cite><img src="Resourcs/img/customer_1.jpg">Avneet Kaur</cite>
                    </blockquote>
                </div>
                <div class="col span-1-of-3">
                    <blockquote data-aos="flip-up">
                        I love gujarati food. this website give me best recipe to make famous gujarati food in just few minutes. I love this website. i share this website to all my friends for delicious recipes.
                        <cite><img src="Resourcs/img/customer_2.jpg">Arishfa Khan</cite>
                    </blockquote>
                </div>
                <div class="col span-1-of-3">
                    <blockquote data-aos="flip-up">
                        I always try new recipe from this website. and this website give me best recipe to make tasty food for my friends. i always use this website for paneer recipe and rajasthani dishes recipe.    
                        <cite><img src="Resourcs/img/customer_3.jpg">Anushka Sen</cite>
                    </blockquote>
                </div>
            </div>
    </section>
    <section class="chef">
        <div class="row">
            <h2 data-aos="zoom-in">Meet Our Qualified Chefs</h2>
        </div>
        <div class="row">
            <div class="col span-1-of-3 chef-img">
                <img data-aos="zoom-in-down" src="Resourcs/img/chef_1.jpg">
                <div class="overlay-text">
                    <div class="title">
                        <div class="chef-soical">
                            <a href="https://www.facebook.com/ChefSanjeevKapoor/" target="_blank"><i class="ion-social-facebook"></i></a>
                            <a href="https://twitter.com/SanjeevKapoor?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank"><i class="ion-social-twitter"></i></a>
                            <a href="https://www.instagram.com/sanjeevkapoor/?hl=en" target="_blank"><i class="ion-social-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-3 chef-img">
                <img data-aos="zoom-in-down" src="Resourcs/img/chef_2.jpg">
                <div class="overlay-text">
                    <div class="title">
                        <div class="chef-soical">
                            <a href="https://www.facebook.com/VikasKhannaGroup/" target="_blank"><i class="ion-social-facebook"></i></a>
                            <a href="https://twitter.com/TheVikasKhanna?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank"><i class="ion-social-twitter"></i></a>
                            <a href="https://www.instagram.com/vikaskhannagroup/?hl=en" target="_blank"><i class="ion-social-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col span-1-of-3 chef-img">
                <img data-aos="zoom-in-down" src="Resourcs/img/chef_3.jpg">
                <div class="overlay-text">
                    <div class="title">
                        <div class="chef-soical">
                            <a href="https://www.facebook.com/amritaraichand/" target="_blank"><i class="ion-social-facebook"></i></a>
                            <a href="https://twitter.com/amritaraichand?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank"><i class="ion-social-twitter"></i></a>
                            <a href="https://www.instagram.com/amritaraichand/?hl=en" target="_blank"><i class="ion-social-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="feedback">
        <div class="row">
            <h2 data-aos="zoom-in">Improve Our Performance</h2>
        </div>
        <div class="row" data-aos="zoom-in">
            <form action="#" method="post" class="feedback_form">
                <div class="row">
                    <input type="text" name="name2" id="name" placeholder="Name" required autocomplete="off">
                </div>
                <div class="row">
                    <input type="email" name="email2" id="email" placeholder="Email" required autocomplete="off">
                </div>
                <div class="row">
                    <input type="text" name="mobile2" id="name" placeholder="Mobile no." required autocomplete="off" maxlength="10">
                </div>
                <div class="row">
                    <textarea name="message" placeholder="Your Message" required></textarea>
                </div>
                <div class="row">
                    <input type="submit" name="feedback" value="Send It">
                </div>
            </form> 
        </div>
    </section>
    <footer>
        <div class="row">
            <ul>
                <li><a href="#best-recipes">Best Recipes</a></li>
                <li class="white">|</li>
                <li><a href="#paneer-recipes">Paneer Recipes</a></li>
                <li class="white">|</li>
                <li><a href="#guj-recipes">Gujarati Recipes</a></li>
                <li class="white">|</li>
                <li><a href="#raj-recipes">Rajasthani Recipes</a></li>
                <li class="white">|</li>
                <li><a href="#mar-recipes">Marathi Recipes</a></li>
            </ul>
        </div>
        <div class="social-links">
                <a href="https://www.facebook.com/vaibhav.rana.58958" target="_blank"><i class="ion-social-facebook"></i></a>
                <a href="https://www.instagram.com/_vaibhavrana/" target="_blank"><i class="ion-social-instagram"></i></a>
                <a href="https://twitter.com/_VaibhavRana" target="_blank"><i class="ion-social-twitter"></i></a>
                <a href="https://in.pinterest.com/ranavaibhav1999/" target="_blank"><i class="ion-social-pinterest"></i></a>
                <a href="https://www.linkedin.com/in/vaibhav1999/" target="_blank"><i class="ion-social-linkedin"></i></a>
        </div>
        <div class="row">
            <p>&copy;2019 Delicious Recipes All Rights Reserved</p>
            <p>Desiged by Vaibhav Rana</p>
        </div>
    </footer>
    <script type="text/javascript">
        document.getElementById('button1').addEventListener('click',
            function(){
                document.querySelector('.bg-modal').style.display='flex';
        });
        document.querySelector('.close').addEventListener('click',
            function(){
                document.querySelector('.bg-modal').style.display='none';
        });
        document.getElementById('button2').addEventListener('click',
            function(){
                document.querySelector('.bg-modal1').style.display='flex';
        });
        document.querySelector('.close1').addEventListener('click',
            function(){
                document.querySelector('.bg-modal1').style.display='none';
        });
    </script>
    <script src="Vendors/js/aos.js"></script>
    <script type="text/javascript">
         AOS.init({
             offset:200,
             duration:2000,
         });
    </script>
</body>
</html>