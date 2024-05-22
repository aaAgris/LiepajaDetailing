<?php
    require('../connectDB.php');
    
    $select_cenas_SQL = "SELECT * FROM cenas ORDER BY id DESC";
    $select_cenas_result = mysqli_query($savienojums, $select_cenas_SQL);

    if(!$select_cenas_result){
        die("Kļūda!");
    }

    while($row = mysqli_fetch_array($select_cenas_result)){
        $darb_Id = $row["id"];
        $select_darbs_SQL2 = "SELECT darbs FROM veicdarbi WHERE id = '$darb_Id'";
        $select_darbs_result1 = mysqli_query($savienojums, $select_darbs_SQL2);

        $darb = '';

        while($rowCena = mysqli_fetch_array( $select_darbs_result1)){
            $darb = $rowCena[0];
        }

        $json[] = array(
            'darbs' => $row['darbs'],
            // 'darbi' => $darb,
            'apraksts' => $row['apraksts'],
            'cena1' => $row['cena1'],
            'cena2' => $row['cena2'],
            'statuss' => $row['statuss'],
            'id' => $row['id']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>