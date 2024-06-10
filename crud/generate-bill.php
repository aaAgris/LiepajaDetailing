<?php
// Assuming you generate a PDF or any other format
// For example, save a text file with details

$pieteikumiID = $_POST['pieteikumiID'];
$price = $_POST['price'];

// Generate a text file with basic details
$filename = "pieteikums_$pieteikumiID.txt";
$fileContent = "Pieteikums ID: $pieteikumiID\nPrice: $price";

file_put_contents($filename, $fileContent);

echo $filename; // Return the file path or success message
?>