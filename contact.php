<?php
include 'header.php';
include 'navbar.php';
?>

<div class="container py-4">
    <div class="d-flex align-items-center justify-content-center">
        <h4 class="text-center about-heading">Contact Us</h4>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-4 col-12 pt-5">
            <img class="img-fluid" src="assets/images/envelope.svg" alt="mail_sent">
        </div>
        <div class="col-lg-6 col-md-8 col-10 mt-5">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control shadow-md" id="name" placeholder="Ayush Bulbule">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control shadow-md" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Your Concern</label>
                <textarea class="form-control shadow-md" id="exampleFormControlTextarea1" rows="3" placeholder="Message..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
        </div>

    </div>

</div>
<svg style="position: relative; top: -250px; z-index:-30;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#00c0a75c" fill-opacity="1" d="M0,288L60,288C120,288,240,288,360,288C480,288,600,288,720,256C840,224,960,160,1080,122.7C1200,85,1320,75,1380,69.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
    </path>
</svg>
<?php
include 'footer.php';
?>