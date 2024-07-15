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

include('includes/header.php');
include('../functions/myfunctions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        .modal-title {
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="left: 25px;">Add Products</button>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Products</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <?php include("addproducts.php") ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="text-white">Products</h4>
                    </div>
                    <div class="card-body bg-white">
                        <table class=" table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Tag Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $products = getAll("tblproducts");

                                if (mysqli_num_rows($products) > 0) {
                                    foreach ($products as $item) {
                                ?>
                                        <tr>
                                            <td><?= sanitize($item['id']); ?></td>
                                            <td><?= sanitize($item['name']); ?></td>
                                            <td><?= sanitize($item['tag_name']); ?></td>
                                            <td>
                                                <img src="../products/<?= sanitize($item['image']); ?>" width="50px" height="50px" alt="">
                                            </td>
                                            <td>
                                                <?= sanitize($item['status']) == '0' ? "Visible" : "Hidden" ?>
                                            </td>
                                            <td><?= sanitize($item['qty']); ?></td>
                                            <td>
                                                <a href="editproduct.php?id=<?= sanitize($item['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <button type="button" class="delete_product_btn btn btn-sm btn-danger" data-product-id="<?= sanitize($item['id']); ?>">Delete</button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No Records Found</td></tr>";
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('.delete_product_btn').click(function(e) {
                e.preventDefault();

                var product_id = $(this).data('product-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to recover this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'code.php',
                            type: 'POST',
                            data: {
                                delete_product: product_id
                            },
                            success: function(response) {
                                console.log(response);

                                window.location.href = 'products.php';
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });

            });
        });
    </script>

</body>

</html>