<?php
session_start();
require 'server/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Lấy thông tin từ form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $order_date = date('Y-m-d'); // Ngày đặt hàng
    $total_cost = $_SESSION['total']; // Tổng tiền từ session
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; // Giả định có user_id trong session

    // Lấy thông tin phương thức thanh toán từ form
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']); // Lấy thông tin từ form

    // Bắt đầu transaction
    mysqli_begin_transaction($conn);

    try {
        // Chèn thông tin đơn hàng vào bảng orders
        $insert_order = "INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date, order_payment) 
                         VALUES ('$total_cost', 'Đang chờ', '$user_id', '$phone', '$city', '$address', '$order_date', '$payment_method')";
        
        if (!mysqli_query($conn, $insert_order)) {
            throw new Exception("Lỗi khi chèn vào bảng orders: " . mysqli_error($conn));
        }

        // Lấy order_id vừa chèn
        $order_id = mysqli_insert_id($conn);

        // Chèn thông tin từng sản phẩm trong giỏ hàng vào bảng order_items
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['product_id'];
            $product_name = mysqli_real_escape_string($conn, $item['product_name']);
            $product_image = mysqli_real_escape_string($conn, $item['product_image']);
            $product_price = $item['product_price'];
            $product_quantity = $item['product_quantity'];

            $insert_item = "INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) 
                            VALUES ('$order_id', '$product_id', '$product_name', '$product_image', '$product_price', '$product_quantity', '$user_id', '$order_date')";
            if (!mysqli_query($conn, $insert_item)) {
                throw new Exception("Lỗi khi chèn vào bảng order_items: " . mysqli_error($conn));
            }
        }

        // Hoàn tất transaction
        mysqli_commit($conn);

        // Xóa giỏ hàng sau khi đặt hàng thành công
        unset($_SESSION['cart']);
        unset($_SESSION['total']);

        // Chuyển hướng đến trang thông báo
        header('Location: thongbao.php');
        exit();
    } catch (Exception $e) {
        // Rollback nếu có lỗi
        mysqli_rollback($conn);
        echo "Có lỗi xảy ra: " . $e->getMessage();
    }
} else {
    // Nếu truy cập trái phép, chuyển hướng về trang chủ
    header('Location: index.php');
    exit();
}
?>
