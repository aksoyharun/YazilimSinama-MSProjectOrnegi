<?php

$pKomut="select projectName from project where projectID=".$prjID;
$projeAdi=mysqli_fetch_array(mysqli_query($baglanti,$pKomut))[0];


$kisiKomut="select CONCAT(u.name,' ',u.surName) as'adsoyad' from users u where userName='".$sb['userName']."'";
$kisi=mysqli_fetch_array(mysqli_query($baglanti,$kisiKomut))[0];

$gorevlerKomut="SELECT wn.workName,u.userName,w.workStartDate,w.workFinishDate,w.complateRate,w.description from work w inner join workName wn on wn.workNameID=w.workNameID inner join users u on u.userID=w.userID where w.processID=".$sb['processID'];
$gorevlerSorgu=mysqli_query($baglanti,$gorevlerKomut);













?>
<div id="rapor"  class="modal fade" role="dialog">
  <div style="width:1024px;" class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      	<div id="rapor-icerik">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><center>Süreç Raporu</center></h4>
	      </div>
	      <div class="modal-body">
	      <table class="table table-bordered">
	        <tr><td class="td-h"><b>Proje Adı:</b> </td> <td><?php echo $projeAdi; ?> </td></tr>
	        <tr><td class="td-h"><b>Süreç Adı:</b> </td> <td><?php echo $sb['processName']; ?></td></tr>
	        <tr><td class="td-h"><b>Öncelik:</b> </td> <td><?php echo $sb['priority']; ?></td></tr>
	        <tr><td class="td-h"><b>Sorumlu Kişi:</b> </td> <td><?php echo $kisi; ?></td></tr>
	        <tr><td class="td-h"><b>Başlangıç Tarihi:</b> </td> <td><?php echo $sb['startDate']; ?></td></tr>
	            <tr><td class="td-h"><b>Bitiş Tarihi:</b> </td> <td><?php echo $sb['finishDate']; ?></td></tr>

	        </table>
	           <tr><center><h4>Görev Listesi </h4></center></tr>

	           <table class="table">
	          <thead class="table_head th-h" style="background-color:aliceblue;"><th>Görev Adı </th><th>Sorumlu</th><th>Başlangıç Tarihi</th><th class="hidden-xs">Tamamlanma Tarihi </th> <th>Tamamlanma Oranı </th></thead>
	          <tbody>
	        <?php 
	        while($sonucRapor=mysqli_fetch_array($gorevlerSorgu))
	        {
	        	echo '<tr>';
	        		echo '<td class="td-h">'.$sonucRapor['workName']           .'</td>';
	        		echo '<td class="td-h">'.$sonucRapor['userName']        .'</td>';
	        		echo '<td class="td-h">'.    $sonucRapor['workStartDate']          .'</td>';
	        		echo '<td class="td-h">'.  $sonucRapor['workFinishDate']            .'</td>';
	        		echo '<td class="td-h">'.   $sonucRapor['complateRate']           .' %</td>';



	        	echo '</tr>';

	        }




	        ?>
	         </tbody>
	          </tbody>
	        </table>
	      </div>
	     </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="yazdir" class="btn btn-default" data-dismiss="modal">Yazdir</button>
      </div>
    </div>

  </div>
</div>
<style>
.td-h
{

	width:250px;
}
.th-h th{
	padding-left:5px;
}
</style>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('rapor-icerik');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
$("#yazdir").click(function(){
printDiv();
});
</script>