<?php 


$gorevlerKomut="SELECT w.workID,wn.workName,u.userName,w.workStartDate,w.workFinishDate,w.complateRate,w.description from work w inner join workName wn on wn.workNameID=w.workNameID inner join users u on u.userID=w.userID where w.processID=".$procID;
$gorevlerSorgu=mysqli_query($baglanti,$gorevlerKomut);
$gorevSayisi=mysqli_num_rows($gorevlerSorgu);
echo '
<h2>Görevler</h2>';
if($gorevSayisi==0)
{
		echo '<div class="alert alert-info">
  <strong>Sürece ait görev bulunmamaktadır.</strong> 
</div>';
}
else
{
echo '
<table class="table  table-responsive table-hover" >
<thead class="table_head" style="background-color:aliceblue;"><th>No</th><th>Görev Adı </th><th>Sorumlu Kişi</th><th>Başlangıç Tarihi</th><th class="hidden-xs">Bitiş Tarihi </th> <th>Tamamlanma Oranı </th><th>Açıklama</th></thead>
';
$siraNo=1;
while($sonuclar3=mysqli_fetch_array($gorevlerSorgu)){
echo '
<tr><td>'.$siraNo.'</td>';

echo '<td>'.$sonuclar3['workName'].'</td>';
echo '<td>'.$sonuclar3['userName'].'</td>';
echo '<td>'.$sonuclar3['workStartDate'].'</td>';
echo '<td>'.$sonuclar3['workFinishDate'].'</td>';
$tamamlanmaOrani=$sonuclar3['complateRate'];
echo '<td>';
if($tamamlanmaOrani>=0 && $tamamlanmaOrani<25 )
{
	echo '<div class="progress">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$tamamlanmaOrani.'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$tamamlanmaOrani.'%">
    '.$tamamlanmaOrani.'%
  </div>
</div>';
}
else if($tamamlanmaOrani>=25 && $tamamlanmaOrani )
{
	echo '<div class="progress">
  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="'.$tamamlanmaOrani.'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$tamamlanmaOrani.'%">
    '.$tamamlanmaOrani.'%
  </div>
</div>';
}
else if($tamamlanmaOrani>=50 && $tamamlanmaOrani<75 )
{
	echo '<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$tamamlanmaOrani.'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$tamamlanmaOrani.'%">
    '.$tamamlanmaOrani.'%
  </div>
</div>';
}
else
{
		echo '<div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$tamamlanmaOrani.'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$tamamlanmaOrani.'%">
    '.$tamamlanmaOrani.'%
  </div>
</div>';
}

echo '<td><button class="btn btn-primary" data-toggle="collapse" data-target="#not-'.$sonuclar3['workID'].'">Not</button>

<div id="not-'.$sonuclar3['workID'].'" class="collapse">
'.$sonuclar3['description'].'
</div></td>';

echo '</td></tr>';
$siraNo+=1;
}

echo '<tbody> ';
echo '</tbody></table>';
}






?>