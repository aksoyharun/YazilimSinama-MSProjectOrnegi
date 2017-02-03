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
<table class="table  table-responsive table-hover" style="text-align:center;">
<thead class="table_head" style="background-color:aliceblue;"><th>Süreç Adı </th><th>Süreci Başlatan</th><th>Öncelik Durumu </th><th>Başlangıç Tarihi</th><th class="hidden-xs">Tamamlanma Tarihi </th> <th>Tamamlanma Oranı </th><th>Notlar</th></thead><tbody>
';

$siraNo=1;
while($sonuclar=mysqli_fetch_array($SureclerSorgu))
{
echo '<tr style="background-color:#E5E6CA;" id="prc_row_'.$sonuclar['processID'].'">';

if($sonuclar['parentID']==0)
{
	$yuzdekomut="select processID,CAST(AVG(complateRate) AS SIGNED) as 'yuzde'  from process where parentID=".$sonuclar['processID'];
	$complateRate=mysqli_fetch_array(mysqli_query($baglanti,$yuzdekomut))[1];
	$yuzdesorgu="UPDATE process set complateRate=".$complateRate." where processID=".$sonuclar['processID'];


	mysqli_query($baglanti,$yuzdesorgu);
	
	echo ' <td><input type="text" class="form-control" id="procAd-'.$sonuclar['processID'].'" value="'.$sonuclar['processName'].'"/></td>';
}


echo '<td>'.$sonuclar['userName'].'</td>';
echo '<td class="hidden-xs"><input type="number" class="form-control" id="oncelik-'.$sonuclar['processID'].'" value="'.$sonuclar['priority'].'"/></td>';
echo '<td><div class="form-group"><div class="input-group date" id="datepicker1" >
                
                        <input type="text" class="form-control" data-date-format="YYYY-MM-DD" value="'.$sonuclar['startDate'].'"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
                    </div></div> </td>';
echo '<td><div class="form-group"><div class="input-group date" id="datepicker2" >
                
                        <input type="text" class="form-control" data-date-format="YYYY-MM-DD"  value="'.$sonuclar['finishDate'].'"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
                    </div></div> </td>';

echo '<td><input type="number" class="form-control"  min="0" max="100" onkeyup="this.value = minmax(this.value, 0, 100)" id="'.$sonuclar['processID'].'" value='.$sonuclar['complateRate'].'/></td>';

echo '<td><button class="btn btn-primary" data-toggle="collapse" data-target="#not'.$sonuclar['processID'].'">Not</button>

<div id="not'.$sonuclar['processID'].'" class="collapse">
<textarea class="form-control">'.$sonuclar['notes'].'</textarea>
</div></td>';
echo '</td>';

echo '</tr>';
include($_SERVER['DOCUMENT_ROOT']."/components/altsureclerduzenle.php");
$siraNo+=1;


}

echo '</tbody></table>';

echo '</div>';//col bitis
echo '</div>';//row bitis
}












?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>
function minmax(value, min, max) 
{
    if(parseInt(value) < min || isNaN(parseInt(value))) 
        return 0; 
    else if(parseInt(value) > max) 
        return 100; 
    else return value;
}
$(function(){
$('#datepicker1').datepicker({
    format: "yyyy-mm-dd",
    startDate: <?php echo '"'.$projebilgileri['startDate'].'"'; ?>,
    endDate: <?php echo '"'.$projebilgileri['finishDate'].'"'; ?>,
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
    });
    $('#datepicker2').datepicker({
    format: "yyyy-mm-dd",
    startDate: <?php echo '"'.$projebilgileri['startDate'].'"'; ?>,
    endDate:<?php echo '"'.$projebilgileri['finishDate'].'"'; ?>,
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
    });


});
</script>








