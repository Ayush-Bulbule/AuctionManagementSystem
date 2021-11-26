<nav id="navbar" class="navbar navbar-expand-lg  shadow-sm navbar-light bg-light">
    <div class="container">
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
                            <input class="search expandright" id="searchright" type="search" name="q" placeholder="Search">
                            <label class="searchbutton" for="searchright"><i class="fas fa fa-search"></i></label>
                        </form>
                    </div>
                    <!-- <a class="nav-link" href="#"><i class="fas fa-search"></i></a> -->
                </li>
                <li class="nav-item d-flex align-items-center me-3">
                    <a class="nav-link" href="#"><i class="far fa-heart"></i></a>
                </li>
                <li class="nav-item d-flex align-items-center me-3 ">
                    <a class="nav-link" href="#"><i class="fas fa-gavel"></i></a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="far fa-user"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Login</a></li>
                        <li><a class="dropdown-item" href="#">SignUp</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Manage Account</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="row">
                <div class="col-lg-7 px-0 col-md-7 col-12">
                    <img src="assets/images/login_vect.jpg" alt="" class="img-fluid">
                </div>
                <div class="col-lg-5 pe-4 col-md-5 col-12 py-lg-4">
                    <h3 class="text-center">Welcome Back:)</h3>
                    <p class="text-mini">Sign in To Explore in a Better Way! Also Find out all the Features!!😊</p>

                    <form action="login.php" class="mt-5" method="post">
                        <div class="p-2 d-flex login-form-input flex-row align-items-center">
                            <div class="form-icon pe-3">
                                <i class="far fa-envelope " style="font-size: 1.6rem;  color:#a5a5a5;"></i>
                            </div>
                            <div class="form-input">
                                <label for="inputEmail" class="form-label">Your Email</label>
                                <input type="email" class="login-input " id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="p-2 d-flex login-form-input flex-row align-items-center">
                            <div class="form-icon pe-3">
                                <i class="fas fa-unlock-alt" style="font-size: 1.6rem; color:#a5a5a5;"></i>
                            </div>
                            <div class="form-input">
                                <label for="inputPassword" class="form-label">Password</label>
                                <input type="password" class="login-input " id="inputPassword" aria-describedby="emailHelp" placeholder="Enter Password">
                            </div>
                        </div>

                        <div class="form-group form-check my-4">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>
</div>

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