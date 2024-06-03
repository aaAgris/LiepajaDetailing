<?php
require('../connectDB.php');

if(isset($_POST['id'])){
    // Sanitize input
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $select_pieteikumi_SQL = "
        SELECT p.*, GROUP_CONCAT(t.name SEPARATOR ', ') as tags 
        FROM pieteikumi p
        LEFT JOIN pieteikumi_tags pt ON p.id = pt.submission_id
        LEFT JOIN tags t ON pt.tag_id = t.id
        WHERE p.id = $id
        GROUP BY p.id";
    $select_pieteikumi_result = mysqli_query($savienojums, $select_pieteikumi_SQL);

    if(!$select_pieteikumi_result){
        die("Kļūda!".mysqli_error($savienojums));
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

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>