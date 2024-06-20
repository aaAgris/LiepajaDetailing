<?php
    require("connectDB.php");
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
?>

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
    <script src="script.js" defer></script>
</head>
<body>
<header class="header">
    <a href="#" class="logo"> <i class="fa fa-circle"></i> Liepaja Detailing </a>
    <nav class="navbar">
        <a href="index.php"> <i class="fas fa-angle-right"></i>Sākums </a>
        <a href="cenas.php"> <i class="fas fa-angle-right"></i>Cenas </a>
        <a href="parmums.php"> <i class="fas fa-angle-right"></i>Par mums </a>
        <a href="darbi.php"> <i class="fas fa-angle-right"></i>Mūsu darbi </a>
        <a href="kontakti.php"> <i class="fas fa-angle-right"></i>Pieteikt auto </a>
        <a href="vakances.php"> <i class="fas fa-angle-right"></i>Vakances </a>
        <a href="login.php"> <i class="fas fa-angle-left"></i>Ielogoties </a>
    </nav>
</header>

<section class="vacancy-container">
    <?php
    $visas_vakances_SQL = "SELECT * FROM vacancies";
    $vakancu_atlase = mysqli_query($savienojums, $visas_vakances_SQL);

    while ($vacancy = mysqli_fetch_assoc($vakancu_atlase)) {
        if ($vacancy["statuss"] == "active") {
            echo "
            <div class='card'>
                <h2>{$vacancy['title']}</h2>
                <p>{$vacancy['description']}</p>
                <p>Alga: {$vacancy['wage']} - {$vacancy['wage2']} €</p>
                <button class='apply-button' data-vacancy-id='{$vacancy['id']}'>Pieteikties</button>
            </div>
            ";
        }
    }
    ?>
</section>

<!-- Modal -->
<div id="apply-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Pieteikties vakancei</h2>
        <form id="apply-form" method="post">
            <input type="hidden" name="vacancy_id" id="vacancy_id">
            <label>Vārds <span>*</span>:</label>
            <input type="text" name="vards" required>
            <label>Uzvārds <span>*</span>:</label>
            <input type="text" name="uzvards" required>
            <label>E-pasta adrese <span>*</span>:</label>
            <input type="email" name="epasts" required>
            <label>Tālrunis <span>*</span>:</label>
            <input type="tel" pattern="[0-9]{8}" name="talrunis" required>
            <button type="submit" name="pieteikties" class="btn">Pieteikties</button>
        </form>
    </div>
</div>

<!-- Echo Message Modal -->
<div id="echo-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="echo-message"></p>
    </div>
</div>

<?php
if (isset($_POST["pieteikties"])) {
    $vacancy_id = mysqli_real_escape_string($savienojums, $_POST['vacancy_id']);
    $vards_ievade = mysqli_real_escape_string($savienojums, $_POST['vards']);
    $uzvards_ievade = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
    $epasts_ievade = mysqli_real_escape_string($savienojums, $_POST['epasts']);
    $talrunis_ievade = mysqli_real_escape_string($savienojums, $_POST['talrunis']);
    $datums_ievade = date("Y-m-d");

    $insert_sql = "INSERT INTO vakances_pieteikumi (vacancy_id, vards, uzvards, epasts, talrunis, datums, statuss) VALUES ('$vacancy_id', '$vards_ievade', '$uzvards_ievade', '$epasts_ievade', '$talrunis_ievade', '$datums_ievade', 'Jauns')";

    if (mysqli_query($savienojums, $insert_sql)) {
        $phpmailer = new PHPMailer();
                $phpmailer->isSMTP();
                $phpmailer->Host = 'live.smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 587;
                $phpmailer->Username = 'api';
                $phpmailer->Password = '192b3b77f3bec7e872f54820797d620f';
                $phpmailer->CharSet = 'UTF-8';

                $phpmailer->setFrom('mailtrap@demomailtrap.com', 'Liepaja Detailing'); 
                $phpmailer->addAddress($epasts_ievade, $vards_ievade . ' ' . $uzvards_ievade);
                $phpmailer->isHTML(true);

        $vacancy_query = "SELECT title FROM vacancies WHERE id = '$vacancy_id'";
        $vacancy_result = mysqli_query($savienojums, $vacancy_query);
        $vacancy_row = mysqli_fetch_assoc($vacancy_result);
        $vacancy_title = $vacancy_row['title'];

        $phpmailer->Subject = 'Pieteikums saņemts';
        $phpmailer->Body    = "<h1>Pieteikums saņemts</h1><p>Paldies, ka pieteicāties vakancei: {$vacancy_title}</p>";

        if ($phpmailer->send()) {
            $message = "Pieteikums veiksmīgi pievienots un apstiprinājuma e-pasts nosūtīts!";
        } else {
            $message = "Pieteikums veiksmīgi pievienots, bet e-pasta nosūtīšana neizdevās: " . $phpmailer->ErrorInfo;
        }
    } else {
        $message = "Kļūda pievienojot pieteikumu: " . mysqli_error($savienojums);
    }

    echo "<script>
            document.getElementById('echo-message').innerText = '$message';
            document.getElementById('echo-modal').style.display = 'block';
          </script>";
}
?>

<footer class="footer">
    <div class="footer-content">
        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <p><i class="fas fa-phone"></i> +371 12345678</p>
        <p><i class="fas fa-globe"></i> www.liepajadetailing.com</p>
        <p><i class="fas fa-map-marker-alt"></i> Liepaja, Latvia</p>
        <div id="map"></div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // Open apply modal on apply button click
        $('.apply-button').on('click', function() {
            var vacancyId = $(this).data('vacancy-id');
            $('#vacancy_id').val(vacancyId);
            $('#apply-modal').show();
        });

        // Close modals on close button click
        $('.close').on('click', function() {
            $(this).closest('.modal').hide();
        });

        // Close modal when clicking outside the modal content
        $(window).on('click', function(event) {
            if ($(event.target).is('.modal')) {
                $(event.target).hide();
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.image-carousel').slick({
            dots: true,
            infinite: true,
            speed: 1,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    });

    // Initialize Google Map
    function initMap() {
        var location = {lat: 56.504667, lng: 21.010806};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: location
        });
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG-Ryk1QNLu5Zo-tiiNoEu9875oq78mak&callback=initMap" defer></script>
</body>
</html>