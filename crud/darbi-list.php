<?php
    require('../connectDB.php');

    // Join the darbi and veicdarbi tables to get the corresponding darbs name
    $select_darbi_SQL = "SELECT darbi.*, veicdarbi.darbs AS darbs_nosaukums 
                         FROM darbi 
                         JOIN veicdarbi ON darbi.darbs_nosaukums = veicdarbi.id 
                         ORDER BY darbi.darbs_id DESC";
    $select_darbi_result = mysqli_query($savienojums, $select_darbi_SQL);

    if(!$select_darbi_result){
        die("Kļūda!");
    }

    $json = array();
    while($row = mysqli_fetch_array($select_darbi_result)){
        $json[] = array(
            'darbs' => $row['darbs_nosaukums'],
            'apraksts' => $row['darbs_apraksts'],
            'attels' => $row['darbs_attels'],
            'statuss' => $row['darbs_statuss'],
            'tips' => $row['tips'],
            'id' => $row['darbs_id']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
