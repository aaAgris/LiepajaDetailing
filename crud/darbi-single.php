<?php
    require('../connectDB.php');

    if(isset($_POST['darbaID'])){
        $id = mysqli_real_escape_string($savienojums, $_POST['darbaID']);
        $select_darbs_SQL = "SELECT * FROM darbi WHERE darbs_id = $id";
        $select_darbs_result = mysqli_query($savienojums, $select_darbs_SQL);

        if(!$select_darbs_result){
            die("Kļūda!".mysqli_error($savienojums));
        }

        $json = array();
    
        while($row = mysqli_fetch_array($select_darbs_result)){
            $json[] = array(
                'darbs' => $row['darbs_vards'],
                'apraksts' => $row['darbs_uzvards'],
                'attels' => $row['darbs_epasts'],
                'statuss' => $row['darbs_statuss'],
                'id' => $row['darbs_id']
            );
        }

        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
?>