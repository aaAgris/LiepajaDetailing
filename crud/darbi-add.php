<?php
    require('../connectDB.php');
    session_start();

    if(isset($_POST['id'])){ // ?
        $darba_id = $_POST['id'];
        $darba_nosaukums = $_POST['nosaukums'];
        $darba_apraksts = $_POST['apraksts'];
        $darba_attels = $_POST['attels'];
        $darba_tips = $_POST['tips'];
        $darba_statuss = $_POST['statuss'];

        
        $add_darbs_SQL = "INSERT INTO darbi(darbs_nosaukums, darbs_apraksts, darbs_attels, tips) VALUES ('$darba_nosaukums', '$darba_apraksts', '$darba_attels', '$darba_tips')";

        $add_darbs_result = mysqli_query($savienojums, $add_darbs_SQL);

        if(!$add_darbs_result){
            die("Kļūda!".mysqli_error($savienojums));
        }

        echo "Kurss pievienots!";
    }
?>