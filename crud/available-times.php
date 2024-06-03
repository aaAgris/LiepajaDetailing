<?php
require("connectDB.php");

if (isset($_POST['date'])) {
    $date = mysqli_real_escape_string($savienojums, $_POST['date']);
    
    $query = "SELECT laiks FROM pieteikumi WHERE datums = '$date'";
    $result = mysqli_query($savienojums, $query);
    
    $unavailable_times = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $unavailable_times[] = $row['laiks'];
    }
    
    echo json_encode($unavailable_times);
}
?>