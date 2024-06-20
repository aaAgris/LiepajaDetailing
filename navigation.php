<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    if(!isset($_SESSION['lietotajvards_LYXQT'])){
        header("Refresh:0; url=login.php");
        exit();
    }
?>

<header class="header">
    <a href="#" class="logo"> <i class="fa fa-car"></i> LPD Admin </a>

    <nav class="navbar">
        <a href="index1.php"> <i class="fas fa-home"></i>Sākums </a>
        <a href="cenasPievienot.php"> <i class="fas fa-tasks"></i>Cenas </a>
        <a href="darbiPievienot.php"> <i class="fas fa-database"></i>Darbi </a>
        <a href="pieteikumiAdmin.php"> <i class="fas fa-database"></i>Pieteikumi </a>
        <a href="vakancesAdmin.php"> <i class="fas fa-tasks"></i>Vakances </a>
        <a href="cvAdmin.php"> <i class="fas fa-tasks"></i> Jauni Darbinieki </a>
        <?php 
        if($_SESSION['loma_LYXQT'] == "owner"){
          echo '<a href="lietotajiAdmin.php"><i class="fa fa-users"></i> Lietotāji</a>';
        }
      ?>
        <a href="profils.php"> <i class="fas fa-user"></i>Profils </a>
        <a href="logout.php"> <i class="fas fa-power-off"></i>Izlogoties </a>
        <a href="index.php" target="index.php"> <i class="fas fa-sign-out-alt"></i>Uz klientu lapu </a>
    </nav>

</header>