<?php 
$procAd=$_POST['pAd'];



$procbasTarih=htmlentities($_POST['basTarih'], ENT_QUOTES, 'UTF-8');
$procbasTarih=mb_convert_encoding($procbasTarih, 'UTF-8', 'UTF-8');

$procbitTarih=htmlentities($_POST['bitTarih'], ENT_QUOTES, 'UTF-8');
$procbitTarih=mb_convert_encoding($procbitTarih, 'UTF-8', 'UTF-8');

$procNot=htmlentities($_POST['not'], ENT_QUOTES, 'UTF-8');
$procNot=mb_convert_encoding($procNot, 'UTF-8', 'UTF-8');

$processID=htmlentities($_POST['procID'], ENT_QUOTES, 'UTF-8');
$processID=mb_convert_encoding($processID, 'UTF-8', 'UTF-8');

$tamamlanmaOrani=htmlentities($_POST['tamamlanma'], ENT_QUOTES, 'UTF-8');
$tamamlanmaOrani=mb_convert_encoding($tamamlanmaOrani, 'UTF-8', 'UTF-8');

$oncelikDurumu=htmlentities($_POST['oncelik'], ENT_QUOTES, 'UTF-8');
$oncelikDurumu=mb_convert_encoding($oncelikDurumu, 'UTF-8', 'UTF-8');


$creatorID=htmlentities($_POST['userID'], ENT_QUOTES, 'UTF-8');
$creatorID=mb_convert_encoding($creatorID, 'UTF-8', 'UTF-8');

$mainProc=$_POST['mainProc'];



include($_SERVER['DOCUMENT_ROOT']."/baglanti.php");


$getProcIDKomut="select processID from process where processName='".$mainProc."'";
$getprocSorgu=mysqli_query($baglanti,$getProcIDKomut);

if(empty($mainProc)){
	$mainProcID=0;
}
else
{
	$mainProcID=mysqli_fetch_array($getprocSorgu)[0];
}
$procUpdateKomut="UPDATE process set processName='".$procAd."' , startDate='".$procbasTarih."' , priority=".$oncelikDurumu."  , finishDate='".$procbitTarih."' , notes='".$procNot."' , parentID=".$mainProcID.",complateRate=".$tamamlanmaOrani."   where processID=".$processID;
$denemeKomut="SELECT * FROM process";
$procKomut="INSERT INTO process(processName,projectID,startDate,finishDate,notes,createUserID) values('".$procAd."',".$projeID.",'".$procbasTarih."','".$procbitTarih."','".$procNot."',".$creatorID.")";



if($procSorgu=mysqli_query($baglanti,$procUpdateKomut))
{

 


$logName="Süreç güncellendi--Süreç Adı:".$procAd;
    $logKomut="INSERT INTO usersLog(userLogName,userID,logDate) values('".$logName."',".$creatorID.",NOW())";
    mysqli_query($baglanti,$logKomut);

    echo "true";
}
else
    echo $mainProc;

mysqli_close($baglanti);












?>