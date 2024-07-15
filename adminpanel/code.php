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

include('../config/dbcon.php');
include('../functions/myfunctions.php');


if (isset($_POST['add_category_btn'])) {
    $name =  mysqli_real_escape_string($con, $_POST['name']);
    $tag_name =  mysqli_real_escape_string($con, $_POST['tag_name']);
    $description =  mysqli_real_escape_string($con, $_POST['description']);
    $status =  mysqli_real_escape_string($con, isset($_POST['status']) ? '1' : '0');
    $topsales =  mysqli_real_escape_string($con, isset($_POST['topsales']) ? '1' : '0');

    $image = $_FILES['image']['name'];

    $path = "../products";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $category_query = $con->prepare("INSERT INTO categories (name, tag_name, description, status, topsales, image) 
    VALUES (?, ?, ?, ?, ?, ?)");
    $category_query->bind_param("ssssss", $name, $tag_name, $description, $status, $topsales, $filename);
    $category_query_run = $category_query->execute();

    if ($category_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        $_SESSION['error'] = false;
    } else {
        $_SESSION['error'] = true;
    }

    header("Location: category.php");
} else if (isset($_POST['adding_product_btn'])) {

    $category_id =  mysqli_real_escape_string($con, $_POST['category_id']);
    $name =  mysqli_real_escape_string($con, $_POST['name']);
    $tagname =  mysqli_real_escape_string($con, $_POST['prodtag_name']);
    $description =  mysqli_real_escape_string($con, $_POST['description']);
    $original_price =  mysqli_real_escape_string($con, $_POST['original_price']);
    $selling_price =  mysqli_real_escape_string($con, $_POST['selling_price']);
    $qty =  mysqli_real_escape_string($con, $_POST['qty']);
    $status =  mysqli_real_escape_string($con, isset($_POST['status']) ? '1' : '0');
    $topsales =  mysqli_real_escape_string($con, isset($_POST['topsales']) ? '1' : '0');

    $image = $_FILES['image']['name'];

    $path = "../products";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $product_query = $con->prepare("INSERT INTO tblproducts (category_id, name, tag_name, description, original_price, selling_price, qty, status, topsales, image) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $product_query->bind_param("isssddiiss", $category_id, $name, $tagname, $description, $original_price, $selling_price, $qty, $status, $topsales, $filename);

    $product_query_run = $product_query->execute();

    if ($product_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        header("Location: products.php"/*Product Added Successfully*/);
    } else {
        header("Location: products.php" /*Something Went Wrong*/);
    }
} else if (isset($_POST['update_category_btn'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $tag_name = mysqli_real_escape_string($con, $_POST['tag_name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $status = mysqli_real_escape_string($con, isset($_POST['status']) ? '1' : '0');
    $topsales = mysqli_real_escape_string($con, isset($_POST['topsales']) ? '1' : '0');

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $update_filename = $new_image;
    } else {
        $update_filename = $old_image;
    }
    $path = "../products";

    $update_query = $con->prepare("UPDATE categories SET name=?, tag_name=?, description=?, status=?, topsales=?, image=? WHERE id=?");
    $update_query->bind_param("ssssssi", $name, $tag_name, $description, $status, $topsales, $update_filename, $category_id);

    $update_query_run =  $update_query->execute();

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $new_image);
            if (file_exists("../products/" . $old_image)) {
                unlink("../products/" . $old_image);
            }
        }
        header("Location: category.php?id=$category_id");
    }
} else if (isset($_POST['id'])) {

    $category_id = mysqli_real_escape_string($con, $_POST['id']);

    $category_query = $con->prepare("SELECT * FROM categories WHERE id = ?");
    $category_query->bind_param("i", $category_id);
    $category_query->execute();
    $category_query_run = $category_query->get_result();
    $category_data = mysqli_fetch_array($category_query_run);

    $image = $category_data['image'];

    $delete_query = $con->prepare("DELETE FROM categories WHERE id = ?");
    $delete_query->bind_param("i", $category_id);
    $delete_query_run = $delete_query->execute();

    if ($delete_query_run) {
        if (file_exists("../products/" . $image)) {
            unlink("../products/" . $image);
        }
    }

    header("Location: category.php");
} else if (isset($_POST['update_product_btn'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $tagname = mysqli_real_escape_string($con, $_POST['tag_name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $original_price = mysqli_real_escape_string($con, $_POST['original_price']);
    $selling_price = mysqli_real_escape_string($con, $_POST['selling_price']);
    $qty = mysqli_real_escape_string($con, $_POST['qty']);
    $status = mysqli_real_escape_string($con, isset($_POST['status']) ? '1' : '0');
    $topsales = mysqli_real_escape_string($con, isset($_POST['topsales']) ? '1' : '0');

    $image = $_FILES['image']['name'];

    $path = "../products";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {

        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $update_product_query = $con->prepare("UPDATE tblproducts SET category_id=?, tag_name=?, name=?, description=?, original_price=?, selling_price=?, status=?, topsales=?, image=? WHERE id=?");
    $update_product_query->bind_param("isssddissi", $category_id, $tagname, $name, $description, $original_price, $selling_price, $status, $topsales, $update_filename, $product_id);
    $update_product_query_run = $update_product_query->execute();

    if ($update_product_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../products/" . $old_image)) {
                unlink("../products/" . $old_image);
            }
        }

        header("Location: products.php?id=$product_id");
    } else {
        header("editproduct.php?id=$category_id");
    }
} else if (isset($_POST['delete_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['delete_product']);

    $product_query = $con->prepare("SELECT * FROM tblproducts WHERE id = ?");
    $product_query->bind_param("i", $product_id);
    $product_query->execute();
    $product_query_run = $product_query->get_result();

    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = $con->prepare("DELETE FROM tblproducts WHERE id = ?");
    $delete_query->bind_param("i", $product_id);
    $delete_query_run = $delete_query->execute();

    if ($delete_query_run) {
        if (file_exists("../products/" . $image)) {
            unlink("../products/" . $image);
            echo "Product deleted successfully.";
        } else {
            echo "Failed to delete product.";
        }
    }
} else if (isset($_POST['update_order_btn'])) {
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $updateOrder_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$track_no' ";
    $updateOrder_query_run = mysqli_query($con, $updateOrder_query);

    header("Location: view-order.php?trackingnumber=$track_no");
} else {
    header("Location: category.php?id=$category_id");
}
