function AddComment(thread_comment_id) {
      let comment = document.getElementById('comment').value;

      if (!comment) {
            alert('Please enter a comment.');
            return;
      }

      let xhttp = new XMLHttpRequest();

      xhttp.onload = function () {
            document.getElementById("comment-flow").innerHTML += this.responseText;
            document.getElementById('comment').value = '';
      }

      xhttp.open("POST", "addcomment.php");
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("comment=" + encodeURIComponent(comment) + "&thread_comment_id=" + thread_comment_id);
}

function openReplyBox(thread_comment_id, comment_id, user_id) {
      let existingReplyBoxes = document.querySelector('.reply-box');

      if (existingReplyBoxes) {
            existingReplyBoxes.remove();
      }

      let replyBox = document.createElement('div');
      replyBox.className = 'reply-box';
      replyBox.innerHTML = `
        <form id="reply-form">
            <textarea placeholder="Enter your reply" class="reply" id="reply-comment-input" required></textarea>
            <button type="button" onclick="postReply(${thread_comment_id}, ${comment_id}, ${user_id})">Post reply</button>
        </form>
    `;

      let commentElement = document.getElementById(`comment_id_${comment_id}`);
      commentElement.after(replyBox);
}

function postReply(thread_comment_id, parent_comment_id, user_id) {
      let replyInput = document.getElementById("reply-comment-input").value;

      if (!replyInput) {
            alert("Please enter a reply.");
            return;
      }

      let xhttp = new XMLHttpRequest();

      xhttp.onload = function () {
            document.getElementById(`comment_id_${parent_comment_id}`).after += this.responseText;
            document.getElementById('reply-form').value = '';
      };

      xhttp.open("POST", "addreply.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhttp.send("reply=" + encodeURIComponent(replyInput) +
            "&thread_comment_id=" + encodeURIComponent(thread_comment_id) +
            "&parent_comment_id=" + encodeURIComponent(parent_comment_id) +
            "&user_id=" + encodeURIComponent(user_id));

            location.reload();
}

function renderReply() {

      location.reload();
}

function UpdateEmail() {
      const newemail = document.getElementById('newemail').value;
      const repeatemail = document.getElementById('repeatemail').value;

      if (!newemail) {
            alert('Please enter an email.');
            return;
      } else if (newemail !== repeatemail) {
            alert('Emails do not match.');
            return;
      }

      const xhttp = new XMLHttpRequest();
      xhttp.onload = function () {
            document.getElementById("result-box").innerHTML += '<div class="centered-content">The email was successfully updated.</div><br><div class="centered-content"><a href="myprofile.php">Back to my profile</a></div><br>';
            document.querySelectorAll('input').forEach(input => input.value = '');

            const firstValidationImg = document.getElementById('first-validation-img');
            const secondValidationImg = document.getElementById('second-validation-img');
            firstValidationImg.style.display = 'none';
            secondValidationImg.style.display = 'none';
      }

      xhttp.open("POST", "trychangeemail.php");
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("newemail=" + encodeURIComponent(newemail) + "&repeatemail=" + encodeURIComponent(repeatemail));
}

function GetRegisterForm() {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function () {
            document.getElementById("start-main-content").innerHTML = this.responseText;
      }
      xmlhttp.open("GET", "signup/register.php");
      xmlhttp.send();
}

function GetLoginForm() {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function () {
            document.getElementById("start-main-content").innerHTML = this.responseText;
      }
      xmlhttp.open("GET", "login.php");
      xmlhttp.send();
}