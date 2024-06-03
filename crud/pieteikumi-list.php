<?php
require('../connectDB.php');

$select_pieteikumi_SQL = "
    SELECT p.*, GROUP_CONCAT(t.name SEPARATOR ', ') as tags 
    FROM pieteikumi p
    LEFT JOIN pieteikumi_tags pt ON p.id = pt.submission_id
    LEFT JOIN tags t ON pt.tag_id = t.id
    GROUP BY p.id
    ORDER BY p.id DESC";
$select_pieteikumi_result = mysqli_query($savienojums, $select_pieteikumi_SQL);

if(!$select_pieteikumi_result){
    die("Kļūda!");
}

$json = array();
while($row = mysqli_fetch_array($select_pieteikumi_result)){
    $json[] = array(
        'id' => $row['id'],
        'vards' => $row['vards'],
        'uzvards' => $row['uzvards'],
        'epasts' => $row['epasts'],
        'talrunis' => $row['talrunis'],
        'datums' => $row['datums'],
        'laiks' => $row['laiks'],
        'komentari' => $row['komentari'],
        'auto_tiriba' => $row['auto_tiriba'],
        'bildes' => $row['bildes'],
        'tags' => $row['tags']
    );
}

$jsonstring = json_encode($json);
echo $jsonstring;
?>