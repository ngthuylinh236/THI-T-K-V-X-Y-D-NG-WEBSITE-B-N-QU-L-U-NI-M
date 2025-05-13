<?php 
include('server/connection.php');

// Lấy dữ liệu từ bảng products
$sql = "SELECT product_id, product_name, product_price, product_image, product_category FROM products ORDER BY product_name ASC";

$result = $conn->query($sql);
?>

<?php include 'header.php'; ?>

<div class="main-content">
    <header>
        <h1>Danh sách sản phẩm</h1>
    </header>

    <!-- Ô tìm kiếm -->
    <div class="filter">
        <input type="text" id="searchBox" placeholder="Tìm kiếm sản phẩm..." class="search-box">
    </div>

    <!-- Nút tạo thêm sản phẩm -->
    <div class="action-buttons">
        <button class="btn-add-sp" onclick="window.location.href='taochitietsp.php';">Thêm sản phẩm</button>
    </div>

    <!-- Bảng danh sách sản phẩm -->
    <table>
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Phân loại</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if ($result->num_rows > 0) {
                // Lấy từng sản phẩm và tạo giao diện danh sách
                while($row = $result->fetch_assoc()) {
                    echo "<tr class='product-row'>";
                    echo "<td><img src='img/" . $row['product_image'] . "' style='width: 50px; height: 50px;'></td>";
                    echo "<td class='product-name'><a href='chitietsp.php?product_id=" . $row['product_id'] . "' class='product-link'>" . $row['product_name'] . "</a></td>";
                    echo "<td>" . number_format($row['product_price'], 0, ',', '.') . " đ</td>";
                    echo "<td>" . $row['product_category'] . "</td>";
                    echo "<td><button class='btn-delete' onclick='deleteProduct(" . $row['product_id'] . ")'>Xóa</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Không có sản phẩm nào</td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<script>
// JavaScript xác nhận và gọi URL xóa
function deleteProduct(productId) {
    if (confirm("Bạn chắc chắn muốn xóa sản phẩm này?")) {
        window.location.href = `xoasp.php?product_id=${productId}`;
    }
}

// JavaScript để lọc sản phẩm theo từ khóa
document.getElementById("searchBox").addEventListener("input", function() {
    let searchQuery = this.value.toLowerCase();
    let rows = document.querySelectorAll(".product-row");

    rows.forEach(row => {
        let productName = row.querySelector(".product-name").textContent.toLowerCase();
        
        if (productName.includes(searchQuery)) {
            row.style.display = ""; // Hiện hàng
        } else {
            row.style.display = "none"; // Ẩn hàng
        }
    });
});
</script>
