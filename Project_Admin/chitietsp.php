<?php 
include 'header.php'; 
include('server/connection.php'); 

// Kiểm tra nếu có tham số product_id trong URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Truy vấn thông tin sản phẩm từ bảng products
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Lấy dữ liệu sản phẩm
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sản phẩm!";
        exit;
    }
} 
?>
<div class="container-product">
    <h2>Thông tin sản phẩm</h2>
    <form action="sua_sp.php" method="POST">
        <!-- Gửi product_id ẩn -->
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

        <!-- Tên sản phẩm -->
        <label for="tenSanPham">Tên sản phẩm</label>
        <input type="text" id="tenSanPham" name="tenSanPham" value="<?php echo htmlspecialchars($product['product_name']); ?>">

        <!-- Phân loại -->
        <label for="phanLoai">Phân loại</label>
        <select id="phanLoai" name="phanLoai">
            <option <?php echo $product['product_category'] == 'Quà sinh nhật' ? 'selected' : ''; ?>>Quà sinh nhật</option>
            <option <?php echo $product['product_category'] == 'Quà giáng sinh' ? 'selected' : ''; ?>>Quà giáng sinh</option>
            <option <?php echo $product['product_category'] == 'Quà valentine' ? 'selected' : ''; ?>>Quà valentine</option>
        </select>

        <!-- Nhà cung cấp -->
        <label for="nhaCungCap">Nhà cung cấp</label>
        <input type="text" id="nhaCungCap" name="nhaCungCap" value="<?php echo htmlspecialchars($product['product_supplier']); ?>">

        <!-- Giá sản phẩm -->
        <label for="giaSanPham">Giá sản phẩm</label>
        <input type="number" id="giaSanPham" name="giaSanPham" value="<?php echo htmlspecialchars($product['product_price']); ?>">

        <!-- Mô tả sản phẩm -->
        <label for="moTaSanPham">Mô tả sản phẩm</label>
        <textarea id="moTaSanPham" name="moTaSanPham" rows="4"><?php echo htmlspecialchars($product['product_description']); ?></textarea>

        <!-- Số lượng tồn kho -->
        <label for="soLuongTonKho">Số lượng tồn kho</label>
        <input type="number" id="soLuongTonKho" name="soLuongTonKho" value="<?php echo htmlspecialchars($product['product_stock']); ?>">
        <!-- Hình ảnh sản phẩm -->
        <div class="image-upload">
            <label for="hinhAnhChinh">Hình ảnh chính</label>
            <input type="file" id="hinhAnhChinh">
            <img src="img/<?php echo $product['product_image']; ?>" style="width: 100px; height: 100px;">

            <label for="hinhAnhPhu1">Hình ảnh phụ 1</label>
            <input type="file" id="hinhAnhPhu1">
            <img src="img/<?php echo $product['product_image1']; ?>" style="width: 100px; height: 100px;">

            <label for="hinhAnhPhu2">Hình ảnh phụ 2</label>
            <input type="file" id="hinhAnhPhu2">
            <img src="img/<?php echo $product['product_image2']; ?>" style="width: 100px; height: 100px;">

            <label for="hinhAnhPhu3">Hình ảnh phụ 3</label>
            <input type="file" id="hinhAnhPhu3">
            <img src="img/<?php echo $product['product_image3']; ?>" style="width: 100px; height: 100px;">

            <label for="hinhAnhPhu4">Hình ảnh phụ 4</label>
            <input type="file" id="hinhAnhPhu4">
            <img src="img/<?php echo $product['product_image4']; ?>" style="width: 100px; height: 100px;">
        </div>
        <!-- Nút Lưu -->
        <?php
        if (isset($_GET['message'])) {
            echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($_GET['message']) . "</p>";
        } ?>
        <div class="button-product-group">
                    <button type="button" class="btn-cancel" onclick="window.location.href='sanpham.php';">&lt; Quay lại</button>
                    <button type="submit" class="btn-save">Lưu</button>
        </div>
    </form>
</div>
