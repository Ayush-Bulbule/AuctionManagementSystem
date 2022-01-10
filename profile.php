<?php
require_once 'header.php';
require_once 'navbar.php';
$user = "Ayush";
if (!empty($_SESSION['user'])) {
    $user = $_SESSION['user'];
    // echo $user['Name'];
    // print_r($_SESSION['user']);
    // echo '<br>';
} else {
    header('location:index.php');
}

if (isset($_GET)) {
    if (isset($_GET['submit'])) {
        //session destroy
        session_destroy();
        header('location:index.php');
    }
}
?>

<div class="container">
    <div class="row my-5">
        <div class="col-lg-10  shadow p-3 mb-5 bg-body rounded mx-auto">
            <div class="row">
                <div class="col-lg-4 col-sm-12 p-4">
                    <img src="assets/images/male_user.svg" alt="UserIcon" class="img-fluid">
                </div>
                <div class="col-lg-8 col-sm-12 p-4">
                    <h5 class="fs-mplus my-3"><?php echo $user['name']; ?></h5>
                    <p class="fs-mplus fs-bold">Email</p>
                    <p class="fs-mplus  mb-3"><?php echo $user['email']; ?></p>
                    <p class="fs-mplus fs-bold">Phone</p>
                    <p class="fs-mplus  mb-3"><?php echo $user['contact']; ?></p>
                    <p class="fs-mplus fs-bold">Address</p>
                    <p class="fs-mplus  mb-3"><?php echo $user['address']; ?></p>
                    <form action="profile.php" method="GET">
                        <button name="submit" type="submit" class="btn-logout">LogOut</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'footer.php';
?>