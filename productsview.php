<?php
include("functions/userfunctions.php");
include("userpanel/includes/header.php");
if (isset($_GET['product'])) {


    if (isset($_GET['product'])) {
        $product_tagname = $_GET['product'];
        $product_data = getNameActive("tblproducts", $product_tagname);
        $products = mysqli_fetch_array($product_data);
    }
    if ($products) {
?>
        <div class="py-3 bg-info">
            <div class="container">
                <h6 class="text-white">
                    <a class="text-white" href="index.php" style="text-decoration: none;">
                        Home >
                    </a>
                    <a class="text-white" href="categories.php " style="text-decoration: none;">
                        Collections >
                    </a>
                    <?= sanitize($products['name']); ?>
                </h6>
            </div>
        </div>

        <div class="bg-light py-4">
            <div class="container product_data mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="products/<?= sanitize($products['image']); ?>" alt="Products Image" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <span class="float-end text-danger fw-bold"><?php if ($products['topsales']) {
                                                                        echo "Top Sales";
                                                                    } ?></span>
                        <h4 class="fw-bold"><?= sanitize($products['name']); ?></h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Php :<span class="text-success fw-bold"><?= sanitize($products['selling_price']); ?></span></h5>
                            </div>
                            <div class="col-md-6">
                                <h5>Php : <s class="text-danger fw-bold"><?= sanitize($products['original_price']); ?></s></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width:110px;">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                    <button class="input-group-text increment-btn">+</button>
                                </div>

                            </div>


                            <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="false">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="orderModalLabel">Order Added to Cart</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="false">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Your order has been added to the cart.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                                    
                            <button class="btn btn-primary px-4 addtocartbtn" value="<?= sanitize($products['id']); ?>" style="margin: 5px; padding: 10px;" data-toggle="modal" data-target="#orderModal">
                                <i class="fa fa-shopping-cart me-2"></i>Add to Cart
                            </button>

                            <!-- Bootstrap JS and your script -->
                            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

                            <div>
                                <h6>Product Description</h6>
                                <hr>
                                <h5><?= sanitize($products['description']); ?></h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    <?php
    } else {
        echo "Product Not Found";
    }
} else {
    echo "Something Went Wrong";
}


include('userpanel/includes/footer.php');

    ?>