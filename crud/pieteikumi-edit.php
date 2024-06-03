<?php
require('../connectDB.php');

if(isset($_POST['id'])){
    // Sanitize inputs
    $pieteikumi_id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $vards = mysqli_real_escape_string($savienojums, $_POST['vards']);
    $uzvards = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
    $epasts = mysqli_real_escape_string($savienojums, $_POST['epasts']);
    $talrunis = mysqli_real_escape_string($savienojums, $_POST['talrunis']);
    $datums = mysqli_real_escape_string($savienojums, $_POST['datums']);
    $laiks = mysqli_real_escape_string($savienojums, $_POST['laiks']);
    $komentari = mysqli_real_escape_string($savienojums, $_POST['komentari']);
    $auto_tiriba = mysqli_real_escape_string($savienojums, $_POST['auto_tiriba']);

    // Update pieteikumi table
    $update_pieteikumi_SQL = "
        UPDATE pieteikumi SET 
        vards = '$vards',
        uzvards = '$uzvards',
        epasts = '$epasts',
        talrunis = '$talrunis',
        datums = '$datums',
        laiks = '$laiks',
        komentari = '$komentari',
        auto_tiriba = '$auto_tiriba'
        WHERE id = $pieteikumi_id";
    $update_pieteikumi_result = mysqli_query($savienojums, $update_pieteikumi_SQL);

    if(!$update_pieteikumi_result){
        die("Kļūda!".mysqli_error($savienojums));
    }

    // Update tags
    $delete_tags_SQL = "DELETE FROM pieteikumi_tags WHERE submission_id = $pieteikumi_id";
    mysqli_query($savienojums, $delete_tags_SQL);

    if(isset($_POST['tags'])){
        $tags = $_POST['tags'];
        foreach($tags as $tag_id){
            $insert_tag_SQL = "INSERT INTO pieteikumi_tags (submission_id, tag_id) VALUES ($pieteikumi_id, $tag_id)";
            mysqli_query($savienojums, $insert_tag_SQL);
        }
    }

    echo "Pieteikums rediģēts!";
}
?>