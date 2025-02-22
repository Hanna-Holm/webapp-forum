<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Log out</title>
      <link rel="stylesheet" href="styles/style.css">
</head>

<body>
      <div class="header">
            <a href="index.php">
                  <img src="assets/placeholder-logo-7.png" alt="logo-image" id="logo">
            </a>
      </div>

      <?php
      echo '<div class="thread">
                  <p class="centered-text">Successfully logged out.</p>
                  <a href="index.php"><p class="centered-text">Take me to the log in page</p></a>
            </div>';
      ?>
</body>

</html>