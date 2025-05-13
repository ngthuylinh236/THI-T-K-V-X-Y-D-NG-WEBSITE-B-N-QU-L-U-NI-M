<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lia Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Sidebar -->
    <aside>
        <div class="logo">
            <img src="img/Xoanen.png" alt="Logo">
            <h1>Lia</h1>
        </div>
        <nav>
            <ul>
            <li><a href="donhang.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'donhang.php') ? 'active' : ''; ?>">Đơn hàng</a></li>
            <li><a href="sanpham.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'sanpham.php') ? 'active' : ''; ?>">Sản phẩm</a></li>
            <li><a href="lienhe.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'lienhe.php') ? 'active' : ''; ?>">Liên hệ</a></li>
            </ul>
        </nav>
    </aside>
</body>
</html>
