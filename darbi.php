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
    </nav>

</header>


<section class="darbi" id="courses">
    <div class="heading">
        <span>Mūsu darbi</span>
        <h3>Bildes no iepriekšējiem klientiem:</h3>
    </div>

    <div class="filter-buttons">
        <button id="salonsButton" class="filter-button" onclick="filter('Salons')">Salons</button>
        <button id="virsbuveButton" class="filter-button" onclick="filter('Virsbūve')">Virsbūve</button>
        <button id="allButton" class="filter-button" onclick="filter('')">Visi</button>
    </div>

    <div class="box-container">
        <?php
            $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

            $visi_darbi_SQL = "SELECT * FROM darbi";
            if ($filter == 'Salons') {
                $visi_darbi_SQL .= " WHERE tips = 'Salons'";
            } elseif ($filter == 'Virsbūve') {
                $visi_darbi_SQL .= " WHERE tips = 'Virsbūve'";
            }
            $darbu_atlase = mysqli_query($savienojums, $visi_darbi_SQL);

            while ($darbi = mysqli_fetch_assoc($darbu_atlase)) {
                if ($darbi["darbs_statuss"] == "active") {
                    echo "
                    <div class='box'>
                        <div class='image'>
                            <img src='{$darbi['darbs_attels']}'>
                        </div>
                        <div class='content'>
                            <h3>{$darbi['darbs_nosaukums']}</h3>
                            <p>{$darbi['darbs_apraksts']}</p>
                            <a href='kontakti.php'>
                                <button name='pieteikties' class='btn btnApply'>Pieteikties</button>
                            </a>
                        </div>
                    </div>
                    ";
                }
            }
        ?>
    </div>
</section>

</body>
</html>