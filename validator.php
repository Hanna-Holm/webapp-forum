<?php

function validate_username($username)
{
      if (strlen(trim($username)) > 3) {
            return true;
      }
      return false;
}

function validate_email($email)
{
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_pw($pw)
{
      $pattern = "/(?=.*[a-zåäö])(?=.*[A-ZÅÄÖ])(?=.*[0-9]).{8,}/";
      return preg_match($pattern, $pw);
}

?>