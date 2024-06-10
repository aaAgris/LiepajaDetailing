<?php
require('../connectDB.php');

if(isset($_POST['id'])) {
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $select_cv_SQL = "SELECT * FROM vakances_pieteikumi WHERE id = $id";
    $select_cv_result = mysqli_query($savienojums, $select_cv_SQL);

    if(!$select_cv_result) {
        die("Kļūda!" . mysqli_error($savienojums));
    }

    $cv = mysqli_fetch_assoc($select_cv_result);
    echo json_encode($cv);
}
?>
