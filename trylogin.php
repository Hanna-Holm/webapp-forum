
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
</head>

<body>

      <div class="grid-container">

            <div class="header">
                  <a href="index.php">
                        <img src="assets/placeholder-logo-7.png" alt="logo-image" id="logo">
                  </a>
            </div>

            <div class="main">
                  <?php
                  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $db = new SQLite3("db/database.db");

                        $entered_email = $_POST['email'];
                        $sql = 'SELECT id, email, username, pw FROM user WHERE email = :entered_email';
                        $statement = $db->prepare($sql);
                        $statement->bindParam(':entered_email', $entered_email, SQLITE3_TEXT);
                        $result = $statement->execute();

                        if ($result) {
                              $row = $result->fetchArray();
                              $entered_pw = $_POST['password'];

                              if ($row) {
                                    $stored_pw = $row['pw'];

                                    if (password_verify($entered_pw, $stored_pw)) {
                                          $email = $row['email'];
                                          $username = $row['username'];
                                          $_SESSION["status"] = "active";
                                          $_SESSION["user_id"] = $row['id'];
                                          $_SESSION["username"] = $row['username'];
                                          $_SESSION["email"] = $row['email'];
                                          header('Location: ' . 'forum/threads.php');
                                          return true;
                                    } else {
                                          echo '<div class="thread"><div class="centered-content">Authentication failed.</div></div>';
                                    }
                              } else {
                                    echo '<div class="thread"><div class="centered-content">Invalid email or password.</div></div>';
                              }
                        } else {
                              echo '<div class="thread"><div class="centered-content">User not found for email: ' . $entered_email . '</div></div>';
                              return false;
                        }

                        $db->close();
                  } else {
                        echo '<div class="thread"><p class="centered-text">Unauthorized access to page.</p>';
                  }
                  echo '<div class="centered-content"><a href="index.php"><button class="return-btn">Back to start page</button></a></div>';
                  ?>
            </div>

      </div>
</body>

</html>