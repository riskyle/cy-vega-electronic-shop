<?php
include("userpanel/includes/header.php");
include("functions/userfunctions.php");
include("functions/anti_xss.php");

?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Search Products</h4>
                <div class="underline mb-2"></div>
                <div class="row">
                    <?php
                    if (isset($_GET['query'])) {
                        $query = $_GET['query'];
                        $searchResults = searchProducts($query);

                        if (!empty($searchResults)) {
                            foreach ($searchResults as $result) {
                                $tagName = sanitize($result['tag_name']);
                                $image = sanitize($result['image']);
                                $name = sanitize($result['name']);

                                echo "<div class='col-md-3 mb-3'>";
                                echo "<a href='productsview.php?product={$tagName}' class='text-decoration-none'>";
                                echo "<div class='card shadow'>";
                                echo "<div class='card-body'>";
                                echo "<img src='products/{$image}' alt='Product Image' width='300px' height='200px'>";
                                echo "<h4 class='text-center fs-5 text-dark'>{$name}</h4>";
                                echo "</div>";
                                echo "</div>";
                                echo "</a>";
                                echo "</div>";
                            }
                        } else {
                            echo "No results";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>