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

    <section class="vacancy-container">
        <?php
        $visas_vakances_SQL = "SELECT * FROM vacancies";
        $vakancu_atlase = mysqli_query($savienojums, $visas_vakances_SQL);

        while ($vacancy = mysqli_fetch_assoc($vakancu_atlase)) {
            if($vacancy["statuss"] == "active") {
            echo "
            <div class='card'>
                <h2>{$vacancy['title']}</h2>
                <p>{$vacancy['description']}</p>
                <p>Alga: {$vacancy['wage']} - {$vacancy['wage2']} € </p>
                <button class='apply-button'>Pieteikties</button>
            </div>
            ";
        }
    }
        ?>
    </section>
</body>
</html>
</table>