<?php
require("../connectDB.php");

if(isset($_POST['id'])){
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $lietotajvards = mysqli_real_escape_string($savienojums, $_POST['lietotajvards']);
    $vards = mysqli_real_escape_string($savienojums, $_POST['vards']);
    $uzvards = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
    $epasts = mysqli_real_escape_string($savienojums, $_POST['epasts']);
    $loma = mysqli_real_escape_string($savienojums, $_POST['loma']);
    $statuss = mysqli_real_escape_string($savienojums, $_POST['statuss']);

    $query = "UPDATE users SET 
        lietotajvards='$lietotajvards',
        vards='$vards',
        uzvards='$uzvards',
        epasts='$epasts',
        loma='$loma',
        statuss='$statuss'";

    if (!empty($_POST['parole'])) {
        $parole = password_hash($_POST['parole'], PASSWORD_BCRYPT);
        $query .= ", parole='$parole'";
    }

    $query .= " WHERE id='$id'";

    if (mysqli_query($savienojums, $query)) {
        echo "User updated successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($savienojums);
    }

    mysqli_close($savienojums);
}
?>
