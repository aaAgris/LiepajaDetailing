<?php
require('../connectDB.php'); 
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$phpmailer = new PHPMailer();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cvID = mysqli_real_escape_string($savienojums, $_POST['cvID']);
    $action = mysqli_real_escape_string($savienojums, $_POST['action']);

    if (!is_numeric($cvID)) {
        die("Kļūda! Nepareizs CV ID.");
    }

    $select_cv_SQL = "
        SELECT *
        FROM vakances_pieteikumi
        WHERE id = $cvID";
    $select_cv_result = mysqli_query($savienojums, $select_cv_SQL);

    if (!$select_cv_result) {
        die("Kļūda! " . mysqli_error($savienojums));
    }

    $row = mysqli_fetch_assoc($select_cv_result);
    $email = $row['epasts'];
    $cvName = $row['vards'];
    $cvSurname = $row['uzvards'];
    $vacancy_id = $row['vacancy_id'];

    $select_vacancy_SQL = "
        SELECT title
        FROM vacancies
        WHERE id = $vacancy_id";
    $select_vacancy_result = mysqli_query($savienojums, $select_vacancy_SQL);

    if (!$select_vacancy_result) {
        die("Kļūda! " . mysqli_error($savienojums));
    }

    $vacancy_row = mysqli_fetch_assoc($select_vacancy_result);
    $vacancy_title = $vacancy_row['title'];

    $statuss = '';
    $subject = '';
    $body = '';

    if ($action === 'accept') {
        $statuss = 'Apstiprināts';
        $subject = 'Jūsu pieteikums ir apstiprināts';
        $body = "Sveiki, $cvName $cvSurname,\n\nJūsu pieteikums vakancei \"$vacancy_title\" ir apstiprināts.";

        $update_cv_SQL = "
        UPDATE vakances_pieteikumi
        SET statuss = 'Pieņemts'
        WHERE id = $cvID";
    $update_cv_result = mysqli_query($savienojums, $update_cv_SQL);
    } elseif ($action === 'reject') {
        $statuss = 'Nepieņemts';
        $subject = 'Jūsu pieteikums ir noraidīts';
        $body = "Sveiki, $cvName $cvSurname,\n\nDiemžēl Jūsu pieteikums vakancei \"$vacancy_title\" ir noraidīts.";

        $update_cv_SQL = "
        UPDATE vakances_pieteikumi
        SET statuss = 'Noraidīts'
        WHERE id = $cvID";
        $update_cv_result = mysqli_query($savienojums, $update_cv_SQL);
    } else {
        die("Kļūda! Nepareiza darbība.");
    }

    try {
        $phpmailer->isSMTP();
        $phpmailer->Host = 'live.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->Username = 'api';
        $phpmailer->Password = '192b3b77f3bec7e872f54820797d620f';
        $phpmailer->CharSet = 'UTF-8';

        $phpmailer->setFrom('mailtrap@demomailtrap.com', 'Liepaja Detailing');
        $phpmailer->addAddress($email, $cvName . ' ' . $cvSurname);
        $phpmailer->isHTML(false); 
        $phpmailer->Subject = $subject;
        $phpmailer->Body = $body;

        $phpmailer->send();
        echo 'Email has been sent'; // Success message
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }
}
?>
