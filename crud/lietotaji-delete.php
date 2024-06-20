<?php
require("../connectDB.php");

$id = mysqli_real_escape_string($savienojums, $_POST['id']);

$query = "UPDATE users SET statuss='deleted' WHERE id = $id";

if (mysqli_query($savienojums, $query)) {
    echo "User deleted successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($savienojums);
}

mysqli_close($savienojums);
?>
