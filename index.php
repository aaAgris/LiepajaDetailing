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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css"/>
</head>
<body>
<?php
    require("connectDB.php");

    // Fetch images from the database
    $query = "SELECT image_path FROM images"; // Assuming you have an `images` table with `image_path` column
    $result = mysqli_query($savienojums, $query);

    $images = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $images[] = $row['image_path'];
        }
    }
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

<section class="carousel">
    <div class="image-carousel">
        <?php foreach ($images as $image): ?>
            <div><img src="<?php echo htmlspecialchars($image); ?>" alt="Carousel Image"></div>
        <?php endforeach; ?>
    </div>
</section>

<footer class="footer">
    <div class="footer-content">
        <a href="https://www.instagram.com/liepaja_detailing/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/profile.php?id=61552388263925" target="_blank"><i class="fab fa-facebook"></i></a>
        <p><i class="fas fa-phone"></i> +371 26119160</p>
        <p><i class="fas fa-globe"></i> www.liepajadetailing.lv</p>
        <p><i class="fas fa-map-marker-alt"></i> Liepāja, Latvija</p>
        <div id="map"></div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
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
