<?php
require('../connectDB.php');
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Initialize PHPMailer
$phpmailer = new PHPMailer();

// Check if form data is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if both filePath and pieteikumiID are set in $_POST
    if (isset($_POST['filePath'], $_POST['pieteikumiID']) && !empty($_POST['pieteikumiID'])) {
        // Escape pieteikumiID to prevent SQL injection
        $pieteikumiID = mysqli_real_escape_string($savienojums, $_POST['pieteikumiID']);
        $filePath = mysqli_real_escape_string($savienojums, $_POST['filePath']);

        // Retrieve pieteikumi details from the database
        $select_pieteikumi_SQL = "SELECT * FROM pieteikumi WHERE id = $pieteikumiID";
        $select_pieteikumi_result = mysqli_query($savienojums, $select_pieteikumi_SQL);

        if (!$select_pieteikumi_result) {
            die("Kļūda! " . mysqli_error($savienojums));
        }

        // Fetch pieteikumi details
        $row = mysqli_fetch_assoc($select_pieteikumi_result);
        $email = $row['epasts'];
        $name = $row['vards']; // Adjust this based on your database structure

        try {
            // Server settings
            $phpmailer->isSMTP();
            $phpmailer->Host = 'live.smtp.mailtrap.io'; // Update with your SMTP server
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 587; // Update with your SMTP port
            $phpmailer->Username = 'api'; // Update with your SMTP username
            $phpmailer->Password = '192b3b77f3bec7e872f54820797d620f'; // Update with your SMTP password
            $phpmailer->CharSet = 'UTF-8';

            // Set email parameters
            $phpmailer->setFrom('mailtrap@demomailtrap.com', 'Liepaja Detailing');
            $phpmailer->addAddress($email, $name); // Add recipient email address
            $phpmailer->addAttachment($filePath); // Attach the generated file

            $phpmailer->isHTML(true);
            $phpmailer->Subject = 'Pieteikuma rēķins';
            $phpmailer->Body = 'Labdien, Paldies par Jūsu pieteikumu. Pielikumā ir Jūsu rēķins.';

            // Send email
            $phpmailer->send();
            echo 'Email with bill has been sent successfully';
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
        }
    } else {
        echo "Kļūda! Nepareizi nosūtīti dati.";
    }
} else {
    echo "Kļūda! Nepareizs pieprasījuma veids.";
}
?>