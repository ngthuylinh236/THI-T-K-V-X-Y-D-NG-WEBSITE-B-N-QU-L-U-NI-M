<?php 
include('server/connection.php');

// Kiểm tra xem form có được submit hay không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $product_id = $_POST['product_id'];
    $tenSanPham = $_POST['tenSanPham'];
    $phanLoai = $_POST['phanLoai'];
    $nhaCungCap = $_POST['nhaCungCap'];
    $giaSanPham = $_POST['giaSanPham'];
    $moTaSanPham = $_POST['moTaSanPham'];
    $soLuongTonKho = $_POST['soLuongTonKho'];

    // Truy vấn để cập nhật thông tin sản phẩm
    $sql = "UPDATE products SET 
                product_name = ?, 
                product_category = ?, 
                product_supplier = ?, 
                product_price = ?, 
                product_description = ?, 
                product_stock = ? 
            WHERE product_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssi", 
        $tenSanPham, 
        $phanLoai, 
        $nhaCungCap, 
        $giaSanPham, 
        $moTaSanPham, 
        $soLuongTonKho, 
        $product_id
    );

    if ($stmt->execute()) {
        header("Location: chitietsp.php?product_id=$product_id&message=Sửa thông tin sản phẩm thành công!");
        exit;
    } else {
        header("Location: chitietsp.php?product_id=$product_id&message=Có lỗi xảy ra! Vui lòng thử lại sau.");
        exit;
    }
}
?>

