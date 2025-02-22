<?php

echo '
<div id="card-menu">
      <button onclick="GetRegisterForm()">
            <p>SIGN UP</p>
      </button>
      
      <div id="active-box">
            <p>LOG IN</p>
      </div>
</div>

<div id="start-form-container">
      <form name="login" action="trylogin.php" method="post">
            <div id="center-form">
                  <label for="email">EMAIL</label>
                  <input type="email" name="email" id="email" placeholder="example@mail.com" 
                        required>
                  <label for="password">PASSWORD</label>
                  <input type="password" name="password" id="password"
                        placeholder="Enter your password" 
                        required>
                  <input type="submit" value="Log in">
            </div>
      </form>
</div>';

?>