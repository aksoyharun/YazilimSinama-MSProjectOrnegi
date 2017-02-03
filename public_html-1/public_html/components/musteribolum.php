
<?php 
include($_SERVER['DOCUMENT_ROOT']."/components/ust-menu.php");

?>
		<div class="page-header">
		<h1> PANEL </h1>
	</div>
	
		
			
		
		
			<div class="col-md-5">
			
				<div class="panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
        					Proje Oluştur
     					 </h4>
						
					</div>
					
					<div class="panel-body">
						<form class="form">
							<div class="form-group">
								<label for="projectName">Proje Adı</label>
								<input class="form-control" type="text" placeholder="Proje adını giriniz" id="projeAd" required>
							</div>
							<div class="form-group">
								<label for="projectManager">Proje Yöneticisi Seç</label>
								<select class="form-control" id="projeYoneticisi" >
									<?php 
										include($_SERVER['DOCUMENT_ROOT']."/baglanti.php");
										$listelekomut="SELECT u.userID, u.userName from usersRoles ur inner join users u on u.userID=ur.userID AND ur.roleNameID=2";
										$listelesorgu=mysqli_query($baglanti,$listelekomut);
										while($sonuclar=mysqli_fetch_array($listelesorgu))
										{
												echo '<option>'.$sonuclar['userName'].'</option>';
										}

								    ?>

								     </select>
							</div>
							<div class="form-group">
							<label for="projectName">Başlangıç Tarihi</label>
 								<div class="input-group date"  >
 								
            						<input type="text"  id="datepicker1" readonly="true" class="form-control" style="background-color:white;"   data-date-format="YYYY-MM-DD"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
        						</div>	
        					</div>	 
							<div class="form-group">
							<label for="projectName">Bitiş Tarihi</label>
 								<div class="input-group date" >
            						<input type="text" id="datepicker2" disabled="true" readonly="true"   class="form-control"  data-date-format="YYYY-MM-DD"><span class="input-group-addon" ><i class="glyphicon glyphicon-th"></i></span>
        						</div>		 
							
							</div>
							<div class="form-group">
							<label for="budget">Proje Bütçesi</label>
							<input type="number" min="0.01" step="0.01" max="2500" value="00.00" class="form-control" placeholder="Proje bütçesini giriniz" id="butce" required>
							</div>
							<button type="button" class="btn btn-primary" id="projeOlusturBtn">Projeyi Oluştur </button>
							
						</form>
					</div>
				  </div>
					
				</div>

			
				
			</div>
			


   
    <script>
$(function(){


    var d = new Date();
   






$('#datepicker2').datepicker({
    	useCurrent: false,
    dateFormat: "yy-mm-dd",
    startDate:d,
    endDate: "2019-01-01",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
    });


    $('#datepicker1').datepicker({
    dateFormat: "yy-mm-dd",
    minDate:d,
    startDate: d,
    endDate: "2019-01-01",
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
    


 

    
     


    $("#projeOlusturBtn").click(function(){
    	var ad= $("#projeAd").val();
    	var yon= $("#projeYoneticisi").val();

			 var date1 = $("#datepicker1").val();
			var date2 = $("#datepicker2").val();
          var b= $("#butce").val();
        
		kontrol(ad,yon,date1,date2,b);
		
		
		
    });
function kontrol(pAd,pYon,basTarih,bitTarih,but){


	if(pAd.length && pYon.length && basTarih.length && bitTarih.length && but.length)
	projeOlustur(pAd,pYon,basTarih,bitTarih,but);

	
	else{
		alert("Lütfen tüm alanları eksiksiz doldurunuz");
	}

}
function projeOlustur(pAd,pYon,basTarih,bitTarih,but){
	userID=<?php echo $_SESSION['k_id'];?>;
	var datastring="pAd="+pAd+"&pYon="+pYon+"&basTarih="+basTarih+"&bitTarih="+bitTarih+"&but="+but+"&u_id="+userID;
	$.ajax({
				
					type: "POST",
                    url: "../fonksiyonlar/newproject.php",      
                    data: datastring,
                    success:function(response){
                    	if(response=="true")
                    	{
                    		
                    		alert("Proje oluşturma başarılı");
                    		
                    		window.location="http://msprojectodev.tk/pages/dashboard.php";
                    	}
                    	else
                    	{
                    		alert("hata var");
                    	}


	
}
});
}
});
    </script>




        
