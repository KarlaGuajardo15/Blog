<?php
require 'config/constants.php';
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySQL Blog Application with Admin Panel</title>
    <!-- custom stylesheet-->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">

<!--NO SE PUEDE PONER EL ROOT_URL TIPO PHP-->

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
        <h2>Sing In</h2>
        <?php if (isset($_SESSION['signup-success'])) : ?>
            <div class="alert_message success">
            <p>
                 <?= $_SESSION['signup-success'];
            unset($_SESSION['signup-success']);
             ?>
             </p>
        </div>
         <?php elseif (isset($_SESSION['signin'])) : ?>   
         <div class="alert_message error">
            <p>
                <?= $_SESSION['signin'];
            unset($_SESSION['signin']);
             ?>
             </p>
        </div>
         <?php endif ?>  
        <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
            <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email">
            <input type="password" name="password" value="<?= $password ?>" placeholder="Password">
            <button type="submit" name="submit" class="btn">Sing In</button>
            <small>Don't have acco? <a href="signup.php">Sing Up  </a></small>
        </form>
    </div>
</section>

</body>
</html>