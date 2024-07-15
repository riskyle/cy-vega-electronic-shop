<?php
include("functions/userfunctions.php");
include("userpanel/includes/header.php");
include("userpanel/includes/slider.php");
?>

<style>

</style>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>All Products</h4>
                <div class="underline mb-2"></div>
                <div class="row">
                    <?php
                    $allProducts = getAll("tblproducts");
                    if (mysqli_num_rows($allProducts) > 0) {
                        foreach ($allProducts as $item) {
                    ?>
                            <div class="col-md-3 mb-3">
                                <a href="productsview.php?product=<?= sanitize($item['tag_name']); ?>" class="text-decoration-none">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <img src="products/<?php echo sanitize($item['image']); ?>" alt="Product Image" width="300px" height="200px">
                                            <h4 class="text-center fs-5 text-dark"><?php echo sanitize($item['name']); ?></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                        echo "No products available.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("userpanel/includes/footer.php"); ?>
<script>
    // Your existing JavaScript code
</script>