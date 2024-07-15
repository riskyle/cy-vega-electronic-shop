<?php
include("functions/userfunctions.php");
include("userpanel/includes/header.php");
?>

<div class="py-3 bg-info    ">
    <div class="container">
        <h6 class="text-white">Home > Electronics Categories ></h6>
    </div>
</div>
<style>
    * {
        font-family: 'Rajdhani';
    }
</style>
<div class="py-5">
    <div class="container">
        <div class="row">
            <center>
                <div class="col-md-10  mb-2">
                    <h1>Electronics Categories</h1>
                    <hr>
            </center>

            <?php
            $categories = getAllActive("categories");

            if (mysqli_num_rows($categories) > 0) {
                foreach ($categories as $item) {
            ?>
                    <div class="col-md-3 mb-3">
                        <a class="text-decoration-none" href="products.php?category=<?= sanitize($item['tag_name']); ?>">
                            <div class="card shadow">
                                <div class="card-body">
                                    <img src="products\<?php echo sanitize($item['image']); ?>" alt="Category Image" class="w-100" width="700px" height="200px">
                                    <h4 class="text-center text-dark"><?php echo sanitize($item['name']); ?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "No data available";
            }
            ?>
        </div>
    </div>
</div>



<?php include("userpanel/includes/footer.php"); ?>