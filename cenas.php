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

<section>
    <div class="tableCenas">
        <table>
            <tr>
                <td>Darbs</td>
                <td>Apraksts</td>
                <td>A,B,C,D,E,F klase</td>
                <td>Komerctransports</td>
            </tr>

            <?php
            $visas_cenas_SQL = "SELECT * FROM cenas";
            $cenu_atlase = mysqli_query($savienojums, $visas_cenas_SQL);

            while($cenas = mysqli_fetch_assoc($cenu_atlase)){
                if($cenas["statuss"] == "active") {
                    echo "
                    <tr>
                        <td>{$cenas['darbs']}</td>
                        <td>{$cenas['apraksts']}</td>
                        <td>{$cenas['cena1']}</td>
                        <td>{$cenas['cena2']}</td>
                    </tr>
                    ";
                }
            }
            ?>
        </table>
    </div>
</section>

</body>
</html>