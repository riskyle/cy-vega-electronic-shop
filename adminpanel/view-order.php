<?php
session_start();

if (isset($_SESSION['auth']) && $_SESSION['role_as'] != 1) {

    header('Location: ../index.php');
    exit();
}

if (!isset($_SESSION['auth'])) {

    header('Location: ../login.php');
    exit();
}

include("includes/header.php");
include("../functions/myfunctions.php");

if (isset($_GET['trackingnumber'])) {
    $tracking_no = $_GET['trackingnumber'];

    $orderData = checkingTrackingNoValid($tracking_no);
    if (mysqli_num_rows($orderData) < 0) {
?>
        <h4>Something Went Wrong</h4>
    <?php
        die();
    }
} else {
    ?>
    <h4>Something Went Wrong</h4>
<?php
    die();
}

$order_data = mysqli_fetch_array($orderData);
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card">
                    <div class="card-header bg-dark">
                        <span class="text-white fs-3">View Order</span>
                        <a href="orders.php" class="btn btn-warning float-end"><i class="fa fa-reply"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Delivery Details</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Name</label>
                                        <div class="border p-1">
                                            <?= sanitize($order_data['name']); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Email Address</label>
                                        <div class="border p-1">
                                            <?= sanitize($order_data['email']); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Phone Number</label>
                                        <div class="border p-1">
                                            <?= sanitize($order_data['phone']); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Tracking Number</label>
                                        <div class="border p-1">
                                            <?= sanitize($order_data['tracking_no']); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Address</label>
                                        <div class="border p-1">
                                            <?= sanitize($order_data['address']); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Zip Code</label>
                                        <div class="border p-1">
                                            <?= sanitize($order_data['postalcode']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $order_query = $con->prepare("SELECT 
                                                                        o.id as oid, 
                                                                        o.tracking_no,
                                                                         o.cust_id, 
                                                                         oi.*, 
                                                                         oi.qty as orderqty,
                                                                          p.* 
                                                                    FROM orders o 
                                                                    INNER JOIN order_items oi ON oi.order_id = o.id 
                                                                    INNER JOIN tblproducts p ON p.id = oi.prod_id 
                                                                    WHERE o.tracking_no = ?");
                                        $order_query->bind_param("s", $tracking_no);

                                        $order_query->execute();

                                        $order_query_run = $order_query->get_result();

                                        if (mysqli_num_rows($order_query_run) > 0) {
                                            foreach ($order_query_run as $item) {
                                        ?>
                                                <tr>
                                                    <td class="align-middle">
                                                        <img src="../products/<?= sanitize($item['image']); ?>" width="50px" height="50px" alt="<?= sanitize($item['name']); ?>">
                                                        <?= sanitize($item['name']); ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <?= sanitize($item['price']); ?>
                                                    </td>
                                                    <td class="align-middle">
                                                        <?= sanitize($item['orderqty']); ?>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <hr>


                                <h5>Total Amount : <span class="float-end fw-bold">₱<?= sanitize($order_data['total_price']) ?>.00</span></h5>
                                <hr>
                                <label class="fw-bold">Payment Method: </label>
                                <div class="border p-1 mb-3">
                                    <?= sanitize($order_data['payment_mode']) ?>
                                </div>
                                <label class="fw-bold">Status: </label>
                                <div class="mb-3">
                                    <form action="code.php" method="POST">
                                        <input type="hidden" name="tracking_no" value="<?= sanitize($order_data['tracking_no']) ?>">
                                        <select name="order_status" class="form-select">
                                            <option value="0" <?= sanitize($order_data['status']) == 0 ? "selected" : "" ?>>To Ship</option>
                                            <option value="1" <?= sanitize($order_data['status']) == 1 ? "selected" : "" ?>>To Received</option>
                                            <option value="2" <?= sanitize($order_data['status']) == 2 ? "selected" : "" ?>>Completed</option>
                                            <option value="3" <?= sanitize($order_data['status']) == 3 ? "selected" : "" ?>>Cancelled</option>
                                        </select>
                                        <button type="submit" name="update_order_btn" class="btn btn-outline-primary mt-2">Update Order Status</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>