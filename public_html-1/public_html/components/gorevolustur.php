<?php 
$calisankomut="SELECT u.userID,u.userName  FROM users u inner join usersRoles ur on u.userID=ur.userID and ur.authTypeID<>1 ";
$calisansorgu=mysqli_query($baglanti,$calisankomut);

$sureclerKomut="select pr.processID,pr.processName from process pr  where  projectID=".$prjID;
$SureclerSorgu=mysqli_query($baglanti,$sureclerKomut);




echo '<div id="creatework" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Görev Oluştur</h4>
      </div>
      <div class="modal-body">
        <form class="form">
							<div class="form-group">
							<label for="gorevAd">*Görev Adı</label>
							<input class="form-control" type="text" placeholder="Görev adını giriniz" id="gorevAd" required>
							</div>
							<div class="form-group">
							<label for="sorumluKisi">*Sorumlu kişi ekle</label>
							<select class="form-control" id="sorumluKisi" >
								';
								while($sonuclar=mysqli_fetch_array($calisansorgu))
								{
									echo '<option>'.$sonuclar['userName'].'</option>';
							    
								}
								echo '
								 </select>
							</div><div class="form-group">
                            <label for="surecAdi">Süreç Adı </label>
                             <select class="form-control" id="surecAd" >
                            ';

                                
                                while($sonuclar2=mysqli_fetch_array($SureclerSorgu))
                                {
                                    echo '<option>'.$sonuclar2['processName'].'</option>';
                                
                                }
                                echo '
                                </select></div>

							<div class="form-group">
							<label for="projectName">*Başlangıç Tarihi</label>
 								<div class="input-group date"  >
 								
            						<input type="text" id="datepicker3" style="background-color:white;" readonly="true" class="form-control" data-date-format="YYYY-MM-DD"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
        						</div>	
        					</div>	 
							<div class="form-group">
							<label for="projectName">*Bitiş Tarihi</label>
 								<div class="input-group date" >
            						<input type="text" id="datepicker4"  disabled="true" readonly="true" class="form-control" data-date-format="YYYY-MM-DD"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
        						</div>		 
							
							</div>
							
								<div class="form-group">
							<label for="aciklama">Açıklama</label>
							<textarea class="form-control" id="aciklama" >
								
							     </textarea>
							</div>
							</div>
							
							
						</form>
     
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="gorevOlusturBtn">Görevi Oluştur </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
      </div>
    </div>

  </div>
</div>';






?>
  
<style>
#datepicker3{z-index:1151 !important;}
#datepicker4{z-index:1151 !important;}
</style>
<script>
function kontrol(gAd,sAd,sorumlu,basTarih,bitTarih,not){


	if(gAd.length && sAd.length && sorumlu.length && basTarih.length && bitTarih.length )

		ekle(gAd,sAd,sorumlu,basTarih,bitTarih,not);
	
	else{
		alert("Lütfen işaretli alanları doldurunuz");
	}

}

function ekle(gAd,sAd,sorumlu,basTarih,bitTarih,not)
{
	crID=<?php echo $_SESSION['k_id']; ?>;
	procID=<?php echo $procID; ?>;
	var datastring="gAd="+gAd+"&sAd="+sAd+"&basTarih="+basTarih+"&sorumlu="+sorumlu+"&bitTarih="+bitTarih+"&not="+not+"&creatorID="+crID;
$.ajax({
            type: "POST",
                    url: "../fonksiyonlar/newwork.php",      
                    data: datastring,
                    success:function(response){
                    	if(response=="true")
                    	{
                    		
                    		alert("Görev oluşturuldu");
                    		window.location="http://msprojectodev.tk/pages/editprocess.php?procID="+procID;
                    	}
                    	else
                    	{
                    		alert(response);
                    	}
}

});
}

$(function(){
	var d = new Date();
    var d1= new Date();

     srcBas=<?php echo '"'.$surecBilgi['startDate'].'"'; ?>;
 srcBasTarih=new Date(srcBas);

 srcBit=<?php echo '"'.$surecBilgi['finishDate'].'"'; ?>;
  srcBitTarih=new Date(srcBit);
$('#datepicker3').datepicker({
    dateFormat: "yy-mm-dd",
    minDate: srcBasTarih,
    maxDate: srcBitTarih,
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
     onSelect:function(date){

        var selectedDate = new Date(date);
            $('#datepicker4').attr("disabled",false);
            $('#datepicker4').attr("style","background-color:white");
            $('#datepicker4').datepicker("option","minDate",selectedDate);

    }
    });
    $('#datepicker4').datepicker({
    dateFormat: "yy-mm-dd",
  
    maxDate:srcBitTarih,
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
    });


    $("#gorevOlusturBtn").click(function(){
        gorevAd=$("#gorevAd").val();
    	surecAd=$("#surecAd").val();
    	sorumluKisi=$("#sorumluKisi").val();
    	basTarih=$("#datepicker3").val();
    	bitTarih=$("#datepicker4").val();
    	
    	not=$("#aciklama").val();
       
    	kontrol(gorevAd,surecAd,sorumluKisi,basTarih,bitTarih,not);


    });
});

    </script>

