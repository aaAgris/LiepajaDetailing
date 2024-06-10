<?php
require("../connectDB.php");

if(isset($_POST['id'])){
    // Sanitize and escape input data
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $title = mysqli_real_escape_string($savienojums, $_POST['title']);
    $description = mysqli_real_escape_string($savienojums, $_POST['description']);
    $wage = mysqli_real_escape_string($savienojums, $_POST['wage']);
    $wage2 = mysqli_real_escape_string($savienojums, $_POST['wage2']);
    $statuss = mysqli_real_escape_string($savienojums, $_POST['statuss']);

    // Create the query to update the vacancy
    $query = "UPDATE vacancies SET 
        title='$title',
        description='$description',
        wage='$wage',
        wage2='$wage2',
        statuss='$statuss'
        WHERE id='$id'";

    // Execute the query
    if (mysqli_query($savienojums, $query)) {
        echo "Vacancy updated successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($savienojums);
    }

    // Close the database connection
    mysqli_close($savienojums);
}
?>
