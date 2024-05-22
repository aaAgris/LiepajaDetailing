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
  ?>   

<div class="title">
    <div class="name">
        <p>Darbi</p>
    </div>
    <button class="btn" id="newDarbi">Pievienot jaunu</button>
</div>

<div class="container1">
    <table>
        <tr>
            <th>ID</th>
            <th>Darbs</th>
            <th>Apraksts</th>
            <th>Attēls</th>
            <th>Statuss</th>
            <th></th>
        </tr>
        <tbody id="darbi"></tbody>
    </table>

    <div class="modal">
        <div class="apply">
            <div class="close_modal"><i class="fas fa-times"></i></div>
            <h2>Pieteikums</h2>
            <form id="darbuForma">
                <div class="formElements">

                <label>Darbs:</label>
                    <?php 
                        $darbi_SQL1 = "SELECT * FROM veicdarbi";
                        $atlasa_darbus1 = mysqli_query($savienojums, $darbi_SQL1);
                        $darbi1 = "";
                
                        while($darbi2 = mysqli_fetch_array($atlasa_darbus1)){
                        $darbi1 = $darbi1."<option value='{$darbi2['id']}'>{$darbi2['darbs']}</option>";
                        }
                    ?>
            <select id="darbs1" required>
                <?php echo $darbi1; ?>
            </select>

                    <label>Apraksts <span>*</span>:</label>
                    <input type="text" id="apraksts" required>
                    <label>Attēls <span>*</span>:</label>
                    <input type="text" id="attels" required>
                    <label>Statuss:</label>
                    <select id="statuss" required>
                        <option value="active">Aktīvs</option>
                        <option value="inactive">Neaktīvs</option>
                        <option value="deleted">Dzēsts</option>
                    </select>
                    
                    <input type="hidden" id="darbiID">
                </div>
                <input type="submit" name="pieteikties" value="Saglabāt" class="btn">
            </form>
        </div>
    </div>


</div>

</body>
</html>