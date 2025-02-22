<?php
session_start();

function UpdatePassword($db)
{
      $newpw = password_hash($_POST['newpw'], PASSWORD_DEFAULT);
      $username = $_SESSION['username'];

      $sql = "UPDATE user SET pw = :pw WHERE username = :username";
      $statement = $db->prepare($sql);
      $statement->bindParam(':pw', $newpw, SQLITE3_TEXT);
      $statement->bindParam(':username', $username, SQLITE3_TEXT);

      $result = $statement->execute();

      if ($result) {
            $db->close();
            echo '<div class="msg"><div class="centered-content">Password changed successfully!<br></div></div>';
            return true;
      } else {
            $db->close();
            echo '<div class="msg"><div class="centered-content">Failed to update password.</div><br></div>';
            return false;
      }
}

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
            if (isset($_SESSION["status"]) && $_SESSION["status"] == "active") {
                  include "../view/header.php";
                  echo '
            <div class="main">
                  <div id="profile-container">';


                  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        include "../validator.php";

                        if (!validate_pw($_POST['newpw'])) {
                              echo '<div id="error-msg">The new password does not meet the criteria.</div>';
                              echo '<br><div class="centered-content"><a href="myprofile.php">Back to my profile</a></div><br>';
                              return;
                        }

                        $db = new SQLite3("../db/database.db");

                        $sql = 'SELECT pw FROM user WHERE username = :username';
                        $statement = $db->prepare($sql);

                        $statement->bindParam(':username', $_SESSION['username'], SQLITE3_TEXT);
                        $result = $statement->execute();

                        if ($result) {
                              $row = $result->fetchArray();
                              $entered_pw = $_POST['currentpw'];

                              if ($row) {
                                    $stored_pw = $row['pw'];

                                    if (password_verify($entered_pw, $stored_pw)) {
                                          UpdatePassword($db);
                                    } else {
                                          echo '<div id="error-msg">The entered password is incorrect.</div>';
                                    }
                                    echo '<br><div class="centered-content"><a href="myprofile.php">Back to my profile</a></div><br>';
                              } else {
                                    echo '<div id="error-msg">The operation failed.</div>';
                              }
                        } else {
                              echo '<div id="error-msg">User not found.</div>';
                        }
                        $db->close();
                  } else {
                        echo '<div class="thread"><p class="centered-text">Unauthorized access to page.</p>';
                  }

                  echo '</div>
            </div>';
            } else {
                  header('Location: ' . '../index.php');
            }
            ?>

            <div class="footer">
            </div>

      </div>
</body>

</html>