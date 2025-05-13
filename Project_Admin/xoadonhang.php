<?php
include('server/connection.php');

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Xóa các mục trong bảng order_items trước
    $sql_items = "DELETE FROM order_items WHERE order_id = ?";
    $stmt_items = $conn->prepare($sql_items);
    $stmt_items->bind_param("i", $order_id);
    $stmt_items->execute();

    // Xóa đơn hàng trong bảng orders
    $sql_order = "DELETE FROM orders WHERE order_id = ?";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("i", $order_id);
    $stmt_order->execute();

    if ($stmt_order->affected_rows > 0) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
