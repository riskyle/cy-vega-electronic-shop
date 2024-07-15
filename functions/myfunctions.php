<?php
include('../config/dbcon.php');

function getAll($table)
{
    global $con;
    $query = "SELECT * FROM $table";
    $stmt = $con->prepare($query);
    $stmt->execute();
    return $stmt->get_result();
}

function getByID($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id=? ";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function getAllOrders()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status=?";
    $stmt = $con->prepare($query);
    $status = 0;
    $stmt->bind_param("i", $status);
    $stmt->execute();
    return $stmt->get_result();
}

function checkingTrackingNoValid($trackingNo)
{
    global $con;
    $query = "SELECT * FROM orders WHERE tracking_no=? ";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $trackingNo);
    $stmt->execute();
    return $stmt->get_result();
}

function getOrderHistory()
{
    global $con;
    $query = "SELECT * FROM orders WHERE status!=?";
    $stmt = $con->prepare($query);
    $status = 0;
    $stmt->bind_param("i", $status);
    $stmt->execute();
    return $stmt->get_result();
}
