<?php
require('../connectDB.php');

if(isset($_POST['vards'])){
    // Sanitize inputs
    $vards = mysqli_real_escape_string($savienojums, $_POST['vards']);
    $uzvards = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
    $epasts = mysqli_real_escape_string($savienojums, $_POST['epasts']);
    $talrunis = mysqli_real_escape_string($savienojums, $_POST['talrunis']);
    $datums = mysqli_real_escape_string($savienojums, $_POST['datums']);
    $laiks = mysqli_real_escape_string($savienojums, $_POST['laiks']);
    $komentari = mysqli_real_escape_string($savienojums, $_POST['komentari']);
    $auto_tiriba = mysqli_real_escape_string($savienojums, $_POST['auto_tiriba']);
    $bildes = mysqli_real_escape_string($savienojums, $_POST['bildes']);

    // Insert into pieteikumi table
    $add_pieteikumi_SQL = "
        INSERT INTO pieteikumi (vards, uzvards, epasts, talrunis, datums, laiks, komentari, auto_tiriba, bildes) 
        VALUES ('$vards', '$uzvards', '$epasts', '$talrunis', '$datums', '$laiks', '$komentari', '$auto_tiriba', '$bildes')";
    $add_pieteikumi_result = mysqli_query($savienojums, $add_pieteikumi_SQL);

    if(!$add_pieteikumi_result){
        die("Kļūda!".mysqli_error($savienojums));
    }

    $submission_id = mysqli_insert_id($savienojums);

    // Insert tags
    if(isset($_POST['tags'])){
        $tags = $_POST['tags'];
        foreach($tags as $tag_id){
            $insert_tag_SQL = "INSERT INTO pieteikumi_tags (submission_id, tag_id) VALUES ($submission_id, $tag_id)";
            mysqli_query($savienojums, $insert_tag_SQL);
        }
    }

    echo "Pieteikums pievienots!";
}
?>