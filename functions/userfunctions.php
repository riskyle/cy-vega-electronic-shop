<?php
session_start();
include('config/dbcon.php');



function searchProducts($query, $minLength = 3)
{
    global $con;

    $searchResults = [];

    if (strlen($query) >= $minLength) {
        $query = htmlspecialchars($query);
        $query = mysqli_real_escape_string($con, $query);

        $sql = "SELECT * FROM tblproducts
                WHERE (`name` LIKE '%$query%') OR (`description` LIKE '%$query%')";

        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = $row;
        }
    }

    return $searchResults;
}


function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    $stmt = $con->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
}

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status=?";
    $stmt = $con->prepare($query);
    $status = 0;
    $stmt->bind_param("i", $status);
    $stmt->execute();
    return $stmt->get_result();
}

function getAllTopSales()
{
    global $con;
    $query = "SELECT * FROM tblproducts WHERE topsales=? ";
    $stmt = $con->prepare($query);
    $topsales = 1;
    $stmt->bind_param("i", $topsales);
    $stmt->execute();
    return $stmt->get_result();
}

function getNameActive($table, $tag_name)
{
    global $con;
    $query = "SELECT * FROM $table WHERE tag_name = ? AND status=? LIMIT 1";
    $stmt = $con->prepare($query);
    $status = 0;
    $stmt->bind_param("si", $tag_name, $status);
    $stmt->execute();
    return $stmt->get_result();
}

function getProdByCategory($category_id)
{
    global $con;
    $query = "SELECT * FROM tblproducts WHERE category_id=? AND status=? ";
    $stmt = $con->prepare($query);
    $status = 0;
    $stmt->bind_param("ii", $category_id, $status);
    $stmt->execute();
    return $stmt->get_result();
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id=? AND status=? ";
    $stmt = $con->prepare($query);
    $status = "0";
    $stmt->bind_param("si", $id, $status);
    $stmt->execute();
    return $stmt->get_result();
}

function getCartItems()
{
    global $con;
    $custId = $_SESSION['auth_user']['cust_id'];
    $query = "SELECT 
        c.id as cid, 
        c.prod_id, 
        c.prod_qty, 
        p.id as pid, 
        p.name, 
        p.image, 
        p.selling_price 
    FROM 
        carts c
    JOIN 
        tblproducts p ON c.prod_id = p.id 
    WHERE 
        c.cust_id = ? 
    ORDER BY 
        c.id DESC";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $custId);
    $stmt->execute();
    return $stmt->get_result();
}

function getOrders()
{
    global $con;
    $custId = $_SESSION['auth_user']['cust_id'];

    $query = "SELECT * FROM orders WHERE cust_id=? ORDER BY id DESC";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $custId);
    $stmt->execute();
    return $stmt->get_result();
}

function checkingTrackingNoValid($trackingNo)
{
    global $con;
    $custId = $_SESSION['auth_user']['cust_id'];

    $query = "SELECT * FROM orders WHERE tracking_no=? AND cust_id=? ";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $trackingNo, $custId);
    $stmt->execute();
    return $stmt->get_result();
}
function isUserLoggedIn()
{
    // Implement your logic to check if the user is logged in
    // For example, you might check for session variables, cookies, or user authentication status
    // Return true if logged in, false otherwise
    return false; // Placeholder, replace with your actual logic
}
