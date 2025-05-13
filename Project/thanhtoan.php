<?php
session_start();

// Kiểm tra nếu giỏ hàng rỗng hoặc không gửi đơn hàng
if (empty($_SESSION['cart']) || !isset($_POST['checkout'])) {
    header('Location: index.php');
    exit();
}
?>

<?php include('layout/header.php'); ?>

<style>
    /* Style cho khoảng cách giữa các ô lựa chọn */
    .form-check {
        margin-bottom: 10px;
        margin-top:15px;
    }
</style>

<!-- Giao diện thanh toán -->
<section class="my-5 pt-5">
    <div class="container mt-3 pt-5">
        <h2 class="text-center font-weight-bold mb-4">Thanh toán</h2>
        <hr style="color: coral">

        <section class="row checkout-section">
            <!-- Thông tin khách hàng -->
            <div class="col-md-6">
                <h4 class="text-center">Thông tin khách hàng</h4>
                <form id="checkout-form" method="POST" action="dathang.php">
                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Tỉnh/Thành phố</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Nhập tỉnh/thành phố" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Nhập địa chỉ" required></textarea>
                    </div>
                    
                    <!-- Phương thức thanh toán -->
                    <div class="payment-method-section mt-4">
                        <h4 class="text-center">Phương thức thanh toán</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod">
                            <label class="form-check-label" for="payment_cod">Thanh toán khi nhận hàng</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="payment_bank_transfer" value="bank">
                            <label class="form-check-label" for="payment_bank_transfer">Thanh toán qua chuyển khoản</label>
                        </div>
                        <div id="bank-details" class="bank-details-section mt-3">
                            <p><strong>Số tài khoản:</strong> 123456789</p>
                            <p><strong>Ngân hàng:</strong> Ngân hàng ABC</p>
                            <p><strong>Người nhận:</strong> Công ty XYZ</p>
                        </div>
                    </div>

                    <button type="submit" name="place_order" class="btn btn-primary w-100 mt-3">Đặt hàng</button>
                </form>
            </div>

            <!-- Thông tin đơn hàng -->
            <div class="col-md-6 order-info-section">
                <h4 class="text-center">Thông tin đơn hàng</h4>
                <div class="order-info">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $key => $value): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($value['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($value['product_quantity']); ?></td>
                                    <td><?php echo number_format($value['product_price'] * $value['product_quantity']); ?>đ</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2"><strong>Tổng tiền</strong></td>
                                <td style="color: coral"><strong><?php echo number_format($_SESSION['total']); ?>đ</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>

<?php include('layout/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentBankTransfer = document.getElementById('payment_bank_transfer');
    const paymentCod = document.getElementById('payment_cod');
    const bankDetails = document.getElementById('bank-details');

    // Logic hiển thị thông tin ngân hàng khi chọn phương thức chuyển khoản
    paymentBankTransfer.addEventListener('change', function() {
        bankDetails.style.display = 'block';
    });

    paymentCod.addEventListener('change', function() {
        bankDetails.style.display = 'none';
    });
});
</script>
