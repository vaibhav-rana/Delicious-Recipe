<?php
	session_start();
	$uc1=array("A","B","C","E","F","L","H","I","K");
	$uc2=array("Z","W","X","Q","P","R","S","T","V");
	$n1=rand(1,9);
	$n2=rand(1,9);
	$sl=array("!","@","$","%","?","&");
	$text=$uc1[rand(0,8)].$n1.$lc[rand(0,8)].$sl[rand(0,5)].$n2.$uc2[rand(0,8)];
	$_SESSION['cc']=$text;
	$x=150;
	$y=45;
	$f=20;
	header("content-type:image/jpeg");
	$img=imagecreate($x,$y);
	imagecolorallocate($img,44,44,44);
	$wh=imagecolorallocate($img,255,255,255);
	imagefttext($img,$f,0,15,25,$wh,"Antro_Vectra_Bolder.otf",$text);
	imagejpeg($img,null,50);
?>