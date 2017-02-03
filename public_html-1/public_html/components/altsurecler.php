<?php 
$altsureclerKomut="select pr.processID,pr.processName,pr.startDate,pr.finishDate,DATEDIFF(pr.finishDate,pr.startDate) as 'toplam_sure',DATEDIFF(pr.finishDate,CURDATE()) as 'kalan_sure',pr.complateRate,pr.priority,pr.parentID,pr.notes,u.userName from process pr inner join users u on pr.createUserID=u.userID where  projectID=".$prjID." and pr.createUserID=".$_SESSION['k_id']." and pr.parentID=".$sonuclar['processID']." order by pr.priority DESC";

$altSureclerSorgu=mysqli_query($baglanti,$altsureclerKomut);
$altsiraNo=1;
while($sonuclar2=mysqli_fetch_array($altSureclerSorgu))
{
  
echo '<tr id="prc_row_'.$sonuclar2['processID'].'">';
echo '<td>'.$siraNo.'.'.$altsiraNo.'</td>';

  echo ' <td><a href="http://msprojectodev.tk/pages/editprocess.php?procID='.$sonuclar2['processID'].'">'.$sonuclar2['processName'].'</a></td>';



echo '<td>'.$sonuclar2['userName'].'</td><td class="hidden-xs">'.$sonuclar2['priority'].'</td><td>'.$sonuclar2['startDate'].' </td><td>'.$sonuclar2['finishDate'].'</td>';
if($sonuclar2['toplam_sure']<0)
 echo '<td>0 Gün</td>';
else
{
   echo '<td>'.$sonuclar2['toplam_sure'].' Gün</td>';
}

if ($sonuclar2['kalan_sure']<0)
{
 echo ' <td>0 Gün</td>';
}
else
{
  echo ' <td>'.$sonuclar2['kalan_sure'].' Gün</td>'; 
}

echo '<td>';
if($sonuclar2['complateRate']>=0 && $sonuclar2['complateRate']<25 )
{
  echo '<div class="progress">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$sonuclar2['complateRate'].'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$sonuclar2['complateRate'].'%">
    '.$sonuclar2['complateRate'].'%
  </div>
</div>';
}
else if($sonuclar2['complateRate']>=25 && $sonuclar2['complateRate']<50 )
{
  echo '<div class="progress">
  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="'.$sonuclar2['complateRate'].'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$sonuclar2['complateRate'].'%">
    '.$sonuclar2['complateRate'].'%
  </div>
</div>';
}
else if($sonuclar2['complateRate']>=50 && $sonuclar2['complateRate']<75 )
{
  echo '<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$sonuclar2['complateRate'].'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$sonuclar2['complateRate'].'%">
    '.$sonuclar2['complateRate'].'%
  </div>
</div>';
}
else
{
    echo '<div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$sonuclar2['complateRate'].'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$sonuclar2['complateRate'].'%">
    '.$sonuclar2['complateRate'].'%
  </div>
</div>';
}
echo '<td><button class="btn btn-primary" data-toggle="collapse" data-target="#not'.$sonuclar2['processID'].'">Not</button>

<div id="not'.$sonuclar2['processID'].'" class="collapse">
'.$sonuclar2['notes'].'
</div></td>';
echo '</td>';

echo '</tr>';

$altsiraNo+=1;
}

?>