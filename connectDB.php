<?php
    $servera_vards = "localhost";
    $lietotajvards = "root";
    $parole = "";
    $db_nosaukums = "liepajadetailing";

    $savienojums = mysqli_connect($servera_vards, $lietotajvards, $parole, $db_nosaukums);

    /*
    if(!$savienojums){
        die("Pieslēgties neizdevās: ".mysqli_connect_error());
    }else{
        echo "Savienojums izveidots!";
    }
    */
?>