<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Forum - all threads</title>
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
                        <h2>Diskussioner</h2>
                  </div>
                  <?php
                  if (isset($_SESSION["status"]) && $_SESSION["status"] == "active") {
                        $db = new SQLite3("../db/database.db");
                        $result = $db->query('SELECT * FROM comment JOIN user ON user.id = comment.user_id ORDER BY time_stamp DESC');

                        while ($row = $result->fetchArray()) {
                              if ($row['is_thread_starter'] == 1) {
                                    $id = $row['comment_id'];
                                    echo '<div class="thread">
                                                <a href="showthread.php?thread_comment_id=' . $id . '" class="thread-link">'
                                                .'<div class="comment-id">Comment ID: ' . $row['comment_id'] . '</div>'
                                          . '<div class="threadtitle"><h3>' . $row['title'] . '</h3></div>'
                                          . '<div class="authorandcomment">'
                                          . '<div class="author"><p>' . $row['username'] . "<br>" . $row['time_stamp'] . "</p></div>"
                                          . '<div class="comment">' . substr($row['comment'], 0, 100)
                                          . ' ... </div>'
                                          . '</div> 
                                                      <div class="right-content"><p>Läs tråd</p></div>'
                                          . '</a>
                                          </div>';
                              }
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