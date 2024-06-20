<?php
require("../connectDB.php");

if(isset($_POST['id'])){
    $id = mysqli_real_escape_string($savienojums, $_POST['id']);
    $select_user_SQL = "SELECT * FROM users WHERE id = $id";
    $select_user_result = mysqli_query($savienojums, $select_user_SQL);

    if(!$select_user_result){
        die("Kļūda!".mysqli_error($savienojums));
    }

    $json = array();
    while($row = mysqli_fetch_array($select_user_result)){
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

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>
