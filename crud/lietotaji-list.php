<?php
require("../connectDB.php");

$select_users_SQL = "SELECT * FROM users ORDER BY id DESC";
$select_users_result = mysqli_query($savienojums, $select_users_SQL);

if (!$select_users_result) {
    die("Kļūda!");
}

$json = array();
while ($row = mysqli_fetch_array($select_users_result)) {
    $json[] = array(
        'id' => $row['id'],
        'lietotajvards' => $row['lietotajvards'],
        'vards' => $row['vards'],
        'uzvards' => $row['uzvards'],
        'epasts' => $row['epasts'],
        'loma' => $row['loma'],
        'statuss' => $row['statuss']
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>
