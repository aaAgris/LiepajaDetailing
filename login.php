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

<div class="modalLogin">
    <div class="apply1">
        <h2>Ielogoties LPD</h2>
        <p class="login-kluda1">
            <?php
                if(isset($_POST["ielogoties1"])){
                    session_start();
                    $Lietotajvards = mysqli_real_escape_string($savienojums, $_POST["lietotajs1"]);
                    $Parole = mysqli_real_escape_string($savienojums, $_POST["parole1"]);

                    $lietotaja_atrasana_SQL = "SELECT * FROM users WHERE lietotajvards = '$Lietotajvards'";
                    $atrasanas_rezultats = mysqli_query($savienojums, $lietotaja_atrasana_SQL);

                    if(mysqli_num_rows($atrasanas_rezultats) == 1){
                        while($ieraksts = mysqli_fetch_assoc($atrasanas_rezultats)){
                            if($ieraksts["statuss"]== "deleted"){
                                echo "Lietotājs ir dzēsts!";
                            }else{

                            
                            if(password_verify($Parole, $ieraksts["parole"])){
                                $_SESSION["lietotajvards_LYXQT"] = $ieraksts["lietotajvards"];
                                $_SESSION["loma_LYXQT"] = $ieraksts["loma"];
                                header("location:index1.php");
                            }else{
                                echo "Nepareizs lietotājs vai parole!";
                            }
                        }
                    }

                    }else{
                        echo "Nepareizs lietotājs vai parole!";
                    }
                }
            ?>
        </p>
        <form class="loginForm" action="" method="post">
            <label>Lietotājvārds:</label>
            <input type="text" name="lietotajs1" required>
            <label>Parole:</label>
            <input type="password" name="parole1" required>
            <input type="submit" name="ielogoties1" value="Ielogoties" class="btn1">
        </form>
    </div>
</div>
</body>
</html>