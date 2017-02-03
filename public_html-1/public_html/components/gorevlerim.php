 <?php 




$gorevlerKomut="SELECT w.workID,wn.workName,pr.processName,p.projectName,w.workStartDate,w.workFinishDate,w.complateRate,w.description from work w inner join workName wn on wn.workNameID=w.workNameID inner join process pr on pr.processID=w.processID inner join project p on p.projectID=pr.projectID where w.userID=".$_SESSION['k_id'];
$gorevlerSorgu=mysqli_query($baglanti,$gorevlerKomut);
$gorevSayisi=mysqli_num_rows($gorevlerSorgu);
echo '
<div class="row"><div class="col-md-12">
<h2>Görevlerim </h2>';
if($gorevSayisi==0)
{
	echo '<div class="alert alert-info">
  <strong>Size ait görev  bulunmamaktadır.</strong> 
</div>';
}
else
{


echo '
<table class="table  table-responsive table-hover" style="text-align:center;">
<thead class="table_head" style="background-color:aliceblue;"><th>No</th><th>Görev Adı </th><th>Süreç Adı</th><th>Proje Adı </th><th>Başlangıç Tarihi</th><th class="hidden-xs">Bitiş Tarihi </th> <th>Tamamlanma Oranı </th><th>Açıklama</th></thead><tbody>
';

$siraNo=1;
while($sonuclar=mysqli_fetch_array($gorevlerSorgu))
{
echo '<tr style="background-color:#E5E6CA;" id="prc_row_'.$sonuclar['workID'].'">';
echo '<td>'.$siraNo.'</td>';





	
	echo ' <td><b><a href="http://msprojectodev.tk/pages/editwork.php?workID='.$sonuclar['workID'].'">'.$sonuclar['workName'].'</a></b></td>';



echo '<td>'.$sonuclar['processName'].'</td><td>'.$sonuclar['projectName'].'</td><td>'.$sonuclar['workStartDate'].'</td><td>'.$sonuclar['workFinishDate'].'</td>';
echo '<td>';
if($sonuclar['complateRate']>=0 && $sonuclar['complateRate']<25 )
{
	echo '<div class="progress">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$sonuclar['complateRate'].'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$sonuclar['complateRate'].'%">
    '.$sonuclar['complateRate'].'%
  </div>
</div>';
}
else if($sonuclar['complateRate']>=25 && $sonuclar['complateRate']<50 )
{
	echo '<div class="progress">
  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="'.$sonuclar['complateRate'].'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$sonuclar['complateRate'].'%">
    '.$sonuclar['complateRate'].'%
  </div>
</div>';
}
else if($sonuclar['complateRate']>=50 && $sonuclar['complateRate']<75 )
{
	echo '<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$sonuclar['complateRate'].'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$sonuclar['complateRate'].'%">
    '.$sonuclar['complateRate'].'%
  </div>
</div>';
}
else
{
		echo '<div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$sonuclar['complateRate'].'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$sonuclar['complateRate'].'%">
    '.$sonuclar['complateRate'].'%
  </div>
</div>';
}
echo '<td><button class="btn btn-primary" data-toggle="collapse" data-target="#not'.$sonuclar['workID'].'">Not</button>

<div id="not'.$sonuclar['workID'].'" class="collapse">
'.$sonuclar['description'].'
</div></td>';
echo '</td>';

echo '</tr>';

$siraNo+=1;


}

echo '</tbody></table>';

echo '</div>';//col bitis
echo '</div>';//row bitis
}












?>
<script>

</script>








