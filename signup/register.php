<?php

echo '
<div id="card-menu">
      <div id="active-box">
            <p>SIGN UP</p>
      </div>

      <button onclick="GetLoginForm()">
            <p>LOG IN</p>
      </button>
</div>

<div id="start-form-container">
      <form name="register" action="signup/tryregister.php" method="post">
            <div id="center-form">
                  <label for="email">EMAIL</label>
                  <input type="email" name="email" id="email" placeholder="example@mail.com" 
                        onkeyup="CheckIfValidEmail()" required>
                  <div id="email-validation-infobox" class="field-flex-container">
                        <div id="email-validation-img"></div>
                        <p>Enter a valid email.</p>
                  </div>

                  <label for="username">USERNAME</label>
                  <input type="text" name="username" id="username" placeholder="Enter a username" 
                        onkeyup="CheckIfValidUsername()" 
                        required minlength=4>
                  <div id="username-validation-infobox" class="field-flex-container">
                        <div id="username-validation-img"></div>
                        <p>Enter a username at least 4 characters long.</p>
                  </div>
                  
                  <label for="newpw">PASSWORD</label>
                  <input type="password" name="newpw" id="newpw" onkeyup="CheckIfValidPw()" placeholder="Enter a password"
                         required>
                        
                        <p>The password must meet the following critera:<br>
                        <ul id="pw-critera-list">
                        <li><div id="length-validation-img"></div>Must be at least 8 characters long</li>
                        <li><div id="lower-validation-img"></div>Must contain at least one lowercase letter</li>
                        <li><div id="upper-validation-img"></div>Must contain at least one uppercase letter</li>
                        <li><div id="number-validation-img"></div>Must contain at least one number</li>
                        <li><div id="specialchar-validation-img"></div>Must contain at least one special character</li>
                        </ul>
                  </p>
                  <input type="submit" value="Register">
            </div>
      </form>
</div>';

?>