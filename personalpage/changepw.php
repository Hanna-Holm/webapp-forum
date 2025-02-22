<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Change password</title>
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
            <form name="changepwform" action="trychangepw.php" method="post" class="noflexform">
                  <label for="currentpw">CURRENT PASSWORD</label>
                  <input type="password" name="currentpw" placeholder="Enter you current password" 
                        required>
                  <label for="newpw">NEW PASSWORD</label>
                  <input type="password" name="newpw" id="newpw" placeholder="Enter a new password" 
                        onkeyup="CheckIfValidPw()" 
                        required>
                  <p>The password must meet the following critera:<br>
                  <ul id="pw-critera-list">
                  <li><div id="length-validation-img"></div>Must be at least 8 characters long</li>
                  <li><div id="lower-validation-img"></div>Must contain at least one lowercase letter</li>
                  <li><div id="upper-validation-img"></div>Must contain at least one uppercase letter</li>
                  <li><div id="number-validation-img"></div>Must contain at least one number</li>
                  <li><div id="specialchar-validation-img"></div>Must contain at least one special character</li>
                  </ul>
                  </p>
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