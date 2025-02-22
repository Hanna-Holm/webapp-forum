<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Change username</title>
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
            <form name="changeusernameform" action="trychangeusername.php" method="post" class="noflexform">
                  <label for="newusername">NEW USERNAME</label>
                  <input type="text" name="newusername" placeholder="Enter a new username" 
                        required minlength=4>
                  <input type="submit" value="Update">
            </form>
      </div>
            </div>
            
            ';
                  } else {
                        header('Location: ' . '../index.php');
                  }
                  ?>

                  <div class="footer">
                  </div>

            </div>
</body>

</html>