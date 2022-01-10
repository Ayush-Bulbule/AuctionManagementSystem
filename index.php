<!DOCTYPE html>
<html lang="en">

<?php
require_once './config/db.php';
include 'header.php';
?>
<style>
    a {
        text-decoration: none;
        color: #000;
    }
</style>

<body>
    <?php
    include 'navbar.php';
    ?>

    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    if (!$page == 'home') {
        include 'carousel.php';
    }
    ?>

    <?php
    if (!empty($_SESSION['success'])) {
    ?>
        <div class="toast align-items-center ms-auto m-3 text-white bg-success show top-0 end-0 border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $_SESSION['success']; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    <?php
        unset($_SESSION['success']);
    } ?>

    <?php
    if (!empty($_SESSION['errors'])) {
    ?>

        <div class="toast align-items-center ms-auto m-3 text-white bg-danger show top-0 end-0 border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <ul class="m-0">
                        <?php
                        foreach ($_SESSION['errors'] as $error) {
                            print '<li>' . $error . '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>

    <?php
        unset($_SESSION['errors']);
    } ?>


    <div class="container">
        <div class="row">
            <div class="col-md-3 p-3 mt-5">
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Categories</li>
                    <li class='list-group-item' data-id='all' data-href="index.php?page=home&category_id=all">All</li>
                    <?php
                    $conn = db_connect();
                    $cat = $conn->query("SELECT * FROM categories order by name asc");
                    while ($row = $cat->fetch_assoc()) :
                        $cat_arr[$row['id']] = $row['name'];
                    ?>
                        <li class='list-group-item' data-id='<?php echo $row['id'] ?>'> <a href="index.php?page=home&category_id=<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></a></li>

                    <?php endwhile; ?>

                </ul>
            </div>
            <div class="col-md-9">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';
                include $page . '.php';
                ?>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>

</html>