<?php
$projectAd=htmlentities($_POST['pAd'], ENT_QUOTES, 'UTF-8');
$projectAd=mb_convert_encoding($projectAd, 'UTF-8', 'UTF-8');

$projectSorumlu=htmlentities($_POST['pYon'], ENT_QUOTES, 'UTF-8');
$projectSorumlu=mb_convert_encoding($projectSorumlu, 'UTF-8', 'UTF-8');

$projectbasTarih=htmlentities($_POST['basTarih'], ENT_QUOTES, 'UTF-8');
$projectbasTarih=mb_convert_encoding($projectbasTarih, 'UTF-8', 'UTF-8');

$projectbitTarih=htmlentities($_POST['bitTarih'], ENT_QUOTES, 'UTF-8');
$projectbitTarih=mb_convert_encoding($projectbitTarih, 'UTF-8', 'UTF-8');

$projectButce=htmlentities($_POST['but'], ENT_QUOTES, 'UTF-8');
$projectButce=mb_convert_encoding($projectButce, 'UTF-8', 'UTF-8');

$userID=$_POST['u_id'];
//include($_SERVER['DOCUMENT_ROOT']."/baglanti.php");
//$listelekomut1="SELECT u.userID from usersRoles ur inner join users u on u.userID=ur.userID where u.userName=selectedCountry";
//$projectYonID=mysqli_query($baglanti,$listelekomut1);	
include($_SERVER['DOCUMENT_ROOT']."/baglanti.php");

$projectEkleme="INSERT INTO project(projectName,startDate,finishDate,budget,createUserID) values('".$projectAd."','".$projectbasTarih."','".$projectbitTarih."','".$projectButce."',".$userID.")";
if(mysqli_query($baglanti,$projectEkleme))
	echo "true";
else
	echo "false";

$pYonIDbulma="SELECT userID FROM users where userName='".$projectSorumlu."'";

$pYonID=mysqli_fetch_array(mysqli_query($baglanti,$pYonIDbulma))[0];

$projeIDbulma="SELECT MAX(projectID) AS 'son' FROM project";

$projID=mysqli_fetch_array(mysqli_query($baglanti,$projeIDbulma))[0];


$PyonGon="INSERT INTO userProject(userID,roleID,projectID) values('".$pYonID."',2,'".$projID."')";
mysqli_query($baglanti,$PyonGon);
//yukardaki sql kodunda işactive var aslında ama boole ya onun yerine birşey gircekmiyim ?


mysqli_close($baglanti);
?>
