<?php
require_once 'config/db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $conn = db_connect();

    //validate
    if (empty($name)) {
        $errors[] = "Frist name can't be blank";
    }
    if (empty($phone)) {
        $errors[] = "Last name can't be empty";
    }
    if (empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email can't be empty";
    }
    if (empty($password)) {
        $errors[] = "Password can't be empty";
    }

    if (!empty($password) && !empty($cpassword) && $password != $cpassword) {
        $errors[] = "Confirm password dosn't match.";
    }


    //Check if Email Allready Exists
    if (!empty($email)) {
        $sanitizEmail = mysqli_real_escape_string($conn, $email);

        $emailSql = "SELECT `id` FROM `users` WHERE `email` = '{$sanitizEmail}'";


        $sqlResult = mysqli_query($conn, $emailSql);
        // print_r($sqlResult);
        $emailRow = mysqli_num_rows($sqlResult);

        if ($emailRow > 0) {
            $errors[] = "Email already exists";
        }
        db_close($conn);
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('location: index.php');
        print_r($_POST);
        exit();
    }

    //Saving data if all is good
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users` (`name`,`email`,`password`,`contact`,`address`) VALUES ('{$name}','{$email}','{$passwordHash}','{$phone}','{$address}')";

    $conn = db_connect();
    if (mysqli_query($conn, $sql)) {
        db_close($conn);
        $message = "Your registration is successfull!";
        $_SESSION['success'] = $message;
        header('location: index.php');
    } else {
        echo "ERROR";
        print_r($conn);
    }
}


?>
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="row">
                <div class="col-lg-7 px-0 col-md-7 col-12 d-flex align-items-center flex-column">
                    <h3 class="text-center">Welcome to eAuct!</h3>
                    <p class="text-mini">One Place to Auct your products at Best Price!📢</p>
                    <img src="assets/images/signup.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-5 ps-0 pe-4 col-md-5 col-12 py-lg-4">
                    <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>


                    <form action="signup.php" class="mt-5" method="post">
                        <div class="login-form-input">
                            <div class="px-2 py-2 d-flex flex-row align-items-center" style="border-bottom:2px solid #d1d1d1;">
                                <div class="form-icon pe-3">
                                    <i class="fas fa-user" style="font-size: 1.4rem; color:#566c77;"></i>
                                </div>
                                <div class="form-input d-flex justify-content-center flex-column">
                                    <label for="inputName" class="form-label">Your Name</label>
                                    <input name="fname" type="text" class="login-input " id="inputName" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="px-2 py-2 d-flex flex-row align-items-center" id="emailBox" style="border-bottom:2px solid #d1d1d1;">
                                <div class="form-icon pe-3">
                                    <i class="far fa-envelope " style="font-size: 1.6rem;  color:#566c77;"></i>
                                </div>
                                <div class="form-input d-flex justify-content-center flex-column">
                                    <label for="inputEmail" class="form-label">Your Email</label>
                                    <input name="email" type="email" class="login-input " id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="px-2 py-2 d-flex flex-row align-items-center" style="border-bottom:2px solid #d1d1d1;">
                                <div class="form-icon pe-3">
                                    <i class="fas fa-phone" style="font-size: 1.6rem; color:#566c77;"></i>
                                </div>
                                <div class="form-input d-flex justify-content-center flex-column">
                                    <label for="inputPhone" class="form-label">Your Phone</label>
                                    <input name="phone" type="phone" class="login-input " id="inputPhone" placeholder="Enter Phone">
                                </div>
                            </div>
                            <div class="px-2 py-2 d-flex flex-row align-items-center" style="border-bottom:2px solid #d1d1d1;">
                                <div class="form-icon pe-3">
                                    <i class="fas fa-envelope" style="font-size: 1.4rem; color:#566c77;"></i>
                                </div>
                                <div class="form-input d-flex justify-content-center flex-column">
                                    <label for="inputName" class="form-label">Address</label>
                                    <input name="fname" type="text" class="login-input " id="inputName" placeholder="">
                                </div>
                            </div>
                            <div class="px-2 py-2 d-flex flex-row align-items-center" style="border-bottom:2px solid #d1d1d1;">
                                <div class="form-icon pe-3">
                                    <i class="fas fa-unlock-alt" style="font-size: 1.6rem; color:#566c77;"></i>
                                </div>
                                <div class="form-input d-flex justify-content-center flex-column">
                                    <label for="inputPassword" class="form-label">Password</label>
                                    <input name="password" type="password" class="login-input " id="inputPassword" aria-describedby="emailHelp" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="px-2 py-2 d-flex flex-row align-items-center">
                                <div class="form-icon pe-3">
                                    <i class="fas fa-unlock-alt" style="font-size: 1.6rem; color:#566c77;"></i>
                                </div>
                                <div class="form-input d-flex justify-content-center flex-column">
                                    <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                                    <input name="cpassword" type="password" class="login-input " id="inputConfirmPassword" aria-describedby="emailHelp" placeholder="Enter Password">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-4 align-items-center">
                            <button name="submit" type="submit" class="btn-register">Register</button>
                            <a href="#" class="btn-forgot ms-5 btn-login-create" data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">Already Have Account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>