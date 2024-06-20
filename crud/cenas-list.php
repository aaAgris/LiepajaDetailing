<?php
require('../connectDB.php');

$query = "SELECT cenas.id, veicdarbi.darbs, cenas.apraksts, cenas.cena1, cenas.cena2, cenas.statuss 
          FROM cenas 
          JOIN veicdarbi ON cenas.darbs = veicdarbi.id";
$result = mysqli_query($savienojums, $query);

$cenas = array();
while ($row = mysqli_fetch_assoc($result)) {
    $cenas[] = $row;
}

echo json_encode($cenas);

mysqli_close($savienojums);
?>