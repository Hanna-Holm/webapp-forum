<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Showing thread</title>
      <link rel="stylesheet" href="../styles/style.css">
      <script src="../scripts/script.js" defer></script>
      <script src="../scripts/ajax.js" defer></script>
</head>

<body>
      <div class="grid-container">

            <?php
            include "../view/header.php";
            ?>

            <div class="main">
                  <br>
                  <a href="threads.php" class="no-deco-link" id="back-to-forum-btn"><button class="return-btn">Back to the forum</a></button>
                  <?php
                  if (isset($_SESSION["status"]) && $_SESSION["status"] == "active") {

                        if (isset($_GET['thread_comment_id'])) {
                              // Fetching the thread start comment and its author
                              $sql = 'SELECT user_id, title, comment, comment_id, time_stamp, username FROM comment 
                                    JOIN user ON user.id = comment.user_id WHERE comment_id = :thread_comment_id';

                              $thread_comment_id = $_GET['thread_comment_id'];

                              $db = new SQLite3("../db/database.db");
                              $stmt = $db->prepare($sql);
                              $stmt->bindValue(':thread_comment_id', $thread_comment_id, SQLITE3_INTEGER);

                              $threadstart = $stmt->execute();
                              $startcomment = $threadstart->fetchArray();

                              if ($startcomment) {
                                    echo '<div class="threadtitle"><h2>' . $startcomment['title'] . '</h2></div>';
                                    echo '<div class="thread">'
                                          . '<div class="comment-id">Comment ID: ' . $startcomment['comment_id'] . '</div>'
                                          . '<div class="authorandcomment">'
                                          . '<div class="author"><p>' . $startcomment['username'] . "<br>" . $startcomment['time_stamp'] . "</p></div>"
                                          . '<div class="comment">' . $startcomment['comment'] . '</div>'
                                          . '</div>'
                                          . '</div>';
                              }

                              ?>

                              <div class="centered-content">
                                    <p>Kommentarer:</p>
                              </div>
                              <div id="comment-flow">
                                    <?php

                                    function RenderChildComments($db, $current_comment_id)
                                    {
                                          $sql = 'SELECT user_id, username, comment, comment_id, time_stamp, parent_comment_id FROM comment 
                                                      JOIN user ON user.id = comment.user_id WHERE parent_comment_id = :current_comment_id';
                                          $stmt = $db->prepare($sql);
                                          $stmt->bindValue(':current_comment_id', $current_comment_id, SQLITE3_INTEGER);
                                          $result = $stmt->execute();
                                          
                                          if ($result) {
                                                echo '<div id="replies-container-' . $current_comment_id . '">';
                                                while ($row = $result->fetchArray()) {
                                                      $comment_id = $row['comment_id'];
                                                      echo '<div class="replies">'
                                                            . '<div class="comment-id">Comment ID: ' . $comment_id . ' (Replying to comment ID ' . $current_comment_id .')</div>'
                                                            . '<div class="authorandcomment">'
                                                            . '<div class="author"><p>' . $row['username'] . "<br>" . $row['time_stamp'] . "</p></div>"
                                                            . '<div class="comment">' . $row['comment'] . '</div>
                                                            </div>
                                                            </div>
                                                            <br>';
                                                }
                                                echo '</div>';
                                          }
                                    }

                                    $sql = 'SELECT user_id, username, title, comment, comment_id, time_stamp, parent_comment_id, thread_comment_id FROM comment 
                                                JOIN user ON user.id = comment.user_id WHERE thread_comment_id = :thread_comment_id';
                                    $stmt = $db->prepare($sql);
                                    $stmt->bindValue(':thread_comment_id', $thread_comment_id, SQLITE3_INTEGER);
                                    $result = $stmt->execute();

                                    while ($row = $result->fetchArray()) {
                                          $current_comment_id = $row['comment_id'];
                                          if (!$row['parent_comment_id'])
                                          {
                                                echo '<div class="thread" id="comment_id_' . $current_comment_id . '">'
                                                      . '<div class="comment-id">Comment ID: ' . $current_comment_id . '</div>'
                                                      . '<div class="authorandcomment">'
                                                      . '<div class="author"><p>' . $row['username'] . "<br>" . $row['time_stamp'] . "</p></div>"
                                                      . '<div class="comment">' . $row['comment'] . '</div>
                                                                  </div>
                                                                  <div class="right-content">
                                                                        <button type="button" class="reply-btn" 
                                                                              onclick="openReplyBox(' . $thread_comment_id . ', ' . $current_comment_id . ', ' . $_SESSION['user_id'] . ')">Reply</button>
                                                                  </div>
                                                            </div>
                                                            <br>';
                                          }
                                          RenderChildComments($db, $current_comment_id);
                                    }

                                    $db->close();
                                    ?>
                              </div>

                              <div id="form-container">
                                    <form name="newcomment">
                                          <div id="center-form">
                                                <label for="comment">
                                                      <div class="centered-content">YOUR COMMENT</div>
                                                </label>
                                                <textarea name="comment" id="comment" required></textarea>
                                                <div class="centered-content">
                                                      <button type="button"
                                                            onclick="AddComment(<?php echo $thread_comment_id; ?>)">Post
                                                            comment</button>
                                                </div>
                                          </div>
                                    </form>
                                    <br><br><br>
                              </div>

                              <?php
                        } else {
                              echo 'Invalid thread ID.';
                              return;
                        }

                  } else {
                        header('Location: ' . '../index.php');
                  }

                  ?>
            </div>


      </div>
</body>

</html>