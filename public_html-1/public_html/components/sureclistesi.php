 <?php 




$sureclerKomut="select pr.processID,pr.processName,pr.startDate,pr.finishDate,DATEDIFF(pr.finishDate,pr.startDate) as 'toplam_sure',DATEDIFF(pr.finishDate,CURDATE()) as 'kalan_sure',pr.complateRate,pr.priority,pr.parentID,pr.notes,u.userName from process pr inner join users u on pr.createUserID=u.userID where  projectID=".$prjID." and pr.createUserID=".$_SESSION['k_id']." and pr.parentID=0 order by pr.priority DESC";
$SureclerSorgu=mysqli_query($baglanti,$sureclerKomut);
$SurecSayisi=mysqli_num_rows($SureclerSorgu);
echo '
<div class="row"><div class="col-md-12">
<h2>Süreçler </h2>';
if($SurecSayisi==0)
{
	echo '<div class="alert alert-info">
  <strong>Projeye ait süreç  bulunmamaktadır.</strong> 
</div>';
}
else
{


echo '
<table class="table  table-responsive table-hover" >
<thead class="table_head" style="background-color:aliceblue;"><th>No</th><th>Süreç Adı </th><th>Süreci Başlatan</th><th>Öncelik Durumu </th><th>Başlangıç Tarihi</th><th class="hidden-xs">Tamamlanma Tarihi </th><th>Toplam Süre</th><th>Kalan Süre </th> <th>Tamamlanma Oranı </th><th>Notlar</th></thead><tbody>
';

$siraNo=1;
while($sonuclar=mysqli_fetch_array($SureclerSorgu))
{
echo '<tr style="background-color:#E5E6CA;" id="prc_row_'.$sonuclar['processID'].'">';
echo '<td>'.$siraNo.'</td>';
if($sonuclar['parentID']==0)
{




	
	echo ' <td><b><a href="http://msprojectodev.tk/pages/editprocess.php?procID='.$sonuclar['processID'].'">'.$sonuclar['processName'].'</a></b></td>';
}


echo '<td>'.$sonuclar['userName'].'</td><td class="hidden-xs">'.$sonuclar['priority'].'</td><td>'.$sonuclar['startDate'].' </td><td>'.$sonuclar['finishDate'].'</td>';
if($sonuclar['toplam_sure']<0)
 echo '<td>0 Gün</td>';
else
{
   echo '<td>'.$sonuclar['toplam_sure'].' Gün</td>';
}
if ($sonuclar['kalan_sure']<0)
{
 echo ' <td>0 Gün</td>';
}
else
{
  echo ' <td>'.$sonuclar['kalan_sure'].' Gün</td>'; 
}
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
echo '<td><button class="btn btn-primary" data-toggle="collapse" data-target="#not'.$sonuclar['processID'].'">Not</button>

<div id="not'.$sonuclar['processID'].'" class="collapse">
'.$sonuclar['notes'].'
</div></td>';
echo '</td>';

echo '</tr>';
include($_SERVER['DOCUMENT_ROOT']."/components/altsurecler.php");
$siraNo+=1;


}

echo '</tbody></table>';

echo '</div>';//col bitis
echo '</div>';//row bitis
}












?>
<script>

</script>








