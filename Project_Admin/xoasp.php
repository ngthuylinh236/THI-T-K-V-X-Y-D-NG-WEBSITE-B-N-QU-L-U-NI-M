<?php 
include('server/connection.php');

// Kiểm tra xem có truyền product_id qua GET không
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Chặn các tấn công bằng cách ép kiểu ID là số nguyên

    // Thực thi lệnh xóa
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    
    if ($stmt->execute()) {
        header("Location: sanpham.php?message=Xóa sản phẩm thành công!"); // Redirect về trang danh sách sản phẩm
        exit();
    } else {
        header("Location: sanpham.php?error=Đã có lỗi xảy ra!"); // Redirect nếu xóa thất bại
        exit();
    }
} 
?>
