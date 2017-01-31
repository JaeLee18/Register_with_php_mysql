<?php

  // is_blank('abcd')
  function is_blank($value) {
    // TODO
    if(strlen($value) == 0){
      return true;
    }
    else {
      return false;
    }
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    // TODO
    if(strlen($value) >= $options['min'] && strlen($value) <= $options['max']){
      return true;
    }
    else {
      return false;
    }

  }
  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // TODO
    if(filter_var($value, FILTER_VALIDATE_EMAIL)){
      return true;
    }
    else{
      return false;
    }

  }

  function at_least_two($value){
    if(strlen($value) >= 2){
      return true;
    }
    else {
      return false;
    }
  }

  function is_username($value){
    if(strlen($value) >= 8){
      return true;
    }
    else {
      return false;
    }
  }
  // username: letters, numbers, symbols: _
  function nameValidate($name){
    if(preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $name)){
      return true;
    }
    else false;
  }
  // first_name, last_name: letters, spaces, symbols: - , . '
  function usernameValidate($username){
    if(preg_match('/\A[A-Za-z\_\']+\Z/', $username)){
      return true;
    }
    else false;
  }

?>
