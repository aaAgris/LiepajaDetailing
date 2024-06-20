<?php
require('../connectDB.php');

if(isset($_POST['id'])) {
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $query = "SELECT * FROM cenas WHERE id = $id";
    $result = mysqli_query($savienojums, $query);

    if(!$result) {
        die("Kļūda: " . mysqli_error($savienojums));
    }

    $cena = mysqli_fetch_assoc($result);
    echo json_encode($cena);
}

mysqli_close($savienojums);
?>