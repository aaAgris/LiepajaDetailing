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
</head>

<body>
  <?php 
    require("connectDB.php");
    require("navigation.php");
    // Fetch data from veicdarbi table
    $query = "SELECT id, darbs FROM veicdarbi";
    $result = mysqli_query($savienojums, $query);
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='{$row['id']}'>{$row['darbs']}</option>";
    }
    mysqli_close($savienojums);
  ?>   

<div class="title">
    <button class="btn5" id="new">Pievienot jaunu</button>
</div>

<div class="container1">
    <table>
        <tr>
            <th>ID</th>
            <th>Darbs</th>
            <th>Apraksts</th>
            <th>Cena:A,B,C,D,E,F</th>
            <th>Cena:Komerctransports</th>
            <th>Statuss</th>
            <th></th>
        </tr>
        <tbody id="cenas"></tbody>
    </table>

    <div class="modal">
        <div class="apply">
            <div class="close_modal"><i class="fas fa-times"></i></div>
            <h2>Pieteikums</h2>
            <form id="pieteikumaForma">
                <div class="formElements">
                    <label>Darbs:</label>
                    <select id="darbs" required>
                        <?php echo $options; ?>
                    </select>

                    <label>Apraksts <span>*</span>:</label>
                    <input type="text" id="apraksts" required>

                    <label>A-F klases cena <span>*</span>:</label>
                    <input type="number" id="afCena" required>

                    <label>Komerctransporta cena <span>*</span>:</label>
                    <input type="number" id="komercCena" required>

                    <label>Statuss:</label>
                    <select id="statuss" required>
                        <option value="active">Aktīvs</option>
                        <option value="inactive">Neaktīvs</option>
                        <option value="deleted">Dzēsts</option>
                    </select>

                    <input type="hidden" id="cenasID">
                </div>
                <input type="submit" name="pieteikties" value="Saglabāt" class="btn">
            </form>
        </div>
    </div>
</div>
</body>
</html>
