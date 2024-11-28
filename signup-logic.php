<?php
  require 'config/database.php';

  // GET SIGN FORM DATA IF SIGNUP BUTTON WAS CLICKED
  if(isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES['avatar'];

    //VALID INPUT VALUES
    if (!$firstname){
        $_SESSION['signup'] = "Please enter your First Name";
    }elseif(!$lastname){
        $_SESSION['signup'] = 'Please enter your Last Name';

    }elseif(!$username){
      $_SESSION['signup'] = 'Please enter your Username';

    }elseif(!$email){
      $_SESSION['signup'] = 'Please enter your Email';

    }elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
      $_SESSION['signup'] = 'Password should be 8+ characters';

    }elseif(!$avatar['name']){
      $_SESSION['signup'] = "Please add avatar";

    } else {
      //check if password don't match
        if($createpassword !== $confirmpassword) {
          $_SESSION['signup'] = "Passwords do not match";
        } else {
          // hash password
          $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

          //CHECK IF USERNAME OR EMAIL ALREADY EXIST IN DATABASE
          $user_check_query = "SELECT * FROM users WHERE username='$username' OR email= '$email'";
          $user_check_result = mysqli_query($connection, $user_check_query);
          if(mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['signup'] = "Username or Email already exist";
          } else {
            //WORK ON AVATAR
            //RENAME AVATAR
            $time = time();  //MAKE EACH IMAGE NAME UNIQUE USING CURRENT TIMESTAMP
            $avatar_name = $time . $avatar['name'];
            $avatar_tmp_name = $avatar['tmp_name'];
            $avatar_destination_path = 'images/' . $avatar_name;

            //MAKE SURE FILE ID AN IMAGE
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extention = explode('.', $avatar_name);
            $extention = end($extention);
            if(in_array($extention, $allowed_files)) {
              //MAKE SURE IMAGE IS NOT TOO LARGE (1mb+)
              if($avatar['size'] < 1000000 ) {
                //UPLOAD AVATAR
                move_uploaded_file($avatar_tmp_name, $avatar_destination_path);

              } else {
                 $_SESSION['signup'] = "File size too big. Should be less than 1mb";
              }
            } else {
               $_SESSION['signup'] = "File should be png, jpg, or jpeg";
            }
          }
        }
    }

// REDIRECT BACK TO SIGN PAG EIF THERE WAS ANY PROBLEAM
 if (isset($_SESSION['signup'])) {
        //pass form data back to sigup page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
 } else {
     // INSERT NEW USER INTO USERS TABLE
     $insert_user_query = "INSERT INTO users SET firstname='$firstname', lastname='$lastname', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=0";
     $insert_user_result = mysqli_query($connection, $insert_user_query);

     if(!mysqli_errno($connection)) {
      //REDIRECT TO LOGIN PAGE WITH SUCCESS MESSAGE
      $_SESSION['signup-success'] = "Registration successful. Please log in";
      header('location: ' . ROOT_URL . 'signin.php');
      die();
     }
 }


  }else {
    //IF BUTTON WASN'T CLICKED, BOUNCE BACK TO SIGNUP PAGE
    header('location: ' . ROOT_URL . 'signup.php');
    die();
  }
?>