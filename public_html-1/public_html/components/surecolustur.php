<?php 
$calisankomut="SELECT u.userID,u.userName  FROM users u inner join usersRoles ur on u.userID=ur.userID and ur.authTypeID<>1 ";
$calisansorgu=mysqli_query($baglanti,$calisankomut);

echo '<div id="createprocess" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Süreç Oluştur</h4>
      </div>
      <div class="modal-body">
        <form class="form">
							<div class="form-group">
							<label for="surecAd">*Süreç Adı</label>
							<input class="form-control" type="text" placeholder="Süreç adını giriniz" id="surecAd" required>
							</div>
							<div class="form-group">
							<label for="projectManager">*Sorumlu kişi ekle</label>
							<select class="form-control" id="sorumluKisi" >
								';
								while($sonuclar=mysqli_fetch_array($calisansorgu))
								{
									echo '<option>'.$sonuclar['userName'].'</option>';
							    
								}
								echo '
								 </select>
							</div>
							<div class="form-group">
							<label for="projectName">*Başlangıç Tarihi</label>
 								<div class="input-group date"  >
 								
            						<input type="text" readonly="true" style="background-color:white;" class="form-control" id="datepicker4" data-date-format="YYYY-MM-DD"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
        						</div>	
        					</div>	 
							<div class="form-group">
							<label for="projectName">*Bitiş Tarihi</label>
 								<div class="input-group date" >
            						<input type="text" id="datepicker5"  readonly="true" class="form-control" data-date-format="YYYY-MM-DD"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
        						</div>		 
							
							</div>
							
								<div class="form-group">
							<label for="notlar">Notlar</label>
							<textarea class="form-control" id="notlar" >
								
							     </textarea>
							</div>
							</div>
							
							
						</form>
     
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" id="surecOlusturBtn">Süreci Oluştur </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
      </div>
    </div>

  </div>
</div>';






?>
    
<style>
#datepicker4{z-index:1151 !important;}
#datepicker5{z-index:1151 !important;}
</style>
<script>

function kontrol(pAd,pYon,basTarih,bitTarih){


	if(pAd.length && pYon.length && basTarih.length && bitTarih.length )

		ekle(pAd,pYon,basTarih,bitTarih,not);
	
	else{
		alert("Lütfen işaretli alanları doldurunuz");
	}

}

function ekle(pAd,pYon,basTarih,bitTarih,not)
{
	crID=<?php echo $_SESSION['k_id']; ?>;
	prjID=<?php echo $prjID; ?>;
	var datastring="pAd="+pAd+"&pYon="+pYon+"&basTarih="+basTarih+"&bitTarih="+bitTarih+"&not="+not+"&projID="+prjID+"&creatorID="+crID;
$.ajax({
            type: "POST",
                    url: "../fonksiyonlar/newprocess.php",      
                    data: datastring,
                    success:function(response){
                    	if(response=="true")
                    	{
                    		
                    		alert("Process oluşturuldu");
                    		window.location="http://msprojectodev.tk/pages/project.php?prj_id="+prjID;
                    	}
                    	else
                    	{
                    		alert("Hata");
                    	}
}

});
}
$(function(){

     $(".date").delegate("input[type=text].form-control", "focusin", function(){
        $(this).datepicker();
    });
	var d = new Date();
    var d1= new Date();
     prjBas=<?php echo '"'.$projebilgileri['startDate'].'"'; ?>;
 prjBasTarih=new Date(prjBas);

 prjBit=<?php echo '"'.$projebilgileri['finishDate'].'"'; ?>;
  prjBitTarih=new Date(prjBit);

$('#datepicker5').datepicker({
        useCurrent: false,
    dateFormat: "yy-mm-dd",
   
    maxDate: prjBitTarih,
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
    });


    $('#datepicker4').datepicker({
    dateFormat: "yy-mm-dd",
    minDate:prjBasTarih,
    
    maxDate: prjBitTarih,
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true,
    onSelect:function(date){

        var selectedDate = new Date(date);
            $('#datepicker5').attr("disabled",false);
            $('#datepicker5').attr("style","background-color:white");
            $('#datepicker5').datepicker("option","minDate",selectedDate);

    }
    });




  
    


    $("#surecOlusturBtn").click(function(){
    	surecAd=$("#surecAd").val();
    	sorumluKisi=$("#sorumluKisi").val();
    	basTarih=$("#datepicker4").val();
    	bitTarih=$("#datepicker5").val();
    	
    	not=$("#notlar").val();
        
         
    
    	kontrol(surecAd,sorumluKisi,basTarih,bitTarih);
                

    });
});

    </script>

