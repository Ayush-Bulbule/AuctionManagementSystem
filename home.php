<?php
$cid = isset($_GET['category_id']) ? $_GET['category_id'] : 0;

?>
<div class="contain-fluid p-4">
    <h3>Products in Auction</h3>
    <div class="row gy-3">
        <?php
        $where = "";
        if ($cid > 0) {
            $where  = " and category_id =$cid ";
        }
        // $cat = $conn->query("SELECT * FROM products");
        $cat = $conn->query("SELECT * FROM products where unix_timestamp(bid_end_datetime) >= " . strtotime(date("Y-m-d H:i")) . " $where order by name asc");
        if ($cat->num_rows <= 0) {
            echo "<center><h4><i>No Available Product.</i></h4></center>";
        }
        while ($row = $cat->fetch_assoc()) :
        ?>
            <div class="col-sm-4">
                <div class="card">
                    <img src="admin/assets/uploads/<?php echo $row['img_fname'] ?>" style="height:160px;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <p class="card-text txt-card-category"><?php echo $cat_arr[$row['category_id']] ?></p>
                        <p class="card-text txt-card-desc text-truncate"><?php echo $row['description'] ?></p>
                        <div class="d-flex justify-content-between">
                            <a class="btn-primary btn-sm" href="product_details.php?product_id=<?php echo $row['id'] ?>">View</a>
                            <p class="m-0 product-bid">$<?php echo $row['start_bid'] ?></p>
                        </div>
                    </div>
                </div>

            </div>
        <?php endwhile; ?>
    </div>


</div>