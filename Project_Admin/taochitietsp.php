<?php
include 'header.php'; 
include('server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tenSanPham = $_POST['tenSanPham'];
    $phanLoai = $_POST['phanLoai'];
    $nhaCungCap = $_POST['nhaCungCap'];
    $giaSanPham = $_POST['giaSanPham'];
    $moTaSanPham = $_POST['moTaSanPham'];
    $soLuongTonKho = $_POST['soLuongTonKho'];

    // Xử lý upload hình ảnh (chỉ lưu tên file)
    $product_image = "";
    $product_image1 = "";
    $product_image2 = "";
    $product_image3 = "";
    $product_image4 = "";

    if (!empty($_FILES['hinhAnhChinh']['name'])) {
        $product_image = basename($_FILES['hinhAnhChinh']['name']);
        move_uploaded_file($_FILES['hinhAnhChinh']['tmp_name'], "img/" . $product_image);
    }

    if (!empty($_FILES['hinhAnhPhu1']['name'])) {
        $product_image1 = basename($_FILES['hinhAnhPhu1']['name']);
        move_uploaded_file($_FILES['hinhAnhPhu1']['tmp_name'], "img/" . $product_image1);
    }

    if (!empty($_FILES['hinhAnhPhu2']['name'])) {
        $product_image2 = basename($_FILES['hinhAnhPhu2']['name']);
        move_uploaded_file($_FILES['hinhAnhPhu2']['tmp_name'], "img/" . $product_image2);
    }

    if (!empty($_FILES['hinhAnhPhu3']['name'])) {
        $product_image3 = basename($_FILES['hinhAnhPhu3']['name']);
        move_uploaded_file($_FILES['hinhAnhPhu3']['tmp_name'], "img/" . $product_image3);
    }

    if (!empty($_FILES['hinhAnhPhu4']['name'])) {
        $product_image4 = basename($_FILES['hinhAnhPhu4']['name']);
        move_uploaded_file($_FILES['hinhAnhPhu4']['tmp_name'], "img/" . $product_image4);
    }

    // Chèn thông tin vào database - chỉ lưu tên ảnh
    $sql = "INSERT INTO products (product_name, product_category, product_supplier, product_price, product_description, product_stock, product_image, product_image1, product_image2, product_image3, product_image4) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $tenSanPham, $phanLoai, $nhaCungCap, $giaSanPham, $moTaSanPham, $soLuongTonKho, $product_image, $product_image1, $product_image2, $product_image3, $product_image4);

    if ($stmt->execute()) {
        header('Location: taochitietsp.php?message=Tạo sản phẩm thành công!');
        exit;
    } else {
        header('Location: taochitietsp.php?error=Lỗi khi tạo sản phẩm!');
        exit;
    }
}
    
?>

<div class="container-product" style="height:1200px">
    <h2 style="font-family:Arial">Thêm mới sản phẩm</h2>
    <form action="taochitietsp.php" method="POST" enctype="multipart/form-data">
        <!-- Tên sản phẩm -->
        <label for="tenSanPham">Tên sản phẩm</label>
        <input type="text" id="tenSanPham" name="tenSanPham" required>

        <!-- Phân loại -->
        <label for="phanLoai">Phân loại</label>
        <select id="phanLoai" name="phanLoai" required>
            <option>Quà sinh nhật</option>
            <option>Quà giáng sinh</option>
            <option>Quà valentine</option>
        </select>

        <!-- Nhà cung cấp -->
        <label for="nhaCungCap">Nhà cung cấp</label>
        <input type="text" id="nhaCungCap" name="nhaCungCap" required>

        <!-- Giá sản phẩm -->
        <label for="giaSanPham">Giá sản phẩm</label>
        <input type="number" id="giaSanPham" name="giaSanPham" required>

        <!-- Mô tả sản phẩm -->
        <label for="moTaSanPham">Mô tả sản phẩm</label>
        <textarea id="moTaSanPham" name="moTaSanPham" rows="4" required></textarea>

        <!-- Số lượng tồn kho -->
        <label for="soLuongTonKho">Số lượng tồn kho</label>
        <input type="number" id="soLuongTonKho" name="soLuongTonKho" required>

        <!-- Hình ảnh sản phẩm -->
        <div class="image-upload">
            <label for="hinhAnhChinh">Hình ảnh chính</label>
            <input type="file" id="hinhAnhChinh" name="hinhAnhChinh">

            <label for="hinhAnhPhu1">Hình ảnh phụ 1</label>
            <input type="file" id="hinhAnhPhu1" name="hinhAnhPhu1">

            <label for="hinhAnhPhu2">Hình ảnh phụ 2</label>
            <input type="file" id="hinhAnhPhu2" name="hinhAnhPhu2">

            <label for="hinhAnhPhu3">Hình ảnh phụ 3</label>
            <input type="file" id="hinhAnhPhu3" name="hinhAnhPhu3">

            <label for="hinhAnhPhu4">Hình ảnh phụ 4</label>
            <input type="file" id="hinhAnhPhu4" name="hinhAnhPhu4">

        </div>
        <?php if (isset($_GET['message'])): ?>
            <p style="color:red; text-align: center;" class="text-center"><?php echo $_GET['message']; ?></p>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <p style="color:red; text-align: center;" class="text-center"><?php echo $_GET['error']; ?></p>
        <?php endif; ?>
        <!-- Nút Tạo -->
        <div class="button-product-group">
            <button type="button" class="btn-cancel" onclick="window.location.href='sanpham.php';">&lt; Quay lại</button>
            <button type="submit" class="btn-save">Lưu</button>
        </div>


    </form>
</div>
