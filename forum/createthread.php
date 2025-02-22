<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Create new thread</title>
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
                        echo
            '<div id="form-container">
                  <form name="newthread" action="trypostnewthread.php" method="post">
                        <div id="center-form">
                              <label for="title">THREAD TITLE</label>
                              <input type="text" name="title" id="title" placeholder="Enter your title" 
                                    required minlength=4>
                              <label for="comment">YOUR POST</label>
                              <textarea name="comment" id="comment" 
                                    required minlength=8></textarea>
                              <input type="submit" value="Post">
                        </div>
                  </form>
            </div>';
            } else {
                  header('Location: ' . '../index.php');
            }
                  ?>

            </div>

            <div class="footer">
            </div>

      </div>
</body>

</html>