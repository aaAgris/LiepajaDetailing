<?php
require('../connectDB.php');

if(isset($_POST['id'])){
    // Sanitize input
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $select_vacancy_SQL = "SELECT * FROM vacancies WHERE id = $id";
    $select_vacancy_result = mysqli_query($savienojums, $select_vacancy_SQL);

    if(!$select_vacancy_result){
        die("Kļūda!".mysqli_error($savienojums));
    }

    $json = array();
    while($row = mysqli_fetch_array($select_vacancy_result)){
        $json[] = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'wage' => $row['wage'],
            'wage2' => $row['wage2'],
            'statuss' => $row['statuss']
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>
