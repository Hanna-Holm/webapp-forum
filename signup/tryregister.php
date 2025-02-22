<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Register</title>
      <link rel="stylesheet" href="../styles/style.css">
      <script src="../scripts/script.js" defer></script>
</head>

<body>
      <?php
      include "../validator.php";

      function CheckIfEmailAlreadyExist($db, $email) {
            $sql = 'SELECT email FROM user WHERE email = :email';
            $statement = $db->prepare($sql);
            $statement->bindParam(':email', $email, SQLITE3_TEXT);
            $result = $statement->execute();
            $row = $result->fetchArray();
            
            if ($row) {
                  return true;
            }
            else {
                  return false;
            }
      }

      function RegisterNew()
      {
            $db = new SQLite3("../db/database.db");

            if (CheckIfEmailAlreadyExist($db, $_POST['email'])) {
                  echo '<div class="thread"><div id="error-msg"><div class="centered-content">The email is already registered.</div></div></div>';
                  $db->close();
                  return;
            }

            $hashedpw = password_hash($_POST['newpw'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (email, username, pw) VALUES (:email , :username, :pw)";
            $statement = $db->prepare($sql);
            $statement->bindParam(':email', $_POST['email'], SQLITE3_TEXT);
            $statement->bindParam(':username', $_POST['username'], SQLITE3_TEXT);
            $statement->bindParam(':pw', $hashedpw, SQLITE3_TEXT);

            $result = $statement->execute();

            if ($result) {
                  $db->close();
                  echo '<div class="thread"><div id="msg"><div class="centered-content">User registered successfully!<br>Email: ' . $_POST['email'] . "<br>Username: " . $_POST['username'] . "<br></div></div></div>";
                  return true;
            } else {
                  $db->close();
                  echo '<div class="thread"><div id="error-msg"><div class="centered-content">Failed to register user.</div><br></div></div>';
                  return false;
            }
      }
      ?>
      
      <div class="grid-container">

            <div class="header">
                  <a href="index.php">
                        <img src="../assets/placeholder-logo-7.png" alt="logo-image" id="logo">
                  </a>
            </div>

            <div class="main">
                  <?php
                  if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        if (!validate_username($_POST['username'])) {
                              echo "Invalid username.<br>";
                        }

                        if (!validate_email($_POST['email'])) {
                              echo "Invalid email.<br>";
                        }

                        if (!validate_pw($_POST['newpw'])) {
                              echo "Invalid password.<br>";
                        }

                        if (
                              validate_username($_POST['username'])
                              && validate_email($_POST['email'])
                              && validate_pw($_POST['newpw'])
                        ) {
                              RegisterNew();
                              echo '<br><div class="centered-content"><a href="../index.php"><button class="return-btn">Log in</button></a></div><br>';
                        }
                  } else {
                        header('Location: ' . '../index.php');
                  }


                  ?>
            </div>

      </div>
</body>

</html>