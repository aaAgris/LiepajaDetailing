<?php
require('../connectDB.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);

    $query = "DELETE FROM cenas WHERE id=$id";

    if (mysqli_query($savienojums, $query)) {
        echo "Cena veiksmīgi izdzēsta!";
    } else {
        echo "Kļūda: " . mysqli_error($savienojums);
    }
}

mysqli_close($savienojums);
?>
