
		<?php 
		include($_SERVER['DOCUMENT_ROOT']."/components/ust-menu.php");
		include($_SERVER['DOCUMENT_ROOT']."/components/bekleyenprojeler.php");
		include($_SERVER['DOCUMENT_ROOT']."/components/gorevlerim.php");
		?>
		
		

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
    var d = new Date();
    var d1= new Date();
    d1.getDay()+1;
    $('#datepicker1').datepicker({
    format: "yyyy/mm/dd",
    startDate: d,
    endDate: "2019-01-01",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
    });
    $('#datepicker2').datepicker({
    format: "yyyy/mm/dd",
    startDate: d1,
    endDate: "2019-01-01",
    todayBtn: "linked",
    autoclose: true,
    todayHighlight: true
    });

    $("#projeOlusturBtn").click(function(){
    	var ad= $("#projeAd").val();
    	var yon= $("#projeYoneticisi").val();

			var date1 = $("#datepicker1 input").val();
			var date2 = $("#datepicker2 input").val();
    	var b= $("#butce").val();
		kontrol(ad,yon,date1,date2,b);
    });
function kontrol(pAd,pYon,basTarih,bitTarih,but){


	if(pAd.length && pYon.length && basTarih.length && bitTarih.length && but.length)
	alert("tamam"+basTarih+bitTarih);
	
	else{
		alert("hata"+basTarih+bitTarih);
	}

}

    </script>


        
