<?php
require("../connectDB.php");

$id = mysqli_real_escape_string($savienojums, $_POST['id']);

$query = "DELETE FROM vacancies WHERE id='$id'";

if (mysqli_query($savienojums, $query)) {
    echo "Vacancy deleted successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($savienojums);
}

mysqli_close($savienojums);
?>