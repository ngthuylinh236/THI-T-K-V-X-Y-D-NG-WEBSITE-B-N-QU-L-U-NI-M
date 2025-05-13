<?php include 'header.php'; ?>

<?php
// Kết nối cơ sở dữ liệu
include('server/connection.php');

// Xử lý form thêm liên hệ
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_contact'])) {
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';
    $time = isset($_POST['time']) ? trim($_POST['time']) : '';
    $status = 'Mới'; // Trạng thái mặc định

    if ($full_name && $phone && $email && $content && $time) {
        $sql = "INSERT INTO contact (user_name, user_phone, user_email, content, date, contact_status)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $full_name, $phone, $email, $content, $time, $status);

        if ($stmt->execute()) {
            echo "<script>alert('Thông tin đã được lưu thành công!');</script>";
            echo "<script>window.location.href = 'lienhe.php';</script>";
        } else {
            echo "<script>alert('Lỗi: " . htmlspecialchars($conn->error) . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    }
}

// Đóng kết nối
$conn->close();
?>

<div class="main-content">
    <div class="form-container" style="display: flex; gap: 15px;">

        <!-- Phần thông tin người liên hệ -->
        <div class="contact-info" style="flex: 2;">
            <h3>Thông tin người liên hệ</h3>
            <form action="" method="post"> <!-- Xử lý trên chính file này -->
                <input type="hidden" name="add_contact" value="1">
                <label for="full_name">Họ và tên</label>
                <input type="text" id="full_name" name="full_name" required><br><br>

                <label for="phone">Số điện thoại</label>
                <input type="text" id="phone" name="phone" required><br><br>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="content">Nội dung</label>
                <textarea id="content" name="content" required></textarea><br><br>

                <label for="time">Thời gian</label>
                <input type="datetime-local" id="time" name="time" required><br><br>

                <!-- Nút submit -->
                <input type="submit" value="Lưu thông tin">
            </form>
        </div>

        <!-- Phần trạng thái -->
        <div class="status-container" style="flex: 1;">
            <h3>Trạng thái liên hệ</h3>
            <form action="" method="post"> <!-- Xử lý trên chính file này -->
                <label for="status">Chọn trạng thái:</label>
                <select id="status" name="status">
                    <option value="Mới">Mới</option>
                    <option value="Đang xử lý">Đang xử lý</option>
                    <option value="Đã phản hồi">Đã phản hồi</option>
                </select><br><br>

                <!-- Nút cập nhật trạng thái 
                    <input type="submit" value="Cập nhật trạng thái">-->
            </form>
        </div>
    </div>
</div>
