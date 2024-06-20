<?php
session_start();
require("connectDB.php");

// Get the current user's data
$user_id = $_SESSION['id_LYXQT'];
$query = "SELECT lietotajvards, vards, uzvards, epasts FROM users WHERE id = $user_id";
$result = mysqli_query($savienojums, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("Kļūda: " . mysqli_error($savienojums));
}

// Handle password change
$change_password_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = mysqli_real_escape_string($savienojums, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($savienojums, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($savienojums, $_POST['confirm_password']);

    // Fetch the current hashed password from the database
    $query = "SELECT parole FROM users WHERE id = $user_id";
    $result = mysqli_query($savienojums, $query);
    $row = mysqli_fetch_assoc($result);
    $current_hashed_password = $row['parole'];

    // Verify the old password
    if (password_verify($old_password, $current_hashed_password)) {
        // Check if the new passwords match
        if ($new_password == $confirm_password) {
            // Hash the new password
            $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            // Update the password in the database
            $query = "UPDATE users SET parole = '$new_hashed_password' WHERE id = $user_id";
            if (mysqli_query($savienojums, $query)) {
                $change_password_message = "Parole veiksmīgi nomainīta!";
            } else {
                $change_password_message = "Kļūda: " . mysqli_error($savienojums);
            }
        } else {
            $change_password_message = "Jaunās paroles nesakrīt.";
        }
    } else {
        $change_password_message = "Vecā parole ir nepareiza.";
    }
}

mysqli_close($savienojums);
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profils</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleProfils.css">
</head>
<body>
<?php require("navigation.php"); ?>

<div class="container">
    <h2>Profils</h2>
    <div class="profile-info">
        <p><strong>Lietotājvārds:</strong> <?php echo htmlspecialchars($user['lietotajvards']); ?></p>
        <p><strong>Vārds:</strong> <?php echo htmlspecialchars($user['vards']); ?></p>
        <p><strong>Uzvārds:</strong> <?php echo htmlspecialchars($user['uzvards']); ?></p>
        <p><strong>E-pasts:</strong> <?php echo htmlspecialchars($user['epasts']); ?></p>
    </div>

    <h3>Mainīt paroli</h3>
    <form method="post" action="profils.php">
        <div class="form-group">
            <label for="old_password">Vecā parole:</label>
            <input type="password" id="old_password" name="old_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">Jaunā parole:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Apstiprināt jauno paroli:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn">Saglabāt izmaiņas</button>
    </form>
</div>

<!-- Modal for password change message -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p><?php echo $change_password_message; ?></p>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Display the modal if there is a message to show
    <?php if (!empty($change_password_message)) : ?>
        modal.style.display = "block";
    <?php endif; ?>
</script>

</body>
</html>
