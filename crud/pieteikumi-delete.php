<?php
require('../connectDB.php');

if (isset($_POST['id'])) {
    // Sanitize the input
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);

    // Delete associated records from pieteikumi_tags
    $delete_tags_SQL = "DELETE FROM pieteikumi_tags WHERE submission_id = $id";
    $delete_tags_result = mysqli_query($savienojums, $delete_tags_SQL);

    if (!$delete_tags_result) {
        die("Kļūda dzēšot saistītos ierakstus no pieteikumi_tags: " . mysqli_error($savienojums));
    }

    // Delete the record from pieteikumi
    $delete_pieteikumi_SQL = "DELETE FROM pieteikumi WHERE id = $id";
    $delete_pieteikumi_result = mysqli_query($savienojums, $delete_pieteikumi_SQL);

    if (!$delete_pieteikumi_result) {
        die("Kļūda dzēšot pieteikumu: " . mysqli_error($savienojums));
    }

    echo "Veiksmīgi dzēsts!";
} else {
    echo "ID nav norādīts.";
}
?>