<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Management</title>
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
        <p></p>
    </div>
</div>

<div class="container1">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vārds</th>
                <th>Uzvārds</th>
                <th>E-pasts</th>
                <th>Tālrunis</th>
                <th>Datums</th>
                <th>Vakance</th>
                <th>Statuss</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody id="cvs"></tbody>
    </table>

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="apply">
            <div class="close_modal"><i class="fas fa-times"></i></div>
            <h2>CV</h2>
            <form id="cvForma">
                <div class="formElements">
                    <label>Vārds:</label>
                    <input type="text" id="vards" required>
                    <label>Uzvārds:</label>
                    <input type="text" id="uzvards" required>
                    <label>E-pasts:</label>
                    <input type="email" id="epasts" required>
                    <label>Tālrunis:</label>
                    <input type="tel" id="talrunis" required>
                    <label>Datums:</label>
                    <input type="date" id="datums" required>
                    <label>Statuss:</label>
                    <select id="statuss" required>
                        <option value="Jauns">Jauns</option>
                        <option value="Apskatīts">Apskatīts</option>
                        <option value="Pieņemts">Pieņemts</option>
                        <option value="Noraidīts">Noraidīts</option>
                    </select>
                    <input type="hidden" id="cvID">
                </div>
                <input type="submit" name="saglabat" value="Saglabāt" class="btn">
            </form>
        </div>
    </div>
    
    <div class="modal" id="billModal">
        <div class="apply">
            <div class="close_modal"><i class="fas fa-times"></i></div>
            <h2>CV Pieteikums</h2>
            <form id="billForm">
                <input type="hidden" id="cvIDModal" name="cvID">
                <label>Pieteikumu:</label>
                <select id="actionSelect" name="action">
                    <option value="accept">Apstiprināt</option>
                    <option value="reject">Noliegt</option>
                </select>
                <button type="submit" class="btn">Iesniegt</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>
