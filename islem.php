
<?php

require_once 'baglan.php';

    if(isset($_POST['post-sehir-button'])){
        $form_ilk_sehir = intval($_POST['sehir-1']); 
        $form_ikinci_sehir = intval($_POST['sehir-2']); 
        echo "1.Şehir : ".$form_ilk_sehir . "<br>"; 
        
        echo "2.Şehir : ".$form_ikinci_sehir;

  $birinci_sehir_id=$db->prepare("SELECT * from sehir_bilgileri WHERE sehir_id= $form_ilk_sehir");
  $birinci_sehir_id->execute();
  $birinci_sehir_id_cek = $birinci_sehir_id->fetch(PDO::FETCH_ASSOC);
  echo "<pre> database den gelen id : -> ";
  print_r($birinci_sehir_id_cek['sehir_id']);
  echo "<pre>";

  $ikinci_sehir_id=$db->prepare("SELECT * from sehir_bilgileri WHERE sehir_id= $form_ikinci_sehir");
  $ikinci_sehir_id->execute();
  $ikinci_sehir_id_cek = $ikinci_sehir_id->fetch(PDO::FETCH_ASSOC);
  echo "<pre> database den gelen id : -> ";
  print_r($ikinci_sehir_id_cek['sehir_id']);
  echo "<pre>";

  echo "mesafe: " . calculateKusUcusuMesafe($birinci_sehir_id_cek, $ikinci_sehir_id_cek);

         

       

    }
    else{
        echo "Hata";
    }


    function calculateKusUcusuMesafe($sehir1Bilgileri, $sehir2Bilgileri)
{
    $lat1 = deg2rad($sehir1Bilgileri['latitude']);
    $lon1 = deg2rad($sehir1Bilgileri['longitude']);
    $lat2 = deg2rad($sehir2Bilgileri['latitude']);
    $lon2 = deg2rad($sehir2Bilgileri['longitude']);

    $r = 6371; // Dünya'nın yarıçapı (km)

    $deltaLat = $lat2 - $lat1;
    $deltaLon = $lon2 - $lon1;

    $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1) * cos($lat2) * sin($deltaLon / 2) * sin($deltaLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    $distance = $r * $c;

    return $distance;
}

?>

