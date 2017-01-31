<?php
  require_once('../private/initialize.php');


  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database
  if(is_post_request()) {
    // is a POST request
    $first_name= '';
    $valid_fname = false;
    $blank_fname = false;

    $last_name = '';
    $valid_lname = false;
    $blank_lname = false;

    $email = '';
    $valid_email = false;

    $username = '';
    $valid_username = false;
    $name_option = array(
      'min'=>2,
      'max'=>255
    );
    $username_option = array(
      'min'=>8,
      'max'=>255
    );
    if(has_length($_POST['first_name'], $name_option) || nameValidate($_POST['first_name'])){
      $first_name = $_POST['first_name'];
      $valid_fname = true;
    }
    if (is_blank($_POST['first_name'])){
      $blank_fname = true;
    }
    if (is_blank($_POST['last_name'])){
      $blank_lname = true;
    }
    if(has_length($_POST['last_name'], $name_option) || nameValidate($_POST['last_name'])){
      $first_name = $_POST['last_name'];
      $valid_lname = true;
    }
    if(has_length($_POST['username'], $name_option) || usernameValidate($_POST['username'])){
      $username = $_POST['username'];
      $valid_username = true;
    }

    if(has_valid_email_format($_POST['email'])){
      $email = $_POST['email'];
      $valid_email = true;
    }
    $result = check_username($username, $db);
    $usernameRows = $result->num_rows;
    $userUnique = false;
    if($usernameRows == 0 && $valid_username){
      $userUnique = true;
    }

    // if(is_username($_POST['username'])){
    //   $username = $_POST['username'];
    //   $valid_username = true;
    // }

    $valid_format = false;
    if($userUnique && $valid_username&& $valid_email&& $valid_lname && $valid_fname){
      $valid_format = true;
    }


    if($valid_format){
      // Write SQL INSERT statement
      $sql = "INSERT INTO users (first_name, last_name, email, username, created_at)
      VALUES ('$first_name', '$last_name', '$email', '$username', NOW())";
      // For INSERT statments, $result is just true/false
       $result = db_query($db, $sql);
       if($result) {
         db_close($db);


      //   TODO redirect user to success page
      $succesFilePage = "registration_success.php";
        header('Location: registration_success.php');

      } else {
        // The SQL INSERT statement failed.
        // Just show the error, not the form
        echo db_error($db);
        db_close($db);
        exit;
      }
    }

    // Not a valid foramt
    else{
        $error_msg = 'Please fix following error: <br><br>';
        if ($blank_fname){
            $error_msg = $error_msg . "</t>* First name cannot be blank.<br>";
        }
        if(!$valid_fname && !$blank_fname){
          $error_msg = $error_msg . "</t>* Your first name is incorrect.<br>";
        }
        if ($blank_lname){
          $error_msg = $error_msg . "</t>* Last name cannot be blank.<br>";
        }
        if(!$valid_lname && !$blank_lname){
          $error_msg = $error_msg . "</t>* Last name must be between 2 and 255.<br>";
        }
        if(!$valid_email){
          $error_msg = $error_msg . "</t>* Email must be a valid format.<br>";
        }
        if(!$valid_username){
          $error_msg = $error_msg . "</t>* Username must be at least 8 characters.<br>";
        }
        if(!$userUnique && $valid_username){
          $error_msg = $error_msg . "</t>* Username is not unique.<br><br>";
        }
    }

  }



?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
    if (isset($error_msg)){
      echo $error_msg;
    }


  ?>

  <!-- TODO: HTML form goes here -->
  <form action="register.php" method="post">
    First name:<br>
    <input type="text" name="first_name"
    value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>"><br>
    Last name:<br>
    <input type="text" name="last_name"
    value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>"><br>
    email:<br>
    <input type="text" name="email"
    value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"><br>
    username:<br>
    <input type="text" name="username"
    value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>"><br>
    <br>
    <input type="submit" name="submit" value="Submit" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
