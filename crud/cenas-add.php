<?php
require('../connectDB.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nosaukums = mysqli_real_escape_string($savienojums, $_POST['nosaukums']);
    $apraksts = mysqli_real_escape_string($savienojums, $_POST['apraksts']);
    $cena1 = mysqli_real_escape_string($savienojums, $_POST['cena1']);
    $cena2 = mysqli_real_escape_string($savienojums, $_POST['cena2']);
    $statuss = mysqli_real_escape_string($savienojums, $_POST['statuss']);
    $tips = mysqli_real_escape_string($savienojums, $_POST['tips']);

    $query = "INSERT INTO cenas (darbs, apraksts, cena1, cena2, statuss, tips) VALUES ('$nosaukums', '$apraksts', '$cena1', '$cena2', '$statuss','$tips')";

    if (mysqli_query($savienojums, $query)) {
        echo "Cena veiksmīgi pievienota!";
    } else {
        echo "Kļūda: " . mysqli_error($savienojums);
    }
}

mysqli_close($savienojums);
?>
