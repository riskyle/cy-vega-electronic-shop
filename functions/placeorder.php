<?php
session_start();
include('../config/dbcon.php');


if (isset($_SESSION['auth'])) {

    if (isset($_POST['placeorderbtn'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $pcode = mysqli_real_escape_string($con, $_POST['pcode']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

        if ($name == "" || $email == "" || $phone == "" ||  $pcode == "" || $address == "") {
            $_SESSION['message'] = "All Fields Are Mandatory";
            header('Location: ../checkout.php');
            exit;
        }

        $custId = $_SESSION['auth_user']['cust_id'];

        $query = "SELECT c.id AS cid, c.prod_id, c.prod_qty, p.id AS pid, p.name, p.image, p.selling_price
                  FROM carts c
                  JOIN tblproducts p ON c.prod_id = p.id
                  WHERE c.cust_id = ?
                  ORDER BY c.id DESC";

        $stmt = $con->prepare($query);
        $stmt->bind_param('i', $custId);
        $stmt->execute();
        $query_run = $stmt->get_result();

        $totalPrice = 0;
        foreach ($query_run as $citem) {
            $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
        }
        $tracking_no = "SFOS" . rand(1111, 9999) . substr($phone, 2);
        $insert_query = "INSERT INTO orders (
                                            tracking_no, 
                                            cust_id, 
                                            name, 
                                            email, 
                                            phone, 
                                            address, 
                                            postalcode, 
                                            total_price, 
                                            payment_mode, 
                                            payment_id
                                            ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($insert_query);
        $stmt->bind_param(
            'sisssssdsd',
            $tracking_no,
            $custId,
            $name,
            $email,
            $phone,
            $address,
            $pcode,
            $totalPrice,
            $payment_mode,
            $payment_id
        );
        $insert_query_run = $stmt->execute();

        if ($insert_query_run) {
            $order_id = mysqli_insert_id($con);
            foreach ($query_run as $citem) {
                $prod_id = $citem['prod_id'];
                $prod_qty = $citem['prod_qty'];
                $price = $citem['selling_price'];

                $insert_items_query = $con->prepare("INSERT INTO order_items (order_id, prod_id, qty, price) VALUES (?, ?, ?, ?)");
                $insert_items_query->bind_param("siid", $order_id, $prod_id, $prod_qty, $price);
                $insert_items_query_run = $insert_items_query->execute();

                $product_query = $con->prepare("SELECT * FROM tblproducts WHERE id = ? LIMIT 1");
                $product_query->bind_param("i", $prod_id);
                $product_query->execute();
                $product_query_run = $product_query->get_result();

                $productData = mysqli_fetch_array($product_query_run);
                $current_qty = $productData['qty'];

                $new_qty = $current_qty - $prod_qty;

                $updateQty_query = $con->prepare("UPDATE tblproducts SET qty = ? WHERE id = ?");
                $updateQty_query->bind_param("ii", $new_qty, $prod_id);
                $updateQty_query_run = $updateQty_query->execute();
            }

            $deleteCartQuery = $con->prepare("DELETE FROM carts WHERE cust_id = ?");
            $deleteCartQuery->bind_param("i", $custId);
            $deleteCartQuery_run = $deleteCartQuery->execute();

            $_SESSION['message'] = "Order Place Successfully";
            header('Location: ../myorders.php');
            die();
        }
    }
} else {
    header('Location: ../index.php');
}

include("../userpanel/includes/footer.php");
