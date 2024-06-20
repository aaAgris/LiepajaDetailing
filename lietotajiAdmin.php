<?php 
session_start();
require("connectDB.php");

// Check if the user is logged in and has the "owner" role
if($_SESSION['loma_LYXQT'] !== "owner"){
    header("Location: index1.php");
    exit();
}

require("navigation.php");
?>   

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lietotāji</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="admin-script.js" defer></script>
</head>
<body>
<div class="title">
    <div class="name">
        <p>Lietotāji</p>
    </div>
</div>

<div class="container1">
    <button id="newUser" class="btn">Pievienot lietotāju</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Lietotajvards</th>
                <th>Vārds</th>
                <th>Uzvārds</th>
                <th>E-pasts</th>
                <th>Loma</th>
                <th>Statuss</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody id="users"></tbody>
    </table>

    <div class="modal" id="userModal">
        <div class="apply">
            <div class="close_modal"><i class="fas fa-times"></i></div>
            <h2>User</h2>
            <form id="userForm">
                <div class="formElements">
                    <label>Lietotajvards:</label>
                    <input type="text" id="lietotajvards" required>
                    <label>Vārds:</label>
                    <input type="text" id="vards" required>
                    <label>Uzvārds:</label>
                    <input type="text" id="uzvards" required>
                    <label>E-pasts:</label>
                    <input type="email" id="epasts" required>
                    <label>Parole:</label>
                    <input type="password" id="parole">
                    <label>Loma:</label>
                    <select id="loma" required>
                        <option value="owner">Owner</option>
                        <option value="user">User</option>
                    </select>
                    <label>Statuss:</label>
                    <select id="statuss" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="deleted">Deleted</option>
                    </select>
                    <input type="hidden" id="userID">
                </div>
                <input type="submit" name="saglabat" value="Saglabāt" class="btn">
            </form>
        </div>
    </div>
</div>
</body>
</html>
