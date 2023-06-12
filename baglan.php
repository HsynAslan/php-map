<?php

try{
    $db = new PDO("mysql:host=localhost;dbname=sehir-bilgileri;charset=utf8",'root', '92H91a00');
    // echo "Veritabanına bağlantı sağlandı";

    
}
catch (PDOExpception $e){
    echo $e->getMessage();  
}

?>