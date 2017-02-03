<?php 
session_start();
include($_SERVER['DOCUMENT_ROOT']."/components/header.php");
//Müşteri AUTH 1
//PROJE YONETICI AUTH 2
//CALISAN AUTH 0

include($_SERVER['DOCUMENT_ROOT']."/components/ust-menu.php");

if(!empty($_SESSION['k_id']))
{

	include($_SERVER['DOCUMENT_ROOT']."/baglanti.php");
	$authKomut="select authType from auth a inner join usersRoles ur on ur.authTypeID=a.authTypeID inner join users u on u.userID=ur.userID where u.userID=".$_SESSION['k_id'];
	$authSorgu=mysqli_query($baglanti,$authKomut);
	$isAuth=mysqli_num_rows($authSorgu);

	if($isAuth==1)
	{
		$auth=mysqli_fetch_array($authSorgu)[0];
		$_SESSION['auth']=$auth;
		if($auth==2)
		{
			include($_SERVER['DOCUMENT_ROOT']."/components/projelistesi.php");
		}

	

	}
	


	


}
else
{

	header("Location:http://msprojectodev.tk");
}

include($_SERVER['DOCUMENT_ROOT']."/components/footer.php");

mysqli_close($baglanti);







?>