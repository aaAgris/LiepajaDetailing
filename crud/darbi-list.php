<?php
    require('../connectDB.php');
    
    $select_darbi_SQL = "SELECT * FROM darbi ORDER BY darbs_id DESC";
    $select_darbi_result = mysqli_query($savienojums, $select_darbi_SQL);

    if(!$select_darbi_result){
        die("Kļūda!");
    }

    while($row = mysqli_fetch_array($select_darbi_result)){
        $darb_Id = $row["darbs_id"];
        $select_darbs_SQL2 = "SELECT darbs FROM veicdarbi WHERE id = '$darb_Id'";
        $select_darbs_result1 = mysqli_query($savienojums, $select_darbs_SQL2);

        $darb = '';

        while($rowCena = mysqli_fetch_array( $select_darbs_result1)){
            $darb = $rowCena[0];
        }

        $json[] = array(
            'darbs' => $row['darbs_nosaukums'],
            // 'darbi' => $darb,
            'apraksts' => $row['darbs_apraksts'],
            'attels' => $row['darbs_attels'],
            'statuss' => $row['darbs_statuss'],
            'id' => $row['darbs_id']
        );
    }


    $jsonstring = json_encode($json);
    echo $jsonstring;
?>