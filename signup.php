<?php
require 'config/constants.php';

//GET BACK FORM DATA IF THERE WAS A REGISTRATION ERROR
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
//DELETE SIGNUP DATA SESSION

unset($_SESSION['signup-data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySQL Blog Application with Admin Panel</title>
    <!-- custom stylesheet-->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <!--ICONSCOUT CDN-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--GOOLE FONT (MONTSERRAT)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body>


<section class="form_section">
    <div class="container form_section-container">
        <h2>Sing Up</h2>
     <?php if(isset($_SESSION['signup'])):  ?>
        <div class="alert_message error">
            <p>
                <?= $_SESSION['signup']; 
                unset($_SESSION['signup']);?>
            </p>
            
        </div> 
<?php endif ?>
    
        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?=$lastname ?>" placeholder="Last Name">
            <input type="text" name="username" value="<?=$username ?>" placeholder="Username">
            <input type="email" name="email" value="<?=$email ?>" placeholder="Email">
            <input type="password" name="createpassword" value="<?=$createpassword ?>" placeholder="Create Password">
            <input type="password" name="confirmpassword" value="<?=$confirmpassword ?>" placeholder="Confirm Password">
            <div class="form_control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sing Up</button>
            <small>Already have an account? <a href="signin.php">Sing In</a></small>
        </form>
    </div>
</section>

</body>
</html>