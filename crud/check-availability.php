<?php
require("../connectDB.php");

if (isset($_GET['date'])) {
    $date = mysqli_real_escape_string($savienojums, $_GET['date']);

    // Check if selected date is a weekday (Monday to Friday)
    $weekday = date('N', strtotime($date)); // 1 (Monday) to 7 (Sunday)
    if ($weekday >= 1 && $weekday <= 5) {
        // Query to retrieve booked times for the selected date
        $query = "SELECT laiks FROM pieteikumi WHERE datums = '$date'";
        $result = mysqli_query($savienojums, $query);

        if ($result) {
            $booked_times = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $booked_times[] = $row['laiks'];
            }
            echo json_encode($booked_times);
        } else {
            echo json_encode(array('error' => 'Database error: ' . mysqli_error($savienojums)));
        }
    } else {
        echo json_encode(array('error' => 'Selected date is not a weekday.'));
    }
} else {
    echo json_encode(array('error' => 'Date parameter is missing'));
}

mysqli_close($savienojums);
?>