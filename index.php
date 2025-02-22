<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Log in</title>
      <link rel="stylesheet" href="styles/style.css">
      <script src="scripts/script.js" defer></script>
      <script src="scripts/ajax.js" defer></script>
</head>

<body>

      <div class="grid-container">
            <?php
            if (isset($_SESSION["status"]) && $_SESSION["status"] == "active") {
                  header('Location: ' . 'forum/threads.php');
                  exit();
            }
            ?>
            <div class="header">
                  <a href="index.php">
                        <img src="assets/placeholder-logo-7.png" alt="logo-image" id="logo">
                  </a>
            </div>

            <div class="main" id="start-main-content">
                  
                  <?php include "login.php" ?>
                  
            </div>

</body>

</html>