<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Post new thread</title>
      <link rel="stylesheet" href="../styles/style.css">
      <script src="../scripts/script.js" defer></script>
</head>

<body>
      <?php

      function validate()
      {
            if ((strlen(trim($_POST['title'])) > 3) && (strlen(trim($_POST['comment'])) > 7)) {
                  return true;
            }
            return false;
      }

      function PostNewThread()
      {
            $db = new SQLite3("../db/database.db");
            $sql = "INSERT INTO comment (user_id, is_thread_starter, title, comment, time_stamp) 
                  VALUES (:user_id , :is_thread_starter, :title, :comment, :time_stamp)";
            $statement = $db->prepare($sql);

            $is_thread_starter = true;
            $time_stamp = date('Y-m-d H:i');

            $statement->bindParam(':user_id', $_SESSION['user_id'], SQLITE3_TEXT);
            $statement->bindParam(':is_thread_starter', $is_thread_starter, SQLITE3_TEXT);
            $statement->bindParam(':title', $_POST['title'], SQLITE3_TEXT);
            $statement->bindParam(':comment', $_POST['comment'], SQLITE3_TEXT);
            $statement->bindParam(':time_stamp', $time_stamp, SQLITE3_TEXT);

            $result = $statement->execute();

            if ($result) {
                  echo '<h3>Thread created successfully!</h3>
                  <p class="centered-content">My discussions:</p>';

                  $result = $db->query('SELECT comment_id, user_id, is_thread_starter, title, comment, time_stamp, username, id 
                  FROM comment JOIN user ON user.id = comment.user_id 
                  WHERE user.id ="' 
                  . $_SESSION["user_id"] . '"' 
                  . 'ORDER BY time_stamp DESC');

                  while ($row = $result->fetchArray()) {
                        if ($row['is_thread_starter'] == 1) {
                              $id = $row['comment_id'];
                              echo '<div class="thread">
                                                      <a href="showthread.php?thread_comment_id=' . $id . '" class="thread-link">'
                                    . '<div class="threadtitle"><h3>' . $row['title'] . '</h3></div>'
                                    . '<div class="authorandcomment">'
                                    . '<div class="author"><p>' . $row['username'] . "<br>" . $row['time_stamp'] . "</p></div>"
                                    . '<div class="comment">' . substr($row['comment'], 0, 100)
                                    . ' ... </div>'
                                    . '</div> 
                                          <div class="right-content"><p>Go to thread</p></div>'
                                    . '</a>
                                    </div>';
                        }
                  }
                  $db->close();

                  return true;
            } else {
                  $db->close();
                  echo '<div class="thread">Failed to create new thread.<br></div>';
                  return false;
            }
      }
      ?>

      <div class="grid-container">

            <?php
            include "../view/header.php";
            ?>

            <div class="main">
                  <?php
                  if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (validate()) {
                              PostNewThread();
                        } else {
                              echo '<div class="thread"><br><p class="centered-content">Invalid comment. Title muser be at least 4 characters and comment must be at least 8 characters.</p><br></div>';
                              echo '<div class="centered-content"><a href="threads.php" class="no-deco-link" id="back-to-forum-btn"><button class="return-btn">Back to the forum</a></button></div>';
                        }
                  } else {
                        header('Location: ' . '../index.php');
                  }
                  ?>
            </div>
      </div>
</body>

</html>