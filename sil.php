<?php
session_start();
if(!isset($_SESSION["admin"]))
{
	header("location:giris.php");
}
if($_GET)
{
	include("vt.php");
	$yorumid=(int)$_GET["yorumid"];
	$sorgu=$baglanti->query("delete from yorum where yorumid=$yorumid");
	header("location:admin.php");
}
?>