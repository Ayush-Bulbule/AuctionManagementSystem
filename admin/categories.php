<?php
include '../config/config.php';
require_once '../config/db.php';
?>

<div>

    <?php
    if (!empty($_SESSION['success'])) {
    ?>
        <div class="toast show position-absolute top-0 end-0 align-items-center text-white bg-success border-0" data-bs-autohide="true" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php
                    print_r($_SESSION['success']);
                    ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-dismiss="toast" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    <?php
        unset($_SESSION['success']);
    } ?>
    <?php
    if (!empty($_SESSION['errors'])) {
    ?>
        <div class="toast show position-absolute top-0 end-0 right-0   align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php
                    foreach ($_SESSION['errors'] as $error) {
                        print '<li>' . $error . '</li>';
                    }
                    ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-dismiss="toast" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    <?php
        unset($_SESSION['errors']);
    } ?>

    <div class="row">
        <!-- FORM Panel -->
        <div class="col-md-4">
            <form action=<?php echo ADMINURL . 'actions.php?action=save_category' ?> method="post" id="manage-category">
                <div class="card">
                    <div class="card-header">
                        Category Form
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="hidden-id" name="id">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" id="input-category" name="name">
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-primary col-sm-3 offset-md-3" type="submit"> Save</button>
                                <button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-category').get(0).reset()"> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- FORM Panel -->

        <!-- Table Panel -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>Category List</b>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $conn = db_connect();
                            $i = 1;
                            $category = $conn->query("SELECT * FROM categories order by id asc");
                            while ($row = $category->fetch_assoc()) :
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                        <p><b><?php echo $row['name'] ?></b></p>
                                    </td>
                                    <td class="text-center d-flex justify-content-around align-items-center">
                                        <!-- Delete -->
                                        <form action=<?php echo ADMINURL . 'actions.php?action=delete_category' ?> class="m-0" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                            <button class="btn btn-sm btn-danger delete_category" type="submit">Delete</button>
                                        </form>
                                        <!-- Edit -->
                                        <button class="btn btn-sm btn-warning edit_category" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>">Edit</button>

                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Table Panel -->
    </div>

</div>
<style>
    td {
        vertical-align: middle !important;
    }
</style>



<script>
    let inputCategory = document.querySelector('#input-category');
    let hiddenId = document.querySelector('#hidden-id');
    let btnClose = document.querySelectorAll('.btn-close');
    let toast = document.querySelectorAll('.toast');
    let btnEdit = document.querySelectorAll('.edit_category');

    console.log(btnEdit);


    // console.log(toast);
    btnClose.forEach(function(btn) {
        btn.addEventListener('click', function() {
            console.log("hii");
            toast.forEach(function(t) {
                t.classList.remove('show');
            });
            toast.addClass('hide');
        });
    });

    //edit
    btnEdit.forEach(function(btn) {
        btn.addEventListener('click', async (e) => {
            console.log(e.target.dataset.id);
            console.log(e.target.dataset.name);
            let id = e.target.dataset.id;
            hiddenId.setAttribute('value', e.target.dataset.id);
            inputCategory.setAttribute('value', e.target.dataset.name);
        });
    });
</script>