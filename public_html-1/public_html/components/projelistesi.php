<?php 
$projelerKomut="SELECT p.projectID,up.userProjectID,p.projectName,p.startDate,p.finishDate,DATEDIFF(p.finishDate,p.startDate) as 'toplamsure',DATEDIFF(p.finishDate,CURDATE()) as 'kalansure',p.budget,CONCAT_WS(' ',u.name,u.surName) as 'Musteri' from project p inner join users u on u.userID=p.createUserID inner join userProject up on p.projectID=up.projectID and up.isAccepted=1 and up.roleID=2 where up.userID=".$_SESSION['k_id'];

$ProjelerSorgu=mysqli_query($baglanti,$projelerKomut);
$ProjeSayisi=mysqli_num_rows($ProjelerSorgu);
echo '<div class="col-md-7">
<h2>Projelerim </h2>';
if($ProjeSayisi==0)
{
	echo '<div class="alert alert-info">
  <strong>Mevcut Projeniz Bulunmamaktadır.</strong> 
</div>';
}
else
{


echo '
<table class="table  table-responsive table-hover" style="text-align:center;">
<thead class="table_head" style="background-color:aliceblue;"><th>Proje Adı</th><th>Müşteri Adı </th><th>Başlangıç Tarihi</th><th class="hidden-xs">Bitiş Tarihi </th><th>Toplam Süre</th><th>Kalan Süre </th> <th>Bütçe </th></thead><tbody>
';


while($sonuclar=mysqli_fetch_array($ProjelerSorgu))
{
echo '<tr id="prj_row_'.$sonuclar['projectID'].'">';
echo '<td>'.$sonuclar['projectName'].'</td><td>'.$sonuclar['Musteri'].'</td><td>'.$sonuclar['startDate'].'</td><td class="hidden-xs">'.$sonuclar['finishDate'].'</td><td>'.$sonuclar['toplamsure'].' Gün</td><td>'.$sonuclar['kalansure'].' Gün</td><td>'.$sonuclar['budget'].'&#x20BA;</td><td><button class="btn btn-sm btn-success proje-sayfa" id="'.$sonuclar['projectID'].'" >Projeye Git </button></td>';
echo '</tr>';
}
echo '</tbody></table>';

echo '</div>';
}












?>
<script>
$(function(){
$(".proje-sayfa").each(function(){
$(this).on("click",function(){
window.location="http://msprojectodev.tk/pages/project.php?prj_id="+parseInt($(this).attr("id"));

});

});


});
</script>