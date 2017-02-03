<?php 
$altsureclerKomut="select pr.processID,pr.processName,pr.startDate,pr.finishDate,DATEDIFF(pr.finishDate,pr.startDate) as 'toplam_sure',DATEDIFF(pr.finishDate,CURDATE()) as 'kalan_sure',pr.complateRate,pr.priority,pr.parentID,pr.notes,u.userName from process pr inner join users u on pr.createUserID=u.userID where  projectID=".$prjID." and pr.createUserID=".$_SESSION['k_id']." and pr.parentID=".$sonuclar['processID']." order by pr.priority DESC";

$altSureclerSorgu=mysqli_query($baglanti,$altsureclerKomut);
$altsiraNo=1;
while($sonuclar2=mysqli_fetch_array($altSureclerSorgu))
{
  
echo '<tr id="prc_row_'.$sonuclar2['processID'].'">';

echo '<td>'.$siraNo.'.'.$altsiraNo.'</td>';

  echo ' <td><input type="text" class="form-control" id="procAd-'.$sonuclar2['processID'].'" value="'.$sonuclar2['processName'].'"/></td>';
echo '<td>'.$sonuclar2['userName'].'</td>';


echo '<td class="hidden-xs"><input type="number" class="form-control" id="oncelik-'.$sonuclar2['processID'].'" value="'.$sonuclar2['priority'].'"/></td>';
echo '<td><div class="form-group"><div class="input-group date" id="datepicker1" >
                
                        <input type="text" class="form-control" data-date-format="YYYY-MM-DD" value="'.$sonuclar2['startDate'].'"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
                    </div></div> </td>';
echo '<td><div class="form-group"><div class="input-group date" id="datepicker2" >
                
                        <input type="text" class="form-control" data-date-format="YYYY-MM-DD"  value="'.$sonuclar2['finishDate'].'"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
                    </div></div> </td>';

echo '<td><input type="number" class="form-control"  min="0" max="100" onkeyup="this.value = minmax(this.value, 0, 100)" id="'.$sonuclar2['processID'].'" value='.$sonuclar2['complateRate'].'/></td>';

echo '<td><button class="btn btn-primary" data-toggle="collapse" data-target="#not'.$sonuclar2['processID'].'">Not</button>

<div id="not'.$sonuclar2['processID'].'" class="collapse">
<textarea class="form-control">'.$sonuclar2['notes'].'</textarea>
</div></td>';
echo '</td>';


echo '</tr>';

$altsiraNo+=1;
}

?>