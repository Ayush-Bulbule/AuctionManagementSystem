<?php
require_once 'db_connect.php';
require_once '../config/config.php';
require_once '../config/db.php';
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connect.php';
                        $type = array("", "Admin", "Staff", "Alumnus/Alumna");
                        $users = $conn->query("SELECT * FROM users order by name asc");
                        $i = 1;
                        while ($row = $users->fetch_assoc()) :
                        ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $i++ ?>
                                </td>
                                <td>
                                    <?php echo ucwords($row['name']) ?>
                                </td>

                                <td>
                                    <?php echo $row['username'] ?>
                                </td>
                                <td>
                                    <?php echo $type[$row['type']] ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <form action=<?php echo ADMINURL . 'actions.php?action=delete_user' ?> class="m-0" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                            <button class="btn btn-sm btn-danger delete_category" type="submit">Delete</button>
                                        </form>
                                        <!-- Edit -->
                                        <button class="btn btn-sm btn-warning edit_category" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>">Edit</button>

                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>