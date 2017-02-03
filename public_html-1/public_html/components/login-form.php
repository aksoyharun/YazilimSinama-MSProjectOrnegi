<?php 
echo "
<div class='container center_div'>
    <div class='row vertical-center-row'>
        <div class='col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4'>
        <img class='img img-responsive' alt='Hb proje yönetim sistemi logosu' src='".$_SERVER['SERVER_ROOT']."assets/img/logo.png'>
<form class='form' id='giris-form'>
<div class='form-group'>
<label for='k_adi_input'>Kullanıcı Adı </label>
<input type='text' class='form-control' id='k_adi_input' maxlength='16' placeholder='Kullanıcı adınızı giriniz..' required>
</div>
<div class='form-group'>
<label for='k_sifre_input'>Şifre </label>
<input type='password' class='form-control' maxlength='16' id='k_sifre_input' placeholder='Şifrenizi giriniz..' required>
</div>

</form>
<button type='click' class='btn btn-block btn-primary' id='btn-giris'>Giriş </button>
<div  id='alert-bolum' style='display:none;' class='alert alert-danger'>
  <strong>Uyarı!</strong> <p   id='alert-mesaj'></p>
</div>
</div>
    </div>
</div>
";






?>
<script>
$(function(){
uyaribolum=$("#alert-bolum");
uyaritext=$("#alert-mesaj");

function girisYap(k_ad,sifre)
{

	var datastring="k_ad="+k_ad+"&sifre="+sifre;
 $.ajax({
                    type: "POST",
                    url: "../fonksiyonlar/giris.php",      
                    data: datastring,
                    success:function(response){
                    	if(response=="true")
                    	{

                    		

                              $("#btn-giris").text("Giriş Başarılı!");
                 $("#btn-giris").attr("class","btn btn-block btn-success btn-");
                    		
                    		window.location="http://msprojectodev.tk/pages/dashboard.php";
                    	}
                    	else
                    	{
                    		alert("Kullanıcı adı veya şifre yanlış");
                    	}

                    }
                    
                });
}
function kontrol(k_ad,sifre)
{

	if(k_ad.length && sifre.length)
	{
		if(k_ad.length>=8 && k_ad.length<=16 && sifre.length>=8 && sifre.length<=16)
		{

			if(/^[a-zA-Z0-9- ]*$/.test(k_ad) != false && /^[a-zA-Z0-9- ]*$/.test(sifre) != false)
            {
               

				girisYap(k_ad,sifre);
            }
			else{
				uyaribolum.show();
		uyaritext.text("Parola ve şifre bölümüne özel karakter girilemez");
			}
		}

		else
		{
			uyaribolum.show();
		uyaritext.text("Kullanıcı adı ve şifre 8-16 karakter uzunluğunda olmalıdır");
		}
		
	}
	else
	{
		uyaribolum.show();
		uyaritext.text("Lütfen tüm alanları doldurunuz");
	}

}


$("#btn-giris").click(function(){
kontrol($("#k_adi_input").val(),$("#k_sifre_input").val());
});

$("#k_adi_input").keyup(function(event){
    if(event.keyCode == 13){
        $("#btn-giris").click();
    }
});

$("#k_sifre_input").keyup(function(event){
    if(event.keyCode == 13){
        $("#btn-giris").click();
    }
});





});

</script>