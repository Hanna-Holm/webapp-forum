<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Search result</title>
      <link rel="stylesheet" href="../styles/style.css">
      <script src="../scripts/script.js" defer></script>
</head>

<body>
      <div class="grid-container">

            <?php
            include "../view/header.php";
            ?>

            <div class="main">
                  <div class="centered-content">
                        <h2>Search result</h2>
                  </div>
                  <?php
                  if (isset($_SESSION["status"]) && $_SESSION["status"] == "active") {
                        $db = new SQLite3("../db/database.db");
                        $search = '%' . $_GET['search-input'] . '%';
                        $sql = 'SELECT * FROM comment JOIN user ON user.id = comment.user_id WHERE comment LIKE :search ORDER BY time_stamp DESC';
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':search', $search, SQLITE3_TEXT);
                        $result = $stmt->execute();

                        while ($row = $result->fetchArray()) {
                              if ($row['is_thread_starter']) {
                                    $id = $row['comment_id'];
                              } else {
                                    $id = $row['thread_comment_id'];
                              }
                              echo '<a href="showthread.php?thread_comment_id=' . $id . '" class="thread-link">'
                                    . '<div class="thread">' 
                                          .'<div class="comment-id">Comment ID: ' . $row['comment_id'] . '</div>'
                                          .'<div class="authorandcomment">'
                                                . '<div class="author"><p>' . $row['username'] . "<br>" . $row['time_stamp'] . "</p></div>"
                                                . '<div class="comment">' . $row['comment'] . '</div>
                                          </div>
                                          <div class="right-content">
                                                Go to thread
                                          </div>'
                                    . '</div>
                                    </a></br>';
                        }

                        $db->close();
                  } else {
                        header('Location: ' . '../index.php');
                  }
                  ?>

            </div>

      </div>
</body>

</html>