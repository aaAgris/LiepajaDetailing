<?php
require('../connectDB.php');

if(isset($_POST['vards']) && isset($_POST['uzvards']) && isset($_POST['epasts']) && isset($_POST['talrunis']) && isset($_POST['datums']) && isset($_POST['statuss'])) {
    $vards = mysqli_real_escape_string($savienojums, $_POST['vards']);
    $uzvards = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
    $epasts = mysqli_real_escape_string($savienojums, $_POST['epasts']);
    $talrunis = mysqli_real_escape_string($savienojums, $_POST['talrunis']);
    $datums = mysqli_real_escape_string($savienojums, $_POST['datums']);
    $statuss = mysqli_real_escape_string($savienojums, $_POST['statuss']);

    $insert_cv_SQL = "INSERT INTO vakances_pieteikumi (vards, uzvards, epasts, talrunis, datums, statuss) VALUES ('$vards', '$uzvards', '$epasts', '$talrunis', '$datums', '$statuss')";
    $insert_cv_result = mysqli_query($savienojums, $insert_cv_SQL);

    if(!$insert_cv_result) {
        die("Kļūda!" . mysqli_error($savienojums));
    }

    echo "CV successfully added";
}
?>
