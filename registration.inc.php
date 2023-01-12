<?php

if (isset($_POST["submit"])){

    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $userAdd = $_POST['userAdd'];
    $userPhone = $_POST['userPhone'];
    $userSalary = $_POST['userSalary'];
    $userSSN = $_POST['userSSN'];

    require_once('config.php');
    require_once ('functions.php');

    if (emptyInputSignup($userEmail, $userPass, $first, $last, $userAdd, $userPhone,
    $userSalary, $userSSN) !== false){
        header("location: ../Employee Portal Website/registration.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($userEmail) !== false){
        header("location: ../Employee Portal Website/registration.php?error=invalidemail");
        exit();
    }

    if (emailExists($connection, $userEmail) !== false){
        header("location: ../Employee Portal Website/registration.php?error=emailtaken");
        exit();
    }


    createUser($connection, $userEmail, $userPass, $first, $last, $userAdd,
     $userPhone, $userSalary, $userSSN);

     header("Location:../Employee Portal Website/home.php?register=sucess");
}
else {
    header("location: ../Employee Portal Website/registration.php");
    exit();
}
?>
