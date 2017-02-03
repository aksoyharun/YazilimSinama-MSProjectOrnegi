<?php 
include("baglanti.php");
$k_ad = htmlentities($_POST['k_ad'], ENT_QUOTES, 'UTF-8');
$k_ad = mb_convert_encoding($k_ad, 'UTF-8', 'UTF-8');
$pass=htmlentities($_POST['sifre'], ENT_QUOTES, 'UTF-8');
$pass=mb_convert_encoding($pass, 'UTF-8', 'UTF-8');


$KomutKullaniciKontrol="select * from users where binary userName='".$k_ad."' and binary password='".$pass."'";
	$kullaniciKontrolSorgu=mysqli_query($baglanti,$KomutKullaniciKontrol);
	
	$satirSayisi=mysqli_num_rows($kullaniciKontrolSorgu);

	if($satirSayisi==1)
	{
	$k_id=mysqli_fetch_array($kullaniciKontrolSorgu);
	$k_id=$k_id[0][0];
	$logName="Sisteme giriş işlemi";
	$logKomut="INSERT INTO usersLog(userLogName,userID,logDate) values('".$logName."',".$k_id.",NOW())";
	mysqli_query($baglanti,$logKomut);

session_start();
$_SESSION['k_id']=$k_id;
$_SESSION['k_ad']=$k_ad;
echo "true";

	}
		
		
	else 
		echo "false";
	mysqli_close($baglanti);





















?>