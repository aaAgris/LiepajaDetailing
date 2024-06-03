<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liepaja Detailing - Admin Dashboard</title>
    <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script> 
</head>

<body>
  <?php 
    require("connectDB.php");
    require("navigation.php");

    // Fetch counts from the database
    $pieteikumiCount = mysqli_fetch_array(mysqli_query($savienojums, "SELECT COUNT(*) AS count FROM pieteikumi"))['count'];
    $usersCount = mysqli_fetch_array(mysqli_query($savienojums, "SELECT COUNT(*) AS count FROM users"))['count'];
    $vacanciesCount = mysqli_fetch_array(mysqli_query($savienojums, "SELECT COUNT(*) AS count FROM vacancies"))['count'];
    $darbiTypesCount = mysqli_fetch_array(mysqli_query($savienojums, "SELECT COUNT(*) AS count FROM darbi"))['count'];
  ?>   

  <div class="dashboard">
    <div class="dashboard-item">
      <i class="fas fa-file-alt"></i>
      <div class="dashboard-info">
        <h3><?php echo $pieteikumiCount; ?></h3>
        <p>Pieteikumi</p>
      </div>
    </div>

    <div class="dashboard-item">
      <i class="fas fa-users"></i>
      <div class="dashboard-info">
        <h3><?php echo $usersCount; ?></h3>
        <p>Lietotāji</p>
      </div>
    </div>

    <div class="dashboard-item">
      <i class="fas fa-briefcase"></i>
      <div class="dashboard-info">
        <h3><?php echo $vacanciesCount; ?></h3>
        <p>Vakances</p>
      </div>
    </div>

    <div class="dashboard-item">
      <i class="fas fa-tasks"></i>
      <div class="dashboard-info">
        <h3><?php echo $darbiTypesCount; ?></h3>
        <p>Darbu veidi</p>
      </div>
    </div>
  </div>

</body>
</html>