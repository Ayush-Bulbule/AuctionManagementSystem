<?php
require_once 'config/db.php';
?>

<nav id="navbar" class="navbar nav-blur navbar-expand-lg  shadow-sm navbar-light">
    <div class="container bg-transparent">
        <a class="navbar-brand fw-bold" href="#">
            <img src="assets/images/logo3.png" alt="logo" width="30" height="24">
            eAuct</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">AboutUs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>


            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item d-flex align-items-center me-3">
                    <div class="search-container">
                        <form action="/search" method="get">
                            <!-- <input class="search expandright" id="searchright" type="search" name="q" placeholder="Search"> -->
                            <label class="searchbutton" for="searchright"><i class="fas fa fa-search nav-ic"></i></label>
                        </form>
                    </div>
                    <!-- <a class="nav-link" href="#"><i class="fas fa-search"></i></a> -->
                </li>
                <li class="nav-item d-flex align-items-center me-3">
                    <a class="nav-link" href="#"><i class="far fa-heart nav-ic"></i></a>
                </li>
                <li class="nav-item d-flex align-items-center me-3 ">
                    <a class="nav-link" href="#"><i class="fas fa-gavel nav-ic"></i></a>
                </li>
                <?php
                if (!empty($_SESSION['user'])) {
                ?>
                    <li class="nav-item d-flex align-items-center me-3 ">
                        <a class="nav-link" href="profile.php"> <i class="far fa-user nav-ic"></i></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-user nav-ic"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Manage Account</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>

        </div>
    </div>
</nav>

<!-- Login -->

<?php
include 'login.php';

// Registration

include 'signup.php';
?>
<!-- Registration Modal -->


<script>
    window.onscroll = function() {
        myFunction()
    };

    //Get the navbar
    var navbar = document.getElementById("navbar");

    //Get the offset position of the navbar
    var sticky = navbar.offsetTop;
    console.log(sticky);
    console.log(window.pageYOffset);
    console.log(navbar);
    //Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position

    function myFunction() {
        if (window.pageYOffset > sticky) {
            navbar.classList.add("fixed-top")
        } else {
            navbar.classList.remove("fixed-top");
        }
    }
</script>