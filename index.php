<!DOCTYPE html>
<html lang="en">

<?php
include 'header.php';
?>

<body>
    <?php
    include 'navbar.php';
    ?>

    <?php
    include 'carousel.php';
    ?>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-3 p-3">
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Categories</li>
                    <li class="list-group-item">All</li>
                    <li class="list-group-item">Phones</li>
                    <li class="list-group-item">Electronics</li>
                    <li class="list-group-item">Flats</li>
                    <li class="list-group-item">Plots</li>
                    <li class="list-group-item">Books</li>
                </ul>
            </div>
            <div class="col-md-9">
                <h3>Products For Bidding</h3>

                <div class="row">

                    <?php
                    $i = 0;
                    while ($i <= 30) {
                    ?>
                        <div class="col-3 card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    <?php
                        $i++;
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>








    <?php
    include 'footer.php';
    ?>
</body>

</html>