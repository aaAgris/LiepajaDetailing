<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liepaja Detailing</title>
    <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js" defer></script>
    <script src="script.js" defer></script>
</head>
<body>
<?php
    require("connectDB.php");
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>

<header class="header">
    <a href="#" class="logo"> <i class="fa fa-circle"></i> Liepaja Detailing </a>
    <nav class="navbar">
        <a href="index.php"> <i class="fas fa-angle-right"></i>Sākums </a>
        <a href="cenas.php"> <i class="fas fa-angle-right"></i>Cenas </a>
        <a href="parmums.php"> <i class="fas fa-angle-right"></i>Par mums </a>
        <a href="darbi.php">  <i class="fas fa-angle-right"></i>Mūsu darbi </a>
        <a href="kontakti.php"> <i class="fas fa-angle-right"></i>Pieteikt auto </a>
        <a href="vakances.php"> <i class="fas fa-angle-right"></i>Vakances </a>
    </nav>
</header>

<section class="apply">
    <h2>Pieteikt mašīnu</h2>
    <form id="pieteikumiForma" method="post" enctype="multipart/form-data" id="application-form">
        <label>Vārds <span>*</span>:</label>
        <input type="text" name="vards" required>
        <label>Uzvārds <span>*</span>:</label>
        <input type="text" name="uzvards" required>
        <label>E-pasta adrese <span>*</span>:</label>
        <input type="email" name="epasts" required>
        <label>Tālrunis <span>*</span>:</label>
        <input type="tel" pattern="[0-9]{8}" name="talrunis" id="talrunis" required>
        <div class="selected-tags" id="selected-tags-container">
            <!-- Selected tags will be displayed here -->
        </div>
        <label>Pakalpojumi <span>*</span>:</label>
        <select id="tag-select" name="tags[]" multiple>
            <option value="Lukturu pulēšana">Lukturu pulēšana</option>
            <option value="Salona tīrīšana">Salona tīrīšana</option>
            <option value="Keramika virsbūvei">Keramika virsbūvei</option>
            <option value="Virsbūves pulēšana">Virsbūves pulēšana</option>
            <option value="Disku tīrīšana">Disku tīrīšana</option>
            <option value="Logu tīrīšana">Logu tīrīšana</option>
        </select>
        <label>Auto tīrība:</label>
        <select name="auto_tiriba">
            <option value="Tirs">Tīrs</option>
            <option value="Videji">Vidēji tīrs</option>
            <option value="Netirs">Netīrs</option>
        </select>
        <label>Komentārs <span>*</span>:</label>
        <input type="text" name="komentari" required>
        <label>Datums <span>*</span>:</label>
        <input type="text" name="datums" id="datums" required>
        <label>Laiks <span>*</span>:</label>
        <input type="text" name="laiks" id="laiks" required>
        <button type="submit" name="pieteikties" class="btn">Pieteikties</button>
    </form>
</section>

<?php

