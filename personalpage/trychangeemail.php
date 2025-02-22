<?php
session_start();

function UpdateEmail($db)
{
      $newemail = $_POST['newemail'];
      $username = $_SESSION['username'];

      $sql = "UPDATE user SET email = :email WHERE username = :username";
      $statement = $db->prepare($sql);
      $statement->bindParam(':email', $newemail, SQLITE3_TEXT);
      $statement->bindParam(':username', $username, SQLITE3_TEXT);

      try {
            $result = $statement->execute();

            if ($result) {
                  $db->close();
                  echo '<div class="centered-content">Email changed successfully!<br><br></div>';
                  $_SESSION['email'] = $newemail;
                  return true;
            } else {
                  $db->close();
                  echo '<div class="centered-content">Failed to update email.</div><br>';
                  return false;
            }
      } catch(Exception $e) {
            echo 'Could not update email.';
      }
      
}


if (isset($_SESSION["status"]) && $_SESSION["status"] == "active") {
      echo '
            <div class="main">
                  <div id="profile-container">';

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $db = new SQLite3("../db/database.db");

            try {
                  if ($_POST['newemail'] == $_POST['repeatemail']) {
                        UpdateEmail($db);
                  } else {
                        echo '<div class="centered-content">Failed to update email. The emails do not match.</div><br>';
                  }
            } catch(Exception $e) {
                  echo 'Failed to update email: ' . $e->getMessage();
            }
            
            $db->close();
      }

      echo '</div>
            </div>';
} else {
      echo '<div class="thread"><p class="centered-text">Unauthorized access to page.</p></div>';
      exit();
}
?>