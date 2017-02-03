<?php 
include($_SERVER['DOCUMENT_ROOT']."/baglanti.php");

$logKomut="Select * from usersLog where userID=".$_SESSION['k_id']." order by logDate desc";
$logSorgu=mysqli_query($baglanti,$logKomut);
echo '<table class="table table-striped table-bordered">';
echo '<thead><tr><th>İşlem Tarihi</th><th>İşlem Adı</th></thead>';
echo '<tbody>';
while($sonuc=mysqli_fetch_array($logSorgu))
{


	echo '<tr>
	<td>'.$sonuc['logDate'].'</td><td>'.$sonuc['userLogName'].'</td></tr>';
}
echo '</tbody></table>';


mysqli_close($baglanti);

?>