<?php 

$gorevlerKomut="SELECT w.workID,wn.workName,pr.processName,p.projectName,w.workStartDate,w.workFinishDate,w.complateRate,w.description from work w inner join workName wn on wn.workNameID=w.workNameID inner join process pr on pr.processID=w.processID inner join project p on p.projectID=pr.projectID where w.workID=".$workID;
$gorevlerSorgu=mysqli_query($baglanti,$gorevlerKomut);
$gorevlerSonuc=mysqli_fetch_array($gorevlerSorgu);
echo '<div class="col-md-4"><td><label for="tamamlanmaOran">Tamamlanma Oranı </label><input type="number" id="tamamlanmaOran" class="form-control"  min="0" max="100" onkeyup="this.value = minmax(this.value, 0, 100)" value="'.$gorevlerSonuc['complateRate'].'"/></td>
<button class="btn  btn-primary" id="guncelle">Güncelle </button></div>';





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
$(function(){

WORK=<?php echo $workID; ?>;
$("#guncelle").click(function(){
oran=$("#tamamlanmaOran").val();
datastring="workID="+WORK+ "&oran="+oran;
$.ajax({

type: "POST",
                    url: "../fonksiyonlar/updatework.php",      
                    data: datastring,
                    success:function(response){
                    	if(response=="true")
                    	{
                    		
                    		alert("Görev güncellendi");
                    		window.location="http://msprojectodev.tk/pages/dashboard.php";
                    	}
                    	else
                    	{

                    		alert(response);
                    	}
}
});


});


});

</script>