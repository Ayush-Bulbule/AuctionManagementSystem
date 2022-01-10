<?php
require_once 'db_connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $errors[] = "Email colud not be empty!!";
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email address";
    }
    if (empty($password)) {
        $errors[] = "Password could not be Empty!!";
    }

    // If No Error
    if (!empty($email) && !empty($password)) {

        $sanitizeEmail = mysqli_real_escape_string($conn, $email);
        $sql = "SELECT * FROM `users` WHERE `email` ='{$sanitizeEmail}'";
        $sqlResult = mysqli_query($conn, $sql);

        if (mysqli_num_rows($sqlResult) > 0) {
            $userInfo = mysqli_fetch_assoc($sqlResult);

            if (!empty($userInfo)) {
                $passwordInDb = $userInfo['password'];
                if (password_verify($password, $passwordInDb)) {

                    if ($userInfo['type'] == '1') {

                        $_SESSION['user'] = $userInfo;
                        $_SESSION['admin_id'] = 1;
                        // $_SESSION['success'] = "Login Successfull!!";
                        header('location: index.php');
                    }
                    // $_SESSION['user'] = $userInfo;
                    // $_SESSION['success'] = "Login UnSuccessfull!!";
                    header('location: login.php');
                } else {
                    $errors[] = "Login Failed";
                    $_SESSION['errors'] = $errors + $passwordInDb;
                    $_SESSION['errors'] += $passwordInDb;
                    header('location: index.php');
                }
            }
        }
    }
    //     if (!empty($errors)) {
    //         $_SESSION['errors'] = $errors;
    //     }
    //     header('location: index.php');
}
