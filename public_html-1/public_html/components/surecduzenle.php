

<?php 
$sureclerKomut="select pr.processID,pr.processName,pr.projectID,pr.startDate,pr.finishDate,DATEDIFF(pr.finishDate,pr.startDate) as 'toplam_sure',DATEDIFF(pr.finishDate,CURDATE()) as 'kalan_sure',pr.complateRate,pr.priority,pr.parentID,pr.notes,u.userName from process pr inner join users u on pr.createUserID=u.userID where  processID=".$procID;
$SureclerSorgu=mysqli_query($baglanti,$sureclerKomut);

$surecBilgi=mysqli_fetch_array(mysqli_query($baglanti,$sureclerKomut));

$calisankomut="SELECT u.userID,u.userName  FROM users u inner join usersRoles ur on u.userID=ur.userID and ur.authTypeID<>1 ";
$calisansorgu=mysqli_query($baglanti,$calisankomut);


$mainprocessKomut="Select processName from process where parentID=0 AND projectID=".$prjID." and processID <>".$procID;
$mainprocessSorgu=mysqli_query($baglanti,$mainprocessKomut);

$projeKomut="SELECT startDate,finishDate from project where projectID=".$prjID;
$projebilgileri=mysqli_fetch_array(mysqli_query($baglanti,$projeKomut));

$sb=mysqli_fetch_array($SureclerSorgu);
$surecSorumlusuKomut="SELECT userID from userProcess where processID=".$procID;
$surecSorumlusu=mysqli_fetch_array(mysqli_query($baglanti,$surecSorumlusuKomut))[0];
echo '<div class="col-md-7"> <a class="btn btn-primary" href="http://msprojectodev.tk/pages/project.php?prj_id='.$prjID.'">Proje sayfasına dön</a><button class="btn btn-danger" id="save-proc">Kaydet</button><button type="button" class="btn btn-info " data-toggle="modal" data-target="#creatework">Görev Oluştur</button>  <button type="button" class="btn btn-info " data-toggle="modal" data-target="#rapor">Rapor Oluştur</button></div>';
echo '<table class="table  table-responsive table-hover" style="text-align:center;">
<thead class="table_head" style="background-color:aliceblue;"><th>Süreç Adı </th><th>Süreci Başlatan</th><th>Öncelik Durumu </th><th>Başlangıç Tarihi</th><th class="hidden-xs">Tamamlanma Tarihi </th> <th>Tamamlanma Oranı </th><th>Notlar</th><th>Ana Süreç </th></thead><tbody>';
echo '<tr style="background-color:#E5E6CA;" id="prc_row_'.$sb['processID'].'">';

echo ' <td><input type="text" class="form-control" id="procAd" value="'.$sb['processName'].'"/></td>';


echo '<td>'.$sb['userName'].'</td>';
echo '<td class="hidden-xs"><input type="number" class="form-control" id="oncelik" value="'.$sb['priority'].'"/></td>';
echo '<td><div class="form-group"><div class="input-group date"  >
                
                        <input type="text" class="form-control" id="datepicker1" data-date-format="YYYY-MM-DD" value="'.$sb['startDate'].'"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
                    </div></div> </td>';
echo '<td><div class="form-group"><div class="input-group date"  >
                
                        <input type="text" class="form-control" disabled="true" id="datepicker2" data-date-format="YYYY-MM-DD"  value="'.$sb['finishDate'].'"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
                    </div></div> </td>';

echo '<td><input type="number" id="tamamlanmaOran" class="form-control"  min="0" max="100" onkeyup="this.value = minmax(this.value, 0, 100)" value="'.$sb['complateRate'].'"/></td>';

echo '<td><button class="btn btn-primary" data-toggle="collapse" data-target="#not'.$sb['processID'].'">Not</button>

<div id="not'.$sb['processID'].'" class="collapse">
<textarea id="notbolum" class="form-control">'.$sb['notes'].'</textarea>
</div></td>';
echo '</td>';
echo '<td><select id="main-proc" class="form-control"><option selected></option>';
while($processler=mysqli_fetch_array($mainprocessSorgu))
{
    echo '<option>'.$processler['processName'].'</option>';
}
echo '</select></td>';

echo '</tr>';

echo '</tbody></table></div>';
include($_SERVER['DOCUMENT_ROOT']."/components/gorevolustur.php");
include($_SERVER['DOCUMENT_ROOT']."/components/surecrapor.php");
?>



 
<script>
function minmax(value, min, max) 
{
    if(parseInt(value) < min || isNaN(parseInt(value))) 
        return 0; 
    else if(parseInt(value) > max) 
        return 100; 
    else return value;
}
function update(pAd,basTarih,bitTarih,not,oncelik,tamamlanma,mainProc)
{
	crID=<?php echo $_SESSION['k_id']; ?>;
	prcID=<?php echo $procID; ?>;
	var datastring="pAd="+pAd+"&basTarih="+basTarih+"&bitTarih="+bitTarih+"&not="+not+ "&oncelik="+oncelik+"&tamamlanma="+tamamlanma+"&procID="+prcID+"&userID="+crID+"&mainProc="+mainProc;
$.ajax({
type: "POST",
                    url: "../fonksiyonlar/updateprocess.php",      
                    data: datastring,
                    success:function(response){
                    	if(response=="true")
                    	{
                    		
                    		alert("Process güncellendi");
                            location.reload();
                    		
                    	}
                    	else
                    	{

                    		alert(response);
                    	}
}

});
}
$(function(){

 prjBas=<?php echo '"'.$projebilgileri['startDate'].'"'; ?>;
 prjBasTarih=new Date(prjBas);



$('#datepicker1').datepicker({
    dateFormat: "yy-mm-dd",
    minDate: prjBasTarih,
    maxDate: <?php echo '"'.$projebilgileri['finishDate'].'"'; ?>,
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
       onSelect:function(date){

        var selectedDate = new Date(date);
            $('#datepicker2').attr("disabled",false);
            $('#datepicker2').attr("style","background-color:white");
            $('#datepicker2').datepicker("option","minDate",selectedDate);

    }
    });
    $('#datepicker2').datepicker({
    dateFormat: "yy-mm-dd",
    minDate: <?php echo '"'.$projebilgileri['startDate'].'"'; ?>,
    maxDate:<?php echo '"'.$projebilgileri['finishDate'].'"'; ?>,
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
    });


    $("#save-proc").click(function(){
    	surecAd=$("#procAd").val();
    	
    	basTarih=$("#datepicker1").val();
    	bitTarih=$("#datepicker2").val();
    	oncelikDurum=$("#oncelik").val();
    	Tamamlanma=$("#tamamlanmaOran").val();
    	not=$("#notbolum").val();
        mProc=$("#main-proc").val();
    	update(surecAd,basTarih,bitTarih,not,oncelikDurum,Tamamlanma,mProc);


    });
});
</script>
