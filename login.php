<?php
require_once 'config/db.php';

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

        $conn = db_connect();

        $sanitizeEmail = mysqli_real_escape_string($conn, $email);
        $sql = "SELECT * FROM `users` WHERE `email` ='{$sanitizeEmail}'";
        $sqlResult = mysqli_query($conn, $sql);

        if (mysqli_num_rows($sqlResult) > 0) {
            $userInfo = mysqli_fetch_assoc($sqlResult);
            print_r($userInfo);


            if (!empty($userInfo)) {
                $passwordInDb = $userInfo['password'];
                echo "DB" . $passwordInDb;


                if (password_verify($password, $passwordInDb)) {
                    $_SESSION['user'] = $userInfo;
                    $_SESSION['login_id'] = $userInfo['id'];
                    $_SESSION['success'] = "Login Successfull!!";

                    header('location: index.php');
                } else {
                    $errors[] = "Login Failed";
                    $_SESSION['errors'] = $errors + $passwordInDb;
                    $_SESSION['errors'] += $passwordInDb;
                    header('location: index.php');
                }
            }
        }
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
    }
    header('location: index.php');
}

?>




<!-- Login-Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="row">
                <div class="col-lg-7 px-0 col-md-7 col-12">
                    <img src="assets/images/login_vect.jpg" alt="" class="img-fluid">
                </div>
                <div class="col-lg-5 pe-4 col-md-5 col-12 py-lg-4">
                    <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h3 class="text-center">Welcome Back:)</h3>
                    <p class="text-mini">Sign in To Explore in a Better Way! Also Find out all the Features!!😊</p>
                    <form action="login.php" class="mt-5" method="post">
                        <div class="login-form-input">
                            <div class="px-2 py-2 d-flex flex-row align-items-center" id="emailBox" style="border-bottom:2px solid #d1d1d1;">
                                <div class="form-icon pe-3">
                                    <i class="far fa-envelope " style="font-size: 1.6rem;  color:#566c77;"></i>
                                </div>
                                <div class="form-input d-flex justify-content-center flex-column">
                                    <label for="inputEmail" class="form-label">Your Email</label>
                                    <input name="email" type="email" class="login-input " id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="px-2 py-2 d-flex flex-row align-items-center">
                                <div class="form-icon pe-3">
                                    <i class="fas fa-unlock-alt" style="font-size: 1.6rem; color:#566c77;"></i>
                                </div>
                                <div class="form-input d-flex justify-content-center flex-column">
                                    <label for="inputPassword" class="form-label">Password</label>
                                    <input name="password" type="password" class="login-input " id="inputPassword" aria-describedby="emailHelp" placeholder="Enter Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-check my-4">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div>
                        <div class="d-flex align-items-center">
                            <button name="submit" type="submit" class="btn-login">Login</button>
                            <a href="#" class="btn-forgot ms-5 btn-login-create" data-bs-target="#signupModal" data-bs-toggle="modal" data-bs-dismiss="modal">Create Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>