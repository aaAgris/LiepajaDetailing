<?php
require('../connectDB.php');

$select_cvs_SQL = "
    SELECT c.*, v.title as vacancy_name
    FROM vakances_pieteikumi c
    LEFT JOIN vacancies v ON c.vacancy_id = v.id
    ORDER BY c.id DESC";
$select_cvs_result = mysqli_query($savienojums, $select_cvs_SQL);

if (!$select_cvs_result) {
    die("Kļūda!" . mysqli_error($savienojums));
}

$cvs = array();
while ($row = mysqli_fetch_array($select_cvs_result)) {
    $cvs[] = array(
        'id' => $row['id'],
        'vards' => $row['vards'],
        'uzvards' => $row['uzvards'],
        'epasts' => $row['epasts'],
        'talrunis' => $row['talrunis'],
        'datums' => $row['datums'],
        'statuss' => $row['statuss'],
        'vacancy_id' => $row['vacancy_id'],
        'vacancy_name' => $row['vacancy_name']
    );
}

$jsonstring = json_encode($cvs);
echo $jsonstring;
?>
