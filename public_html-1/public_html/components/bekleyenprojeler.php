<?php 
$bekleyenProjelerKomut=" SELECT p.projectID,up.userProjectID,p.projectName,p.startDate,p.finishDate,DATEDIFF(p.finishDate,p.startDate) as 'toplamsure',p.budget,CONCAT_WS(' ',u.name,u.surName) as 'Musteri' from project p inner join users u on u.userID=p.createUserID inner join userProject up on p.projectID=up.projectID and up.isAccepted=0 where up.userID=".$_SESSION['k_id'];
$bekleyenProjelerSorgu=mysqli_query($baglanti,$bekleyenProjelerKomut);
$bekleyenProjeSayisi=mysqli_num_rows($bekleyenProjelerSorgu);
echo '<div class="col-md-7">
<h2>Proje İstekleri </h2>';
if($bekleyenProjeSayisi==0)
{
	echo '<div class="alert alert-info">
  <strong>Proje isteği bulunmamaktadır.</strong> 
</div>';
}
else
{


echo '
<table class="table  table-responsive table-hover" style="text-align:center;">
<thead class="table_head" style="background-color:aliceblue;"><th>Proje Adı</th><th>Müşteri Adı </th><th>Başlangıç Tarihi</th><th class="hidden-xs">Bitiş Tarihi </th><th>Toplam Süre</th> <th>Bütçe </th><th>Onay</th></thead><tbody>
';


while($sonuclar=mysqli_fetch_array($bekleyenProjelerSorgu))
{
echo '<tr id="prj_row_'.$sonuclar['projectID'].'">';
echo '<td>'.$sonuclar['projectName'].'</td><td>'.$sonuclar['Musteri'].'</td><td>'.$sonuclar['startDate'].'</td><td class="hidden-xs">'.$sonuclar['finishDate'].'</td><td>'.$sonuclar['toplamsure'].' Gün</td><td>'.$sonuclar['budget'].'&#x20BA;</td><td><button class="btn btn-sm btn-success proje-onay" id="'.$sonuclar['projectID'].'" userprojectid="'.$sonuclar['userProjectID'].'">Onayla </button></td>';
echo '</tr>';
}
echo '</tbody></table>';
echo '<div class="alert alert-success  alert-dismissable" id="proje-onay-uyari" style="display:none;"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Proje Onaylandı </div>';
echo '</div>';
}









?>
<script>
function projeOnay(prjID,usrPrjID)
{

var datastring="projeID="+parseInt(prjID)+"&userprjID="+parseInt(usrPrjID);
 $.ajax({
                    type: "POST",
                    url: "../fonksiyonlar/projeonayla.php",      
                    data: datastring,
                    success:function(response){
                    	if(response=="true")
                    	{
                    		$("#prj_row_"+prjID).hide(50,function(){
							$("#proje-onay-uyari").show();
                    	});
                    	}
                    	else
                    	{
                    		
                    	}

                    }
                    
                });



}
$(function(){
$(".proje-onay").each(function(){
$(this).on("click",function(){
projeOnay($(this).attr("id"),$(this).attr("userprojectid"));

});

});


});





</script>