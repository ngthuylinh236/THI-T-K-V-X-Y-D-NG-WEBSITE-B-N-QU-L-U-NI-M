<?php include 'header.php'; ?>

<?php
// Kết nối cơ sở dữ liệu
include('server/connection.php');

// Lấy ID liên hệ từ URL
$contact_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($contact_id > 0) {
    // Truy vấn thông tin chi tiết liên hệ
    $sql = "SELECT * FROM contact WHERE contact_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $contact_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $contact = $result->fetch_assoc();
}
// Xử lý cập nhật trạng thái
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if ($status) {
        $sql = "UPDATE contact SET contact_status = ? WHERE contact_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $contact_id);

        if ($stmt->execute()) {
            echo "<script>alert('Trạng thái đã được cập nhật thành công!');</script>";
            echo "<script>window.location.href = 'chitietlh.php?id=$contact_id';</script>";
        } else {
            echo "<script>alert('Lỗi: " . htmlspecialchars($conn->error) . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Vui lòng chọn trạng thái hợp lệ!');</script>";
    }
}

// Đóng kết nối
$conn->close();
?>

<div class="main-content">
    <div class="form-container" style="display: flex; gap: 15px;">
                <!-- Phần thông tin người liên hệ -->
        <div class="contact-info" style="flex: 2;">
            <h3>Thông tin chi tiết liên hệ</h3>
            <form>
                <label for="full_name">Họ và tên</label>
                <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($contact['user_name']) ?>" readonly><br><br>

                <label for="phone">Số điện thoại</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($contact['user_phone']) ?>" readonly><br><br>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($contact['user_email']) ?>" readonly><br><br>

                <label for="content">Nội dung</label>
                <textarea id="content" name="content" readonly><?= htmlspecialchars($contact['content']) ?></textarea><br><br>

                <label for="time">Thời gian</label>
                <input type="text" id="time" name="time" value="<?= htmlspecialchars($contact['date']) ?>" readonly><br><br>
            </form>
        </div>

        <!-- Phần trạng thái -->
        <div class="status-container" style="flex: 1;">
            <h3>Trạng thái liên hệ</h3>
            <form action="" method="post"> <!-- Xử lý trên chính file này -->
                <input type="hidden" name="update_status" value="1">
                <label for="status">Chọn trạng thái:</label>
                <select id="status" name="status">
                    <option value="Mới" <?= $contact['contact_status'] == 'Mới' ? 'selected' : '' ?>>Mới</option>
                    <option value="Đang xử lý" <?= $contact['contact_status'] == 'Đang xử lý' ? 'selected' : '' ?>>Đang xử lý</option>
                    <option value="Đã phản hồi" <?= $contact['contact_status'] == 'Đã phản hồi' ? 'selected' : '' ?>>Đã phản hồi</option>
                </select><br><br>

                <!-- Nút cập nhật trạng thái -->
                <input type="submit" value="Cập nhật trạng thái">
            </form>
        </div>
    </div>
</div>
