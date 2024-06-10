<?php
require('../connectDB.php');

if(isset($_POST['id'])) {
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $delete_cv_SQL = "DELETE FROM vakances_pieteikumi WHERE id = $id";
    $delete_cv_result = mysqli_query($savienojums, $delete_cv_SQL);

    if(!$delete_cv_result) {
        die("Kļūda!" . mysqli_error($savienojums));
    }

    echo "CV successfully deleted";
}
?>
