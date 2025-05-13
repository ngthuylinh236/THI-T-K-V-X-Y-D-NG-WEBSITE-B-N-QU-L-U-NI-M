<?php
include('server/connection.php');

// Lấy dữ liệu từ bảng orders và order_items
$sql = "SELECT o.order_id, o.order_status, o.order_payment, o.order_cost, o.order_date, 
               GROUP_CONCAT(oi.product_name SEPARATOR ', ') AS product_names, 
               u.user_name 
        FROM orders o 
        JOIN order_items oi ON o.order_id = oi.order_id 
        JOIN users u ON o.user_id = u.user_id 
        GROUP BY o.order_id 
        ORDER BY o.order_date DESC";

$result = $conn->query($sql);
?>
<?php include 'header.php'; ?>

<div class="main-content">
    <header>
        <h1>Danh sách đơn hàng</h1>
    </header>

    <!-- Bộ lọc trạng thái -->
    <div class="filter" style="margin-bottom:15px;">
        <label for="status">Tình trạng: </label>
        <select id="status" name="status" onchange="filterOrders()">
            <option value="all">Tất cả</option>
            <option value="preparing">Đang chuẩn bị</option>
            <option value="shipping">Đang giao</option>
        </select>
    </div>

    <!-- Bảng danh sách đơn hàng -->
    <table id="ordersTable">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Trạng thái</th>
                <th>Phương thức thanh toán</th>
                <th>Tổng tiền</th>
                <th>Ngày lập</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Lặp qua từng dòng dữ liệu 
                while($row = $result->fetch_assoc()) {
                    echo "<tr class='order-row' data-status='" . $row['order_status'] . "'>";
                    echo "<td><a href='chitietdonhang.php?order_id=" . $row['order_id'] . "' class='orderid-link'>" . $row['order_id'] . "</a></td>";
                    echo "<td>" . $row['user_name'] . "</td>";
                    echo "<td>" . $row['order_status'] . "</td>";
                    echo "<td>" . $row['order_payment'] . "</td>";
                    echo "<td>" . number_format($row['order_cost'], 0, ',', '.') . " đ</td>";
                    echo "<td>" . $row['order_date'] . "</td>";
                    echo "<td><button class='btn-delete' onclick='deleteOrder(" . $row['order_id'] . ")'>Xóa</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Không có đơn hàng nào</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
// Hàm lọc đơn hàng dựa vào trạng thái được chọn từ bộ lọc
function filterOrders() {
    let statusFilter = document.getElementById("status").value; // Lấy trạng thái từ menu lọc
    let rows = document.querySelectorAll(".order-row"); // Lấy tất cả các hàng trong bảng

    rows.forEach(row => {
        let orderStatus = row.getAttribute("data-status"); // Lấy trạng thái của từng hàng
        if (statusFilter === "all" || orderStatus === statusFilter) {
            row.style.display = ""; // Hiện hàng nếu phù hợp
        } else {
            row.style.display = "none"; // Ẩn hàng nếu không phù hợp
        }
    });
}

function deleteOrder(orderId) {
    if (confirm("Bạn có chắc muốn xóa đơn hàng này không?")) {
        fetch('xoadonhang.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `order_id=${orderId}`,
        })
        .then(response => response.text())
        .then(data => {
            if (data === "success") {
                alert("Xóa đơn hàng thành công!");
                document.querySelector(`.order-row td a[href$='order_id=${orderId}']`).closest("tr").remove();
            } else {
                alert("Có lỗi xảy ra khi xóa đơn hàng.");
            }
        })
        .catch(error => {
            console.error("Lỗi khi xóa đơn hàng:", error);
            alert("Không thể xóa đơn hàng.");
        });
    }
}
</script>
