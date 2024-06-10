<?php
require('../connectDB.php');

if(isset($_POST['id'])) {
    // Sanitize input
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $vards = mysqli_real_escape_string($savienojums, $_POST['vards']);
    $uzvards = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
    $epasts = mysqli_real_escape_string($savienojums, $_POST['epasts']);
    $talrunis = mysqli_real_escape_string($savienojums, $_POST['talrunis']);
    $datums = mysqli_real_escape_string($savienojums, $_POST['datums']);
    $statuss = mysqli_real_escape_string($savienojums, $_POST['statuss']);

    $update_cv_SQL = "
        UPDATE vakances_pieteikumi 
        SET 
            vards = '$vards', 
            uzvards = '$uzvards', 
            epasts = '$epasts', 
            talrunis = '$talrunis', 
            datums = '$datums',
            statuss = '$statuss'
        WHERE id = $id";
    $update_cv_result = mysqli_query($savienojums, $update_cv_SQL);

    if(!$update_cv_result) {
        die("Kļūda!" . mysqli_error($savienojums));
    }

    echo "CV successfully updated";
}
?>
