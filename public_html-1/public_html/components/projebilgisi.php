<?php 

$projebilgiKomut="SELECT * from project where projectID=".$prjID;
$projebilgileri=mysqli_fetch_array(mysqli_query($baglanti,$projebilgiKomut));
$projebilgiAd=$projebilgileri['projectName'];

$tamamlanmakomut="SELECT projectID,CAST(AVG(complateRate) AS SIGNED) as 'proje_ortalaması' FROM process where projectID=".$prjID." and parentID=0 GROUP BY parentID";
$tamamlanmaOrani=mysqli_fetch_array(mysqli_query($baglanti,$tamamlanmakomut))[1];



echo '<div class="row"><div class="col-md-4">
<h2>Proje Bilgisi </h2>
<p>Proje Adı:'.$projebilgiAd.'</p>';
if($tamamlanmaOrani>=0 && $tamamlanmaOrani<25 )
{
	echo '<div class="progress">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$tamamlanmaOrani.'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$tamamlanmaOrani.'%">
    '.$tamamlanmaOrani.'%
  </div>
</div>';
}
else if($tamamlanmaOrani>=25 && $tamamlanmaOrani )
{
	echo '<div class="progress">
  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="'.$tamamlanmaOrani.'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$tamamlanmaOrani.'%">
    '.$tamamlanmaOrani.'%
  </div>
</div>';
}
else if($tamamlanmaOrani>=50 && $tamamlanmaOrani<75 )
{
	echo '<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$tamamlanmaOrani.'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$tamamlanmaOrani.'%">
    '.$tamamlanmaOrani.'%
  </div>
</div>';
}
else
{
		echo '<div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$tamamlanmaOrani.'"
  aria-valuemin="0" aria-valuemax="100" style="width:'.$tamamlanmaOrani.'%">
    '.$tamamlanmaOrani.'%
  </div>
</div>';
}
echo '</div>';


echo '<div class="col-md-7">
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#createprocess">Süreç Oluştur</button>


</div></div>';
include($_SERVER['DOCUMENT_ROOT']."/components/surecolustur.php");









?>
<script>
$(function(){
$("#surecleri-duzenle").click(function(){
window.location="http://msprojectodev.tk/pages/editprocess.php";

});

});

</script>