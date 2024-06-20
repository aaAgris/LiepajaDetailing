<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Par mums - Liepaja Detailing</title>
    <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css"/>
    <script src="script.js" defer></script> 
</head>
<body>
<?php
    require("connectDB.php");
?>

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

<div class="about-content">
    <h1>Par mums</h1>
    <p>
    Mēs lepojamies ar mūsu augstajiem standartiem un precīzumu, nodrošinot, ka ikviens automašīnas īpašnieks saņem optimālo rezultātu. Mūsu profesionālie pakalpojumi ietver rūpīgu automašīnu detaļu tīrīšanu, kas ne tikai uzlabo automašīnas izskatu, bet arī aizsargā tās virsmu no kaitīgiem faktoriem.
    </p>
    <br>
    <p>
    Mēs pievēršam īpašu uzmanību katram detalizācijas solim, sākot no rūpīgas degļu tīrīšanas līdz smalkai virsmu polēšanai. Katrs mūsu darbinieks ir apmācīts un apveltīts ar izcilām prasmēm, lai nodrošinātu visaugstāko pakalpojumu kvalitāti un klientu apmierinātību.
    </p>
</div>

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
        var location = {lat: 56.504667, lng: 21.010833};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: location
        });
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }

    window.initMap = initMap;
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG-Ryk1QNLu5Zo-tiiNoEu9875oq78mak&callback=initMap" defer></script>
</body>
</html>
