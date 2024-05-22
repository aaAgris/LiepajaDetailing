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

<section class="apply">
    <h2>Pieteikt mašīnu</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Vārds <span>*</span>:</label>
        <input type="text" name="vards" required>
        <label>Uzvārds <span>*</span>:</label>
        <input type="text" name="uzvards" required>
        <label>E-pasta adrese <span>*</span>:</label>
        <input type="email" name="epasts" required>
        <label>Tālrunis <span>*</span>:</label>
        <input type="tel" pattern="[0-9]{8}" name="talrunis" id="talrunis" required>
        <label>Pakalpojumi <span>*</span>:</label>
        <div id="tag-container"></div> <!-- Tag container -->
        <select id="tag-select">
            <option value="">Izvēlēties pakalpojumu</option>
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
        <label>Pievienot bildes:</label>
        <input type="file" name="bildes[]" multiple accept="image/*">
        <label>Komentāri:</label>
        <input type="text" name="komentari">
        <input type="hidden" name="kursaID">
        <input type="submit" name="pieteikties" value="Pieteikties" class="btn">
    </form>
</section>

<?php
    if(isset($_POST["pieteikties"])){
        $vards_ievade = mysqli_real_escape_string($savienojums, $_POST['vards']);
        $uzvards_ievade = mysqli_real_escape_string($savienojums, $_POST['uzvards']);
        $epasts_ievade = mysqli_real_escape_string($savienojums, $_POST['epasts']);
        $talrunis_ievade = mysqli_real_escape_string($savienojums, $_POST['talrunis']);
        $komentari_ievade = mysqli_real_escape_string($savienojums, $_POST['komentari']);
        $auto_tiriba_ievade = mysqli_real_escape_string($savienojums, $_POST['auto_tiriba']);
        $kursaID = mysqli_real_escape_string($savienojums, $_POST['kursaID']);

        $selected_tags = isset($_POST['tags']) ? $_POST['tags'] : array();

        $selected_tags_str = implode(", ", $selected_tags);

        if(isset($_FILES['bildes'])) {
            $uploads_dir = 'path_to_upload_directory';
            $uploaded_images = array();

            foreach($_FILES['bildes']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['bildes']['name'][$key];
                $file_tmp = $_FILES['bildes']['tmp_name'][$key];

                move_uploaded_file($file_tmp, "$uploads_dir/$file_name");

                $uploaded_images[] = $file_name;
            }

            $uploaded_images_str = implode(", ", $uploaded_images);
        } else {
            $uploaded_images_str = "";
        }

        if(
            !empty($vards_ievade) &&
            !empty($uzvards_ievade) &&
            !empty($epasts_ievade) &&
            !empty($talrunis_ievade) &&
            !empty($kursaID)
        ){
            $pievienot_SQL = "INSERT INTO kursu_pieteikumi(piet_vards, piet_uzvards, piet_epasts, piet_talrunis, piet_komentars, piet_kurss, piet_pakalpojumi, piet_auto_tiriba, piet_bildes) VALUES ('$vards_ievade', '$uzvards_ievade','$epasts_ievade', '$talrunis_ievade', '$komentari_ievade', '$kursaID', '$selected_tags_str', '$auto_tiriba_ievade', '$uploaded_images_str')";

    }
}
?>

</body>
</html>