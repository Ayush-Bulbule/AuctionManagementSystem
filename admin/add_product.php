<?php
include '../config/config.php';
require_once 'db_connect.php';
?>

<?php
if (isset($_FILES['img'])) {
    print_r($_FILES);
}


?>
<div>
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="actions.php?action=save_product" method="POST" id="manage-product" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                        <h4><b><?php echo !isset($id) ? "New Product" : "Manage Product" ?></b></h4>
                        <hr>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="" class="control-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="" class="control-label">Category</label>
                                <select class="form-select" name="category_id">
                                    <?php
                                    $qry = $conn->query("SELECT * FROM categories");
                                    echo $qry->num_rows;
                                    while ($row = $qry->fetch_assoc()) :
                                    ?>
                                        <option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                        </div>
                        <div class="form-group ">
                            <div class="col-md-10">
                                <label for="" class="control-label">Description</label>
                                <textarea name="description" id="description" class="form-control" cols="30" rows="5" required><?php echo isset($description) ? html_entity_decode($description) : '' ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 ">
                                <label for="" class="form-label">Regular Price</label>
                                <input type="number" class="form-control text-right" name="regular_price" value="<?php echo isset($regular_price) ? $regular_price : 0 ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Starting Bidding Amount</label>
                                <input type="number" class="form-control text-right" name="start_bid" value="<?php echo isset($start_bid) ? $start_bid : 0 ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="" class="form-label">Bidding End Date/Time</label>
                                <input type="datetime-local" class="form-control" id="bidenddate" name="bid_end_datetime" value="<?php echo isset($bid_end_datetime) && strtotime($bid_end_datetime) > 0 ? date("Y-m-d H:i", strtotime($bid_end_datetime)) : '' ?>">
                            </div>
                        </div>
                        <div class=" row form-group">
                            <div class="col-md-5">
                                <label for="" class="form-label">Product Image</label>
                                <input type="file" class="form-control" name="img">
                            </div>

                            <!-- <div class="col-md-5">
                                <img src="<?php echo isset($img_fname) ? 'assets/uploads/' . $img_fname : '' ?>" alt="" id="img_path-field">
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <button class="btn btn-sm btn-block btn-primary col-sm-2"> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    td {
        vertical-align: middle !important;
    }
</style>



<script>

</script>