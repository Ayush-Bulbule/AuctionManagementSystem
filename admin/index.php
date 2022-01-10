<?php
include 'header.php';
include_once '../config/db.php';



// if (empty($_SESSION['admin_id'])) {
//     $error[] = "You must login to View Details!";
//     $_SESSION['errors'] = $error;
//     header('location:login.php');
// }

?>

<body class="bg-light">
    <?php
    include 'navbar.php';
    ?>
    <!--Container Main start-->
    <div class="main container-fluid py-4">
        <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
        <?php include $page . '.php' ?>
    </div>
    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
</body>


<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // show navbar
                    nav.classList.toggle('show')
                    // change icon
                    toggle.classList.toggle('bx-left-arrow-alt')
                    // add padding to body
                    bodypd.classList.toggle('body-pd')
                    // add padding to header
                    headerpd.classList.toggle('body-pd')
                })
            }
        }

        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link');
        const active = document.querySelector('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>');

        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            active.classList.add('active')
        }

        // Your code to run since DOM is loaded and ready
    });
</script>