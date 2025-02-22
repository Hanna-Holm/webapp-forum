<?php
session_start();

function TryUpdateUsername($db)
{
      $username = $_SESSION['username'];
      $newusername = $_POST['newusername'];
      $sql = "UPDATE user SET username = :newusername WHERE username = :username";
      $statement = $db->prepare($sql);
      $statement->bindParam(':newusername', $newusername, SQLITE3_TEXT);
      $statement->bindParam(':username', $username, SQLITE3_TEXT);

      $result = $statement->execute();

      if ($result) {
            $_SESSION['username'] = $newusername;
            echo '<div class="centered-content">Username changed successfully!<br><br></div>';
            $db->close();
            return true;
      } else {
            echo '<div class="centered-content">Failed to update username.</div><br>';
            $db->close();
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
                  echo '<div class="main">
                        <div id="profile-container">';

                  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $db = new SQLite3("../db/database.db");
                        TryUpdateUsername($db);
                        echo '<br><div class="centered-content"><a href="myprofile.php">Back to my profile</a></div><br>';
                  } else {
                        echo '<div class="thread"><p class="centered-text">Unauthorized access to page.</p></div></div>';
                  }
            } else {
                  header('Location: ' . '../index.php');
            }
            ?>

            <div class="footer">
            </div>

      </div>
</body>

</html>