<?php include 'header.php'; ?>
<?php
include('server/connection.php');
// Truy vấn dữ liệu từ bảng contact
$sql = "SELECT contact_id,user_name, user_phone, user_email, content, DATE(date) AS date, contact_status FROM contact";
$result = $conn->query($sql);
?>
<div class="main-content">
    <header>
        <h1>Danh sách liên hệ</h1>
    </header>
<!-- Nút thêm mới -->
<a href="themlienhe.php" class="btn-add2">+ Thêm mới</a>
    <!-- Bảng danh sách tin nhắn -->
    <div class="contact-list">
        <table>
            <thead>
                <tr>
                    <th>Họ và tên</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                    // Lặp qua từng hàng dữ liệu
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a href='chitietlh.php?id=" . htmlspecialchars($row['contact_id']) . "' class='contact-link'>" . htmlspecialchars($row['user_name']) . "</a></td>";
                        echo "<td>" . htmlspecialchars($row['user_phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['user_email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['content']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                        echo "<td>
                                <select>
                                    <option " . ($row['contact_status'] == 'Mới' ? 'selected' : '') . ">Mới</option>
                                    <option " . ($row['contact_status'] == 'Đang xử lý' ? 'selected' : '') . ">Đang xử lý</option>
                                    <option " . ($row['contact_status'] == 'Đã phản hồi' ? 'selected' : '') . ">Đã phản hồi</option>
                                </select>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
