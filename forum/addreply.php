<?php
session_start();

AddReply(); 

function GetCommentId($db, $comment, $time_stamp) {
      $sql = "SELECT comment_id FROM comment WHERE (comment = :comment AND user_id = :user_id AND time_stamp = :time_stamp)";
      $statement = $db->prepare($sql);
      $statement->bindParam(':comment', $comment, SQLITE3_TEXT);
      $statement->bindParam(':user_id', $_SESSION['user_id'], SQLITE3_TEXT);
      $statement->bindParam(':time_stamp', $time_stamp, SQLITE3_TEXT);

      try {
            $result = $statement->execute();
            $row = $result->fetchArray();
            return $row['comment_id'];
      } catch (Exception $e) {
            return null;
      }
}

function AddReply()
{
      if (isset($_SESSION["status"]) && $_SESSION["status"] == "active")
      {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                  $db = new SQLite3("../db/database.db");
                  $sql = "INSERT INTO comment (user_id, comment, time_stamp, parent_comment_id, thread_comment_id) VALUES (:user_id, :comment, :time_stamp, :parent_comment_id, :thread_comment_id)";
                  $statement = $db->prepare($sql);
      
                  $time_stamp = date('Y-m-d H:i');
      
                  $statement->bindParam(':user_id', $_SESSION['user_id'], SQLITE3_TEXT);
                  $statement->bindParam(':comment', $_POST['reply'], SQLITE3_TEXT);
                  $statement->bindParam(':time_stamp', $time_stamp, SQLITE3_TEXT);
                  $statement->bindParam(':parent_comment_id', $_POST['parent_comment_id'], SQLITE3_TEXT);
                  $statement->bindParam(':thread_comment_id', $_POST['thread_comment_id'], SQLITE3_TEXT);
      
                  if ($statement->execute()) {
                        $comment_id = GetCommentId($db, $_POST['reply'], $time_stamp);

                        if ($comment_id != null) {
                              echo '<div class="replies">'
                                    . '<div class="comment-id">Comment ID: ' . $comment_id . '</div>'
                                    . '<div class="authorandcomment">'
                                          . '<div class="author"><p>' . $_SESSION['username'] . "<br>" . $time_stamp . "</p></div>"
                                          . '<div class="comment">' . $_POST['reply'] . '</div>
                                          </div>
                                    </div><br>';

                        }
                  }
                  $db->close();
            } else {
                  echo "Failed to create new comment.<br>";
            }
      } else {
            header('Location: ' . '../index.php');
      }
}

?>