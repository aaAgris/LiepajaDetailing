<?php
$pieteikumiID = $_POST['pieteikumiID'];
$price = $_POST['price'];

// Generate a text file with basic details
$filename = "pieteikums_$pieteikumiID.txt";
$fileContent = "Pieteikums ID: $pieteikumiID\nPrice: $price";

// Ensure the file is saved in a directory accessible to the web server
$uploads_dir = './admin'; // Adjust this path
$filePath = "$uploads_dir/$filename";

file_put_contents($filePath, $fileContent);

echo $filePath; // Return the file path
?>
