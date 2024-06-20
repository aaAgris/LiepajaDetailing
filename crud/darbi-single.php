<?php
require('../connectDB.php');

if(isset($_POST['id'])){
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $select_darbs_SQL = "SELECT * FROM darbi WHERE darbs_id = $id";
    $select_darbs_result = mysqli_query($savienojums, $select_darbs_SQL);

    if(!$select_darbs_result){
        die("Kļūda!".mysqli_error($savienojums));
    }

    $row = mysqli_fetch_assoc($select_darbs_result);

    $darbs = array(
        'nosaukums' => $row['darbs_nosaukums'],
        'apraksts' => $row['darbs_apraksts'],
        'attels' => $row['darbs_attels'],
        'statuss' => $row['darbs_statuss'],
        'tips' => $row['tips'],
        'id' => $row['darbs_id']
    );

    $jsonstring = json_encode($darbs);
    echo $jsonstring;
}
?>
