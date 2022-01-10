<?php
require_once './config/db.php';
require_once './config/config.php';
include './header.php';
$conn = db_connect();



if (empty($_SESSION['user'])) {
    $error[] = "You must login to View Details!";
    $_SESSION['errors'] = $error;
    header('location:index.php');
}

$pid = isset($_GET['product_id']) ? $_GET['product_id'] : 0;

if (isset($_GET)) {
    $bid_qry = $conn->query("SELECT * FROM bids where product_id = $pid order by bid_amount desc limit 1 ");
    $highest_bid = $bid_qry->num_rows > 0 ? $bid_qry->fetch_array()['bid_amount'] : '';
}


?>

<body>
    <?php
    include 'navbar.php';
    ?>

    <!-- Alerts -->

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


    <!-- End Alerts -->
    <div class="container mt-5">
        <h4>Product Details -</h4>

        <?php
        $cat = $conn->query("SELECT * FROM products where id = $pid");
        while ($row = $cat->fetch_assoc()) :
            $category_id = $row['category_id'];
            if ($pid) {
                $qry = $conn->query("SELECT * FROM products where id= " . $pid);
                foreach ($qry->fetch_array() as $k => $val) {
                    $$k = $val;
                }
                $cat_qry = $conn->query("SELECT * FROM categories where id = $category_id");
                $category = $cat_qry->num_rows > 0 ? $cat_qry->fetch_array()['name'] : '';
            }
            if ($cat->num_rows <= 0) {
                echo "<center><h4><i>No Available Product.</i></h4></center>";
            }

        ?>
            <div class="row">
                <div class="col-lg-5">
                    <img src="admin/assets/uploads/<?php echo $row['img_fname'] ?>" alt="" class="img-fluid">
                </div>
                <div class="col-lg-7">
                    <h4><?php echo $row['name']; ?></h4>
                    <p>Name: <large><b><?php echo $row['name'] ?></b></large>
                    </p>
                    <p>Category: <b><?php echo $category ?></b></p>
                    <p>Starting Amount: <b><?php echo number_format($start_bid, 2) ?></b></p>
                    <p>Until: <b><?php echo date("m d,Y h:i A", strtotime($bid_end_datetime)) ?></b></p>
                    <p>Highest Bid: <b id="hbid"><?php if ($highest_bid != '') {
                                                        echo number_format($highest_bid, 2);
                                                    } else {
                                                        echo 'No Bid Yet';
                                                    } ?></b></p>
                    <p>Description:</p>
                    <p class=""><small><i><?php echo $description ?></i></small></p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-gavel text-light"></i> Bid
                    </button>
                </div>
            </div>
        <?php endwhile; ?>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enter your Bid Amount</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="manage-bid" action="admin/actions.php?action=save_bid" method="post">
                        <div class="modal-body">
                            <div id="bid-frm">
                                <input type="hidden" name="product_id" value="<?php echo $id ?>">
                                <div class="form-group">
                                    <label for="" class="control-label">Bid Amount</label>
                                    <input type="number" class="form-control text-right" name="bid_amount" id="bid-amount">
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-small btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="save-bid" class="btn btn-small btn-primary">Save Bid</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>


<script>
    let saveBtn = document.getElementById('save-bid');

    saveBtn.addEventListener('click', () => {
        let bidAmount = document.getElementById('bid-amount').value;
        let hbid = document.getElementById('hbid').value;
        if (bidAmount > hbid) {
            alert('Bid Amount must be greater than Highest Bid');
        } else {
            let form = document.getElementById('manage-bid');
            form.submit();
        }
        // let form = document.getElementById('manage-bid');
        // let formData = new FormData(form);
        // let xhr = new XMLHttpRequest();
        // xhr.open('POST', 'bid.php', true);
        // xhr.onload = () => {
        //     if (xhr.status === 200) {
        //         let response = JSON.parse(xhr.responseText);
        //         if (response.status === 'success') {
        //             alert('Bid Successful');
        //             location.reload();
        //         } else {
        //             alert('Bid Failed');
        //         }
        //     }
        // }
        // xhr.send(formData);
    });
</script>