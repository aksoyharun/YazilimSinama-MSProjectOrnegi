<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT']."/components/header.php");
include($_SERVER['DOCUMENT_ROOT']."/components/ust-menu.php");
echo '<div class="page-header"><h1>İşlem Kaydı </h1></div>';
if(!empty($_SESSION['k_id']))
{
	echo '<div class="col-md-5 col-md-offset-3 col-sm-10 col-xs-12">';
	include($_SERVER['DOCUMENT_ROOT']."/components/islemkaydi.php");
	echo '</div>';

	


	


}
else
{

	header("Location:http://msprojectodev.tk");
}

include($_SERVER['DOCUMENT_ROOT']."/components/footer.php");




?>