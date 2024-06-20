<?php
require('../connectDB.php');
session_start();

if(isset($_POST['id'])){ // Changed to 'id' to match JavaScript
    $darbs_id = $_POST['id'];
    $darbs_nosaukums = $_POST['nosaukums'];
    $darbs_apraksts = $_POST['apraksts'];
    $darbs_attels = $_POST['attels'];
    $darbs_statuss = $_POST['statuss'];
    $darbs_tips = $_POST['tips'];

    $update_darbs_SQL = "UPDATE darbi SET 
        darbs_nosaukums = '$darbs_nosaukums',
        darbs_apraksts = '$darbs_apraksts',
        darbs_attels = '$darbs_attels',
        tips = '$darbs_tips',
        darbs_statuss = '$darbs_statuss' WHERE darbs_id = $darbs_id";
    $update_darbs_result = mysqli_query($savienojums, $update_darbs_SQL);

    if(!$update_darbs_result){
        die("Kļūda!".mysqli_error($savienojums));
    }
}
?>
