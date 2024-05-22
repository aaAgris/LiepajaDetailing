<?php
    require('../connectDB.php');
    session_start();

    if(isset($_POST['id'])){
        $darbs_id = $_POST['darbs_id'];
        $darbs_nosaukums = $_POST['darbs_nosaukums'];
        $darbs_apraksts = $_POST['darbs_apraksts'];
        $darbs_attels = $_POST['darbs_attels'];
        $darbs_statuss = $_POST['darbs_statuss'];

        
        $update_darbs_SQL = "UPDATE darbi SET 
        darbs_nosaukums = '$darbs_nosaukums',
        darbs_apraksts = '$darbs_apraksts',
        darbs_attels = '$darbs_attels',
        darbs_statuss = '$darbs_statuss' WHERE kursa_id = $darbs_id";
        $update_darbs_result = mysqli_query($savienojums, $update_darbs_SQL);

        if(!$update_darbs_result){
            die("Kļūda!".mysqli_error($savienojums));
        }

        echo "Kurss rediģēts!";
    }
?>