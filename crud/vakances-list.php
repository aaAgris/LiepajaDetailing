<?php
require('../connectDB.php');

$select_vacancies_SQL = "SELECT * FROM vacancies ORDER BY id DESC";
$select_vacancies_result = mysqli_query($savienojums, $select_vacancies_SQL);

if (!$select_vacancies_result) {
    die("Kļūda!");
}

$json = array();
while ($row = mysqli_fetch_array($select_vacancies_result)) {
    $json[] = array(
        'id' => $row['id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'wage' => $row['wage'],
        'wage2' => $row['wage2'],
        'statuss' => $row['statuss']
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>
