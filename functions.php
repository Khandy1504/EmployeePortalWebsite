<?php

function emptyInputSignup($userEmail, $userPass, $first, $last, $userAdd, $userPhone,
$userSalary, $userSSN){
    $result;
    if (empty($userEmail) || empty($userPass) || empty($first) || empty($last) ||
    empty($userAdd) || empty($userPhone) || empty($userSalary) || empty($userSSN)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($userEmail){
    $result;
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function createUser($connection, $userEmail, $userPass, $first, $last, $userAdd,
$userPhone, $userSalary, $userSSN){

    $sql = "INSERT INTO employee_info (email, user_password, 
    firstName, lastName, userAddress, phone, salary, SSN)
    VALUES ('$userEmail', '$userPass', '$first', '$last', '$userAdd',
    '$userPhone', '$userSalary', '$userSSN');";

    mysqli_query($connection, $sql);

    header("location: ../Employee Portal Website/registration.php?error=none");
    exit();

}

function emailExists($connection, $userEmail){
    $sql = "SELECT * FROM employee_info WHERE email = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../Employee Portal Website/registration.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s", $userEmail);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function emptyInputLogin($userEmail, $userPass){
    $result;
    if (empty($userEmail) || empty($userPass)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($connection, $userEmail, $userPass){
    $emailExists = emailExists($connection, $userEmail);

    if ($emailExists === false){
        header("location: ../Employee Portal Website/login.php?error=invalidlogin");
        exit();
    }

    $pwd = $emailExists['user_password'];

    if ($pwd != $userPass){
        header("location: ../Employee Portal Website/login.php?error=wrongpassword");
        exit();
    }
    else if ($pwd == $userPass){
        session_start();
        $_SESSION["userid"] = $emailExists["Id"];
        $_SESSION["useremail"] = $emailExists["email"];
        $_SESSION["userpass"] = $emailExists["user_password"];
        $_SESSION["userfname"] = $emailExists["firstName"];
        $_SESSION["userlname"] = $emailExists["lastName"];
        $_SESSION["useradd"] = $emailExists["userAddress"];
        $_SESSION["userphone"] = $emailExists["phone"];
        $_SESSION["usersalary"] = $emailExists["salary"];
        $_SESSION["userssn"] = $emailExists["SSN"];
        header("location: ../Employee Portal Website/home.php");
        exit();
    }
}
