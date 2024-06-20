<?php
require("../connectDB.php");

$lietotajvards = mysqli_real_escape_string($savienojums, $_POST['lietotajvards']);
$vards = mysqli_real_escape_string($savienojums, $_POST['vards']);
$uzvards = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
$epasts = mysqli_real_escape_string($savienojums, $_POST['epasts']);
$parole = password_hash($_POST['parole'], PASSWORD_BCRYPT);
$loma = mysqli_real_escape_string($savienojums, $_POST['loma']);
$statuss = mysqli_real_escape_string($savienojums, $_POST['statuss']);

$query = "INSERT INTO users (lietotajvards, vards, uzvards, epasts, parole, loma, statuss) VALUES ('$lietotajvards', '$vards', '$uzvards', '$epasts', '$parole', '$loma', '$statuss')";

if (mysqli_query($savienojums, $query)) {
    echo "New user created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($savienojums);
}

mysqli_close($savienojums);
?>
