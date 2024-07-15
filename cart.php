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
            <a href="cart.php" class="text-white" style="text-decoration: none;">
                Cart >
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
                    <div id="mycart">
                        <?php
                        $items = getCartItems();

                        if (mysqli_num_rows($items) > 0) {
                        ?>
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <h6>Product</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Price</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Quantity</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Remove</h6>
                                </div>
                            </div>
                            <div id="">
                                <?php
                                $totalPrice = 0; // Initialize total price variable
                                foreach ($items as $citem) {
                                ?>
                                    <div class="card product_data shadow-sm mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="products/<?= sanitize($citem['image']); ?>" alt="Image" width="60px">
                                            </div>
                                            <div class="col-md-3">
                                                <h5><?= sanitize($citem['name']); ?></h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>₱<?= sanitize($citem['selling_price']); ?></h5>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="hidden" class="prodId" value="<?= sanitize($citem['prod_id']); ?>">
                                                <div class="input-group mb-1" style="width:100px;">
                                                    <button onclick="refreshPage()" class="input-group-text decrement-btn updateQty">-</button>
                                                    <input type="text" class="form-control text-center input-qty bg-white" value="<?= sanitize($citem['prod_qty']); ?>" disabled>
                                                    <button onclick="refreshPage()" class="input-group-text increment-btn updateQty">+</button>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-danger btn-sm deleteItem" value="<?= sanitize($citem['cid']); ?>">
                                                    <i class="fa fa-trash me-2"></i>Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    $totalPrice += ($citem['selling_price'] * $citem['prod_qty']); // Accumulate total price
                                }
                                ?>
                            </div>

                            <div class="float-end">
                                <a href="checkout.php" class="btn btn-outline-primary">Proceed To Checkout</a>
                            </div>

                            <div class="float-end">
                                <strong>
                                    <h2>Total Price: ₱<?= sanitize(number_format($totalPrice, 2)); ?>
                                </strong>
                            </div>


                        <?php
                        } else {
                        ?>
                            <div class="card card-body shadow text-center">
                                <h4 class="py-3">Your Cart is Empty!!</h4>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <script>
                        function refreshPage() {
                            location.reload(true);
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("userpanel/includes/footer.php"); ?>