<?php
    require('../connectDB.php');
    session_start();

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $delete_darbs_SQL = "DELETE FROM darbi WHERE darbs_id = $id";
        $delete_darbs_result = mysqli_query($savienojums, $delete_darbs_SQL);

        if(!$delete_darbs_result){
            die("Kļūda!".mysqli_error($savienojums));
        }

        echo "Veiksmīgi dzēsts!";
    }
?>