if(isset($_POST["pieteikties"])){
    // Sanitize inputs
    $vards_ievade = mysqli_real_escape_string($savienojums, $_POST['vards']);
    $uzvards_ievade = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
    $epasts_ievade = mysqli_real_escape_string($savienojums, $_POST['epasts']);
    $talrunis_ievade = mysqli_real_escape_string($savienojums, $_POST['talrunis']);
    $datums_ievade = mysqli_real_escape_string($savienojums, $_POST['datums']);
    $laiks_ievade = mysqli_real_escape_string($savienojums, $_POST['laiks']);
    $komentari_ievade = mysqli_real_escape_string($savienojums, $_POST['komentari']);
    $auto_tiriba_ievade = mysqli_real_escape_string($savienojums, $_POST['auto_tiriba']);

    // Check if selected date is a weekday (Monday to Friday)
    $weekday = date('N', strtotime($datums_ievade)); // 1 (Monday) to 7 (Sunday)
    if ($weekday >= 1 && $weekday <= 5) {
        // Check if the selected time on the date is already booked
        $query = "SELECT COUNT(*) AS count FROM pieteikumi WHERE datums = '$datums_ievade' AND laiks = '$laiks_ievade'";
        $result = mysqli_query($savienojums, $query);
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            // Get available times for the selected date
            $query_available_times = "SELECT laiks FROM pieteikumi WHERE datums = '$datums_ievade'";
            $result_available_times = mysqli_query($savienojums, $query_available_times);

            if ($result_available_times) {
                $available_times = array();
                while ($row = mysqli_fetch_assoc($result_available_times)) {
                    $available_times[] = $row['laiks'];
                }
                echo json_encode(array('error' => 'Laiks nav pieejams', 'available_times' => $available_times));
            } else {
                echo json_encode(array('error' => 'Database error: ' . mysqli_error($savienojums)));
            }
        } else {
            // Handle file uploads (already handled in your original implementation)
            $uploads_dir = 'c:/xampp/img';
            $uploaded_images = array();

            if(isset($_FILES['bildes'])) {
                foreach($_FILES['bildes']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES['bildes']['name'][$key];
                    $file_tmp = $_FILES['bildes']['tmp_name'][$key];
                    if(move_uploaded_file($file_tmp, "$uploads_dir/$file_name")) {
                        $uploaded_images[] = $file_name;
                    }
                }
            }
            $uploaded_images_str = implode(", ", $uploaded_images);

            // Insert into pieteikumi table
            $pieteikums_sql = "INSERT INTO pieteikumi (vards, uzvards, epasts, talrunis, datums, laiks, komentari, auto_tiriba, bildes)
                               VALUES ('$vards_ievade', '$uzvards_ievade', '$epasts_ievade', '$talrunis_ievade', '$datums_ievade', '$laiks_ievade', '$komentari_ievade', '$auto_tiriba_ievade', '$uploaded_images_str')";
            
            if(mysqli_query($savienojums, $pieteikums_sql)) {
                $submission_id = mysqli_insert_id($savienojums); // Get the ID of the inserted submission

                // Handle tags (already handled in your original implementation)
                $selected_tags = isset($_POST['tags']) ? $_POST['tags'] : array();
                foreach($selected_tags as $tag_name) {
                    $tag_name = mysqli_real_escape_string($savienojums, $tag_name);

                    // Insert tag if it doesn't exist
                    $tag_sql = "INSERT INTO tags (name) VALUES ('$tag_name') ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id)";
                    mysqli_query($savienojums, $tag_sql);
                    $tag_id = mysqli_insert_id($savienojums);

                    // Link tag to submission
                    $link_sql = "INSERT INTO pieteikumi_tags (submission_id, tag_id) VALUES ('$submission_id', '$tag_id')";
                    mysqli_query($savienojums, $link_sql);
                }


                
                $phpmailer = new PHPMailer();
                $phpmailer->isSMTP();
                $phpmailer->Host = 'live.smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 587;
                $phpmailer->Username = 'api';
                $phpmailer->Password = '192b3b77f3bec7e872f54820797d620f';
                $phpmailer->CharSet = 'UTF-8';

                $phpmailer->setFrom('mailtrap@demomailtrap.com', 'Liepaja Detailing'); // Replace with your email and name
                $phpmailer->addAddress($epasts_ievade, $vards_ievade . ' ' . $uzvards_ievade); // Add recipient
                $phpmailer->isHTML(true);

                $phpmailer->Subject = 'Pieteikums apstiprināts';
                $phpmailer->Body    = "
                    <h1>Pieteikums apstiprināts</h1>
                    <p>Paldies, ka izvēlējāties Liepaja Detailing. Jūsu pieteikums ir veiksmīgi pieņemts.</p>
                    <p><strong>Vārds:</strong> $vards_ievade $uzvards_ievade</p>
                    <p><strong>E-pasta adrese:</strong> $epasts_ievade</p>
                    <p><strong>Tālrunis:</strong> $talrunis_ievade</p>
                    <p><strong>Datums:</strong> $datums_ievade</p>
                    <p><strong>Laiks:</strong> $laiks_ievade</p>
                    <p>Mēs gaidām jūs norādītajā laikā.</p>
                    <p>Ar cieņu, Liepaja Detailing!</p>
                ";

                if($phpmailer->send()) {
                    echo "<p>Pieteikums veiksmīgi pievienots un apstiprinājuma e-pasts nosūtīts!</p>";
                } else {
                    echo "<p>Pieteikums veiksmīgi pievienots, bet e-pasta nosūtīšana neizdevās: " . $phpmailer->ErrorInfo . "</p>";
                }

                echo "<script>
                        setTimeout(function(){
                            window.location.reload();
                        }, 3000);
                      </script>";
            } else {
                echo "<p>Kļūda pievienojot pieteikumu: " . mysqli_error($savienojums) . "</p>";
            }
        }
    } else {
        echo "<p>Izvēlētais datums nav darba diena (P-O-P-C-Pk).</p>";
    }
}
?>
</body>
</html>
