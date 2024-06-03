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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="admin-script.js" defer></script> 
    <script src="script.js" defer></script> 
</head>
<body>
  <?php 
    require("connectDB.php");
    require("navigation.php");
  ?>   

<div class="title">
    <div class="name">
        <p>Pieteikumi</p>
    </div>
    <button class="btn" id="newPieteikumi">Pievienot jaunu</button>
</div>

<div class="container1">
    <table>
        <tr>
            <th>ID</th>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>E-pasts</th>
            <th>Tālrunis</th>
            <th>Komentāri</th>
            <th>Auto tīrība</th>
            <th>Bildes</th>
            <th>Tags</th>
            <th>Datums</th>
            <th>Laiks</th>
            <th></th>
        </tr>
        <tbody id="pieteikumi"></tbody>
    </table>

    <div class="modal">
        <div class="apply">
            <div class="close_modal"><i class="fas fa-times"></i></div>
            <h2>Pieteikums</h2>
            <form id="pieteikumiForma">
                <div class="formElements">
                    <label>Vārds:</label>
                    <input type="text" id="vards" required>
                    <label>Uzvārds:</label>
                    <input type="text" id="uzvards" required>
                    <label>E-pasts:</label>
                    <input type="email" id="epasts" required>
                    <label>Tālrunis:</label>
                    <input type="tel" id="talrunis" required>
                    <label>Komentāri:</label>
                    <input type="text" id="komentari">
                    <label>Auto tīrība:</label>
                    <select id="auto_tiriba" required>
                        <option value="Tirs">Tīrs</option>
                        <option value="Videji">Vidēji tīrs</option>
                        <option value="Netirs">Netīrs</option>
                    </select>
                    <label>Tags:</label>
                    <?php 
                        $tags_SQL = "SELECT * FROM tags";
                        $tags_result = mysqli_query($savienojums, $tags_SQL);
                        $tags_options = "";
                        while($tag = mysqli_fetch_array($tags_result)){
                            $tags_options .= "<option value='{$tag['id']}'>{$tag['name']}</option>";
                        }
                    ?>
                    <select id="tags" multiple>
                        <?php echo $tags_options; ?>
                    </select>
                    <label>Pievienot bildes:</label>
                    <input type="file" id="bildes" multiple>
                    <label>Datums:</label>
                    <input type="date" id="datums" required>
                    <label>Laiks:</label>
                    <input type="time" id="laiks" required>
                    <input type="hidden" id="pieteikumiID">
                </div>
                <input type="submit" name="pieteikties" value="Saglabāt" class="btn">
            </form>
        </div>
    </div>
</div>

</body>
</html>