<?php
include("functions/userfunctions.php");
include("userpanel/includes/header.php");
include("authenticate.php");


?>

<div class="py-3 bg-info">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white" style="text-decoration: none;">
                Home >
            </a>
            <a href="checkout.php" class="text-white" style="text-decoration: none;">
                Checkout >
            </a>
            <a href="myorders.php" class="text-white" style="text-decoration: none;">
                My Orders
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Tracking Number</th>
                                <th>Price</th>
                                <th>Order Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders = getOrders();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                            ?>
                                    <tr>
                                        <td><?= sanitize($item['id']); ?></td>
                                        <td><?= sanitize($item['tracking_no']); ?></td>
                                        <td>₱<?= sanitize($item['total_price']); ?></td>
                                        <td><?= sanitize($item['created_at']); ?></td>
                                        <td>
                                            <a href="view-order.php?trackingnumber=<?= sanitize($item['tracking_no']); ?>" class="btn btn-primary">View Details</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No Orders Yet</td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
</div>


<?php include("userpanel/includes/footer.php"); ?>