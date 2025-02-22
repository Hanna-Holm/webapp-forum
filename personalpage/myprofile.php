<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Forum</title>
      <link rel="stylesheet" href="../styles/style.css">
      <script src="../scripts/script.js" defer></script>
</head>

<body>
      <div class="grid-container">

            <?php
            include "../view/header.php";
            ?>

            <div class="main">
                  <?php
                  if (isset($_SESSION["status"]) && $_SESSION["status"] == "active") {
                        echo '
                  <div id="profile-container">
                        <h3>Welcome ' . $_SESSION['username'] . '</h3>
                        <p>Your username: ' . $_SESSION['username'] . ' <a href="changeusername.php">Change</a></p>
                        <p>Your email: ' . $_SESSION['email'] . ' <a href="changeemail.php">Change</a></p>
                        <p><a href="changepw.php">Change password</a></p>
                  </div>
            </div>
            ';
                  } else {
                        header('Location: ' . '../index.php');
                  }
                  ?>

            </div>
</body>

</html>