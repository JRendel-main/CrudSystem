<?php
require_once '../helpers/conn_helpers.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated data from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Update the product entry in the database
    $sql = "UPDATE product_table SET product_category=?, price=?, stock=?, product_name=? WHERE product_id=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../adminInventory.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sssss", $product_category, $price, $stock, $product_name, $product_id);
        mysqli_stmt_execute($stmt);
        header("Location: ../adminInventory.php?editproduct=success");
        exit();
    }
} else {
    // Redirect to the inventory page if accessed directly without submitting the form
    header("Location: ../adminInventory.php");
    exit();
}
?>