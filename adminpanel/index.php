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

$tab = "sales";
$sales_total = 0;
$number_of_orders = 0;
$sales_monthly_data = array();
$sales_daily_data = array();

// total sales
if ($tab == "sales") {
    $query = $con->prepare("SELECT SUM(total_price) as SALES FROM orders");
    $query->execute();
    $result = $query->get_result();

    if ($result) {
        $row = $result->fetch_assoc();
        $sales_total = $row["SALES"];
    }
}

?>

<br>
<br>

<div class="sales-box">
    <?php
    if ($tab == "sales") {
        echo "<h2>Total Sales Php: " . sanitize(number_format($sales_total, 2)) . "</h2>";
    } else {
        echo "<h2>No sales data available.</h2>";
    }
    ?>
</div>



<style>
    .sales-box {
        width: 250px;
        height: 200px;
        border: 3px solid green;
        padding: 15px;
        margin: 10px 0;
        border-radius: 8px;
        background-color: black;
        color: #fff;
        transition: background-color 0.3s;
        display: inline-block;
        /* Use inline-block to make the divs appear horizontally */
        vertical-align: top;
        /* Align the content at the top */
    }

    .sales-box:hover {
        background-color: #31304D;
    }

    .sales-box h2 {
        color: white;
        font-family: Helvetica;
        margin: 0;
    }
</style>

<div class="sales-box">
    <?php
    if ($tab == "sales") {
        $query = $con->prepare("SELECT COUNT(*) as order_count, SUM(total_price) as total_sales FROM orders;");
        $query->execute();
        $result = $query->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            $number_of_orders = $row["order_count"];
            $sales_total = $row["total_sales"];
            echo "<h2>Number of Orders: " . sanitize($number_of_orders) . "</h2>";
        } else {
            echo "Error executing query: " . $con->error;
        }
    } else {
        echo "<h2>No sales data available.</h2>";
    }
    ?>
</div>

<?php

// monthly sales data
if ($tab == "sales") {
    $query = $con->prepare("SELECT DATE_FORMAT(created_at, '%Y-%m') as order_month, SUM(total_price) as sales_per_month FROM orders GROUP BY order_month;");
    $query->execute();
    $result = $query->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $sales_monthly_data[$row['order_month']] = $row['sales_per_month'];
        }
    }
}

?>

<div class="sales-box">
    <?php
    if ($tab == "sales") {
        echo "<h2>This Month Php: " . sanitize(number_format($sales_total, 2)) . "</h2>";
    } else {
        echo "<h2>No sales data available.</h2>";
    }
    ?>
</div>

<?php

// daily sales data
if ($tab == "sales") {
    $query = $con->prepare("SELECT DATE_FORMAT(created_at, '%Y-%m-%d') as order_day, SUM(total_price) as sales_per_day FROM orders GROUP BY order_day;");
    $query->execute();
    $result = $query->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $sales_daily_data[$row['order_day']] = $row['sales_per_day'];
        }
    }
}

?>

<div class="sales-box">
    <?php
    if ($tab == "sales") {
        echo "<h2>Today's Sales Php: " . sanitize(number_format($sales_daily_data[date('Y-m-d')] ?? 0, 2)) . "</h2>";
    } else {
        echo "<h2>No sales data available.</h2>";
    }
    ?>
</div>

<?php
// Close the database connection
$con->close();
?>