<?php 
$surecAd=$_POST['sAd'];


$gorevAd=$_POST['gAd'];


$gorevbasTarih=htmlentities($_POST['basTarih'], ENT_QUOTES, 'UTF-8');
$gorevbasTarih=mb_convert_encoding($gorevbasTarih, 'UTF-8', 'UTF-8');

$gorevbitTarih=htmlentities($_POST['bitTarih'], ENT_QUOTES, 'UTF-8');
$gorevbitTarih=mb_convert_encoding($gorevbitTarih, 'UTF-8', 'UTF-8');

$procNot=$_POST['not'];

$sorumlu=$_POST['sorumlu'];
include($_SERVER['DOCUMENT_ROOT']."/baglanti.php");
$surecIDkomut="select processID from process where processName='".$surecAd."'";
$surecID=mysqli_fetch_array(mysqli_query($baglanti,$surecIDkomut))[0];


$creatorID=htmlentities($_POST['creatorID'], ENT_QUOTES, 'UTF-8');
$creatorID=mb_convert_encoding($creatorID, 'UTF-8', 'UTF-8');

$gorevKomut="INSERT INTO workName(workName) values('".$gorevAd."')";
mysqli_query($baglanti,$gorevKomut);

$gorevID=mysqli_fetch_array(mysqli_query($baglanti,"SELECT MAX(workNameID) from workName"))[0];

$sorumluKomut="SELECT userID from users where userName='".$sorumlu."'";
$sorumluID=mysqli_fetch_array(mysqli_query($baglanti,$sorumluKomut))[0];


$workKomut="INSERT INTO work(processID,workNameID,workStartDate,workFinishDate,description,userID) values(".$surecID.",".$gorevID.",'".$gorevbasTarih."','".$gorevbitTarih."','".$procNot."',".$sorumluID.")";



if($workSorgu=mysqli_query($baglanti,$workKomut))
{



$logName="Görev oluşturuldu--Görev Adı:".$gorevAd;
	$logKomut="INSERT INTO usersLog(userLogName,userID,logDate) values('".$logName."',".$creatorID.",NOW())";
	mysqli_query($baglanti,$logKomut);

	echo "true";
}
else
	echo $surecAd.$gorevAd;

mysqli_close($baglanti);












?>