<?php
	require_once("../connection.php");
	extract($_REQUEST);
	$rn=$_GET['name'];
	$q=mysql_query("select * from recipes where name='".$rn."'");
	$a=mysql_fetch_array($q);
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <title><?php echo $a['name']?> Recipe</title>
    <link rel="stylesheet" type="text/css" href="Vendors/css/Grid.css">
    <link rel="stylesheet" type="text/css" href="Vendors/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="Vendors/css/ionicons.css">
    <link rel="stylesheet" type="text/css" href="css/style_recipe.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
</head>
<body>
    <section class="recipe-heading">
        <div class="row">
            <h1><?php echo $a['name']?> Recipe</h1>
        </div>
    </section>
    <section class="recipe-img clearfix">
        <div class="row">
            <div class="col span-1-of-2 ">
                <?php echo $a['img']?>
                <div class="video_link">
                    <a href="#" id="button1">
                        Watch video  <i class="ion-play"></i>
                    </a>
                </div>
            </div>
            <div class="col span-1-of-2">
                <div class="ingredients-heading">
                    <h2>Ingredients</h2>
                </div>
                <div class="ingredients-list">
                    <?php echo $a['ingredients']?>
                </div>
            </div>
        </div>
    </section>
    <!--modal for video-->
     <div class="bg-modal">
        <div class="modal-content">
            <div class="close">+</div>
                <?php echo $a['video']?>
        </div>
    </div>
    <!---->                        
    <section class="how-to">
        <div class="row">
            <h2>How to make <?php echo $a['name']?></h2>
        </div>
        <div class="row">
            <?php echo $a['steps']?>
        </div>
    </section>
    <script type="text/javascript">
        document.getElementById('button1').addEventListener('click',
            function(){
                document.querySelector('.bg-modal').style.display='flex';
        });
        document.querySelector('.close').addEventListener('click',
            function(){
                document.querySelector('.bg-modal').style.display='none';
        });
    </script>                        
    </body>
</html>