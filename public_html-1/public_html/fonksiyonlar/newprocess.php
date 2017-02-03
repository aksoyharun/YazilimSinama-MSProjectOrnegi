<?php 
$procAd=htmlentities($_POST['pAd'], ENT_QUOTES, 'UTF-8');
$procAd=mb_convert_encoding($procAd, 'UTF-8', 'UTF-8');

$procSorumlu=htmlentities($_POST['pYon'], ENT_QUOTES, 'UTF-8');
$procSorumlu=mb_convert_encoding($procSorumlu, 'UTF-8', 'UTF-8');

$procbasTarih=htmlentities($_POST['basTarih'], ENT_QUOTES, 'UTF-8');
$procbasTarih=mb_convert_encoding($procbasTarih, 'UTF-8', 'UTF-8');

$procbitTarih=htmlentities($_POST['bitTarih'], ENT_QUOTES, 'UTF-8');
$procbitTarih=mb_convert_encoding($procbitTarih, 'UTF-8', 'UTF-8');

$procNot=htmlentities($_POST['not'], ENT_QUOTES, 'UTF-8');
$procNot=mb_convert_encoding($procNot, 'UTF-8', 'UTF-8');

$projeID=htmlentities($_POST['projID'], ENT_QUOTES, 'UTF-8');
$projeID=mb_convert_encoding($projeID, 'UTF-8', 'UTF-8');


$creatorID=htmlentities($_POST['creatorID'], ENT_QUOTES, 'UTF-8');
$creatorID=mb_convert_encoding($creatorID, 'UTF-8', 'UTF-8');
include($_SERVER['DOCUMENT_ROOT']."/baglanti.php");




$procKomut="INSERT INTO process(processName,projectID,startDate,finishDate,notes,createUserID) values('".$procAd."',".$projeID.",'".$procbasTarih."','".$procbitTarih."','".$procNot."',".$creatorID.")";



if($procSorgu=mysqli_query($baglanti,$procKomut))
{

	$procSorumluKomut="SELECT userID from users where userName='".$procSorumlu."'";
	$getlastProcKomut="SELECT MAX(processID) AS 'son' from process";
$procSorumlu=mysqli_fetch_array(mysqli_query($baglanti,$procSorumluKomut))[0];
$procID=mysqli_fetch_array(mysqli_query($baglanti,$getlastProcKomut))[0];
$SorumluKayıtKomut="INSERT INTO userProcess(processID,userID) values(".$procID.",".$procSorumlu.")";
mysqli_query($baglanti,$SorumluKayıtKomut);

$logName="Süreç oluşturuldu--Süreç Adı:".$procAd;
	$logKomut="INSERT INTO usersLog(userLogName,userID,logDate) values('".$logName."',".$creatorID.",NOW())";
	mysqli_query($baglanti,$logKomut);

	echo "true";
}
else
	echo "false";

mysqli_close($baglanti);












?>