<?php

include($_SERVER['DOCUMENT_ROOT']."/baglanti.php");
$oran=$_POST['oran'];
$work=$_POST['workID'];
$komut="UPDATE work set complateRate=".$oran." where workID=".$work;

if($sorgu=mysqli_query($baglanti,$komut))
{


	echo "true";
}
else
{
	echo "false";
}










?>