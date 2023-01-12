<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Portal</title>

    <p>
    <a href="home.php ">Home</a>
    <a href="contact.html">Contact Us</a>
    <?php
    if (isset($_SESSION["useremail"])){
        echo "<a href='profile.php'>Profile Page </a>";
        echo "<a href='logout.php'>Logout</a>";
    }
    else{
         echo "<a href='login.php'>Login </a>";
         echo "<a href='registration.php'>Register</a>";
    }
    ?>
    </p>
    
  </head>
  <body>

  </body>
</html>
