<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Change email</title>
      <link rel="stylesheet" href="../styles/style.css">
      <script src="../scripts/ajax.js" defer></script>
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
                        echo
                              '<div id="profile-container">
                        <form name="changeemailform" class="noflexform">
                              <label for="newemail">NEW EMAIL</label>
                              <div class="field-flex-container">
                                    <input type="email" name="newemail" id="newemail" class="email-input"
                                          placeholder="Enter your email" onblur="checkIfMatched()" required>
                                    <div id="first-validation-img"></div>
                              </div>
                              <label for="repeatemail">REPEAT EMAIL</label>
                              <div class="field-flex-container">
                                    <input type="email" name="repeatemail" id="repeatemail"
                                          placeholder="Enter your email again" onkeyup="checkIfMatched()" required>
                                    <div id="second-validation-img"></div>
                              </div>
                              <button type="button" onclick="UpdateEmail()">Update</button>
                        </form>

                        <div id="result-box"></div>
                  </div>

            </div>';
                  } else {
                        header('Location: ' . '../index.php');
                  }
                  ?>

            </div>
</body>

</html>