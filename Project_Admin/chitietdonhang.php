<?php
include 'header.php';
include('server/connection.php');

// Lấy order_id từ URL
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;

// Lấy thông tin đơn hàng từ database
$order_sql = "SELECT o.*, u.user_name, u.user_email 
              FROM orders o 
              JOIN users u ON o.user_id = u.user_id 
              WHERE o.order_id = ?";
$stmt = $conn->prepare($order_sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$order_result = $stmt->get_result();
$order = $order_result->fetch_assoc();

// Lấy danh sách sản phẩm trong đơn hàng
$items_sql = "SELECT product_name, product_quantity, product_price 
              FROM order_items 
              WHERE order_id = ?";
$stmt_items = $conn->prepare($items_sql);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$items_result = $stmt_items->get_result();

// Xử lý cập nhật trạng thái đơn hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_status = $_POST['order_status'];
    $update_sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $new_status, $order_id);
    $update_stmt->execute();
    if ($stmt->execute()) {
        header('Location: chitietdonhang.php?order_id=' . $order_id . '&message=Cập nhật trạng thái thành công!');
        exit;
    } else {
        header('Location: chitietdonhang.php?order_id=' . $order_id . '&error=Lỗi khi cập nhật trạng thái!');
        exit;
    }
    
}
?>

<div class="container">
    <!-- Header -->
    <div class="header">Chi Tiết Đơn Hàng #<?php echo $order['order_id']; ?></div>

    <!-- Main Content -->
    <div class="content">
        <!-- Left Section: Thông Tin Sản Phẩm -->
        <div class="left-section">
            <h3>Thông Tin Sản Phẩm</h3>
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($item = $items_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $item['product_name']; ?></td>
                        <td><?php echo $item['product_quantity']; ?></td>
                        <td><?php echo number_format($item['product_price'], 0, ',', '.'); ?> đ</td>
                        <td><?php echo number_format($item['product_quantity'] * $item['product_price'], 0, ',', '.'); ?> đ</td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Right Section: Trạng Thái và Thông Tin Người Mua -->
        <div class="right-section">
            <!-- Trạng Thái Đơn Hàng -->
            <div class="section status">
                <h3>Trạng Thái Đơn Hàng</h3>
                <form method="POST">
                    <select name="order_status">
                        <option value="Đang chuẩn bị" <?php if($order['order_status'] == 'Đang chuẩn bị') echo 'selected'; ?>>Đang chuẩn bị</option>
                        <option value="Đã giao" <?php if($order['order_status'] == 'Đã giao') echo 'selected'; ?>>Đã giao</option>
                        <option value="Hủy đơn" <?php if($order['order_status'] == 'Hủy đơn') echo 'selected'; ?>>Hủy đơn</option>
                    </select>
                    <?php if (isset($_GET['message'])): ?>
                        <p style="color:red; text-align: center; margin-top:10px;" class="text-center">
                            <?php echo htmlspecialchars($_GET['message']); ?>
                        </p>
                    <?php endif; ?>

                    <?php if (isset($_GET['error'])): ?>
                        <p style="color:red; text-align: center;" class="text-center">
                            <?php echo htmlspecialchars($_GET['error']); ?>
                        </p>
                    <?php endif; ?>
                    <button type="submit" class="btn-save">Cập nhật trạng thái</button>
                </form>
            </div>

            <!-- Thông Tin Người Mua -->
            <div class="section info">
                <h3>Thông Tin Người Mua</h3>
                <ul>
                    <li><strong>Họ tên:</strong> <?php echo $order['user_name']; ?></li>
                    <li><strong>Email:</strong> <?php echo $order['user_email']; ?></li>
                    <li><strong>Số điện thoại:</strong> <?php echo $order['user_phone']; ?></li>
                    <li><strong>Tỉnh thành:</strong> <?php echo $order['user_city']; ?></li>
                    <li><strong>Địa chỉ:</strong> <?php echo $order['user_address']; ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
