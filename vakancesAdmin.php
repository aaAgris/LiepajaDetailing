<?php 
require("connectDB.php");
require("navigation.php");
?>   

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Vakances</title>
    <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="admin-script.js" defer></script> 
</head>
<body>

<div class="title">
    <div class="name">
        <p>Vakances</p>
    </div>
    <button class="btn" id="newVacancy">Pievienot jaunu</button>
</div>

<div class="container1">
    <table>
        <tr>
            <th>ID</th>
            <th>Nosaukums</th>
            <th>Apraksts</th>
            <th>Alga no</th>
            <th>Alga līdz</th>
            <th>Statuss</th>
            <th></th>
        </tr>
        <tbody id="vacancies"></tbody>
    </table>

    <div class="modal">
        <div class="apply">
            <div class="close_modal"><i class="fas fa-times"></i></div>
            <h2>Vakance</h2>
            <form id="vacancyForm">
                <div class="formElements">
                    <label>Nosaukums:</label>
                    <input type="text" id="title" required>
                    <label>Apraksts:</label>
                    <textarea id="description" required></textarea>
                    <label>Alga no:</label>
                    <input type="number" id="wage" required>
                    <label>Alga līdz:</label>
                    <input type="number" id="wage2" required>
                    <label>Statuss:</label>
                    <select id="statuss" required>
                        <option value="active">Aktīva</option>
                        <option value="inactive">Neaktīva</option>
                    </select>
                    <input type="hidden" id="vacancyID">
                </div>
                <input type="submit" value="Saglabāt" class="btn">
            </form>
        </div>
    </div>
</div>

</body>
</html>