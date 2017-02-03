

<div class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#kucuk-ust-menu">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/pages/dashboard.php">HB PROJE YÖNETİM SİSTEMİ</a>
    </div>
    <div class="collapse navbar-collapse" id="kucuk-ust-menu">
     <ul class="nav navbar-nav">
     <?php 

     if($_SESSION['auth']==1)
     {
      echo ' <li ><a href="/pages/dashboard.php">Panel</a></li>
 
      
       <li><a href="/pages/activity.php">İşlem Geçmişi</a></li>';
     }

     else if($_SESSION['auth']==2)
     {
      echo ' <li ><a href="/pages/dashboard.php">Panel</a></li>
      <li><a href="/pages/projects.php">Projelerim</a></li>
      
     
      <li><a href="/pages/activity.php">İşlem Geçmişi</a></li>';
     }

     else if ($_SESSION['auth']==0)
     {
        echo ' <li ><a href="/pages/dashboard.php">Panel</a></li>
      
      
      <li><a href="/pages/activity.php">İşlem Geçmişi</a></li>'
      ;
     }
    else
    {
      echo'<li class="active"><a href="#">Yetki Yok</a></li>';
    }

     
     
    ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a ><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['k_ad']; ?></a></li>
      <li><a  id="cikis-btn"><span class="glyphicon glyphicon-log-in"></span> Çıkış</a></li>
    </ul>
    </div>
  </div>
</div>

<script>

$(function()
{
  
function cikisYap()
{
$.ajax({
      type:"POST",
      url:"../fonksiyonlar/cikis.php",
      success:function(data){
          window.location="http://msprojectodev.tk";
        }
      });
  

}
$("#cikis-btn").click(cikisYap);

});

</script>