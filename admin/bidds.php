<?php

require_once 'db_connect.php';
?>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>List of Bids</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="">Name</th>
                                    <th class="">Product</th>
                                    <th class="">Amount</th>
                                    <th class="">Status</th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $cat = array();
                                $cat[] = '';
                                $qry = $conn->query("SELECT * FROM categories ");
                                while ($row = $qry->fetch_assoc()) {
                                    $cat[$row['id']] = $row['name'];
                                }
                                $books = $conn->query("SELECT b.*, u.name as uname,p.name,p.bid_end_datetime bdt FROM bids b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id ");

                                while ($row = $books->fetch_assoc()) :
                                    $get = $conn->query("SELECT * FROM bids where product_id = {$row['product_id']} order by bid_amount desc limit 1 ");
                                    $uid = $get->num_rows > 0 ? $get->fetch_array()['user_id'] : 0;
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class="">
                                            <p> <b><?php echo ucwords($row['name']) ?></b></p>
                                        </td>
                                        <td class="">
                                            <p> <b><?php echo ucwords($row['uname']) ?></b></p>
                                        </td>
                                        <td class="text-right">
                                            <p> <b><?php echo number_format($row['bid_amount'], 2) ?></b></p>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($row['status'] == 1) : ?>
                                                <?php if (strtotime(date('Y-m-d H:i')) < strtotime($row['bdt'])) : ?>
                                                    <span class="badge bg-secondary">Bidding Stage</span>
                                                <?php else : ?>
                                                    <?php if ($uid == $row['user_id']) : ?>
                                                        <span class="badge bg-success">Wins in Bidding</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">Loose in Bidding</span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php elseif ($row['status'] == 2) : ?>
                                                <span class="badge bg-primary">Confirmed</span>
                                            <?php else : ?>
                                                <span class="badge bg-danger">Canceled</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm view_user" type="button" data-id='<?php echo $row['user_id'] ?>'>View Buyer Details</button>
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

</div>