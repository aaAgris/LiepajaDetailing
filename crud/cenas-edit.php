<?php
require('../connectDB.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $nosaukums = mysqli_real_escape_string($savienojums, $_POST['nosaukums']);
    $apraksts = mysqli_real_escape_string($savienojums, $_POST['apraksts']);
    $cena1 = mysqli_real_escape_string($savienojums, $_POST['cena1']);
    $cena2 = mysqli_real_escape_string($savienojums, $_POST['cena2']);
    $statuss = mysqli_real_escape_string($savienojums, $_POST['statuss']);

    $query = "UPDATE cenas 
              SET darbs = '$nosaukums', apraksts = '$apraksts', cena1 = '$cena1', cena2 = '$cena2', statuss = '$statuss'
              WHERE id = $id";

    if (mysqli_query($savienojums, $query)) {
        echo "Cena veiksmīgi labota!";
    } else {
        echo "Kļūda: " . mysqli_error($savienojums);
    }
}

mysqli_close($savienojums);
?>
