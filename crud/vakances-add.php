<?php
require("../connectDB.php");

$title = mysqli_real_escape_string($savienojums, $_POST['title']);
$description = mysqli_real_escape_string($savienojums, $_POST['description']);
$wage = mysqli_real_escape_string($savienojums, $_POST['wage']);
$wage2 = mysqli_real_escape_string($savienojums, $_POST['wage2']);
$statuss = mysqli_real_escape_string($savienojums, $_POST['statuss']);

$query = "INSERT INTO vacancies (title, description, wage, wage2, statuss) VALUES ('$title', '$description', '$wage', '$wage2', '$statuss')";

if (mysqli_query($savienojums, $query)) {
    echo "New vacancy created successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($savienojums);
}

mysqli_close($savienojums);
?>
