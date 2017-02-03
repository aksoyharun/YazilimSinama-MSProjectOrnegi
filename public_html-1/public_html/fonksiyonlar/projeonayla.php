<?php 
include("baglanti.php");
$prjID = htmlentities($_POST['projeID'], ENT_QUOTES, 'UTF-8');
$prjID = mb_convert_encoding($prjID, 'UTF-8', 'UTF-8');
$usrprjID=htmlentities($_POST['userprjID'], ENT_QUOTES, 'UTF-8');
$usrprjID=mb_convert_encoding($usrprjID, 'UTF-8', 'UTF-8');


$ProjeKontrolKomut="SELECT * From  userProject where userProjectID=".$usrprjID." and isAccepted=0";
$ProjeKontrolSorgu=mysqli_query($baglanti,$ProjeKontrolKomut);

	
	
	$satirSayisi=mysqli_num_rows($ProjeKontrolSorgu);

	if($satirSayisi==1)
	{
	$ProjeOnayKomut="UPDATE project set isActive=1 where projectID=".$prjID;
	$ProjeOnaySorgu=mysqli_query($baglanti,$ProjeOnayKomut);

	$UserProjeOnayKomut="UPDATE userProject set isAccepted=1 where userProjectID=".$usrprjID;
	$UserProjeOnaySorgu=mysqli_query($baglanti,$UserProjeOnayKomut);
	session_start();
	$k_id=$_SESSION['k_id'];
		$logName="Proje Onaylandı--Proje ID=".$prjID;
	$logKomut="INSERT INTO usersLog(userLogName,userID,logDate) values('".$logName."',".$k_id.",NOW())";
	mysqli_query($baglanti,$logKomut);
echo "true";

	}
		
		
	else 
		echo "false";
	mysqli_close($baglanti);





















?>