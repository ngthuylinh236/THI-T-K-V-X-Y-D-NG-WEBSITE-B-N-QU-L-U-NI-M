<?php
session_start();

// Kiểm tra xem session 'cart' đã được khởi tạo chưa, nếu chưa thì khởi tạo mảng trống
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['them_vao_gio'])) {
    $product_array_ids = array_column($_SESSION['cart'], 'product_id'); // [2,3,4,10,15]

    if (!in_array($_POST["product_id"], $product_array_ids)) {
      $product_id=$_POST['product_id'];
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity'],
        );
        $_SESSION['cart'][$_POST['product_id']] = $product_array;
    } else {
        echo '<script>alert("Sản phẩm đã có trong giỏ hàng");</script>';
    }
calculatetotal();//gọi hàm khi thêm sản phẩm


//xóa sản phẩm khỏi giỏ
}else if(isset($_POST['remove_product'])){
  $product_id=$_POST['product_id'];
  if (isset($_SESSION['cart'][$product_id])) {
  unset($_SESSION['cart'][$product_id]);
  calculatetotal();//gọi hàm sau khi xóa
  }
  



//sửa số lượng sản phẩm
}else if(isset($_POST['edit_quantity'])){
  // lấy id sản phẩm và số lượng từ form
  $product_id=$_POST['product_id'];
  $product_quantity=$_POST['product_quantity'];
  //lấy mảng từ session
  $product_array = $_SESSION['cart'][$product_id];
  // sửa số lượng
  $product_array['product_quantity'] = $product_quantity;
  // return mảng 
  $_SESSION['cart'][$product_id] = $product_array;
  calculatetotal();//gọi hàm sau khi sửa

}//else {
    //header('location:index.php');
    //exit();
//}

function calculatetotal() {
  $total = 0;
  foreach ($_SESSION['cart'] as $key => $product) {
      // Đảm bảo lấy chính xác giá và số lượng từ session
      $price = $product['product_price'];
      $quantity = $product['product_quantity'];
      $total += $price * $quantity; // Tính thành tiền cho từng sản phẩm và cộng vào tổng tiền
  }
  $_SESSION['total'] = $total; // Cập nhật tổng tiền trong session
}

?>

<?php include('layout/header.php'); ?>
    <!--cart-->
<section class="cart container my-5 py-5">
      <div class="container mt-5">
          <h2 class="font-weight-bold">Giỏ hàng</h2>
          <hr style="color:coral">
      </div>
      <table class="mt-5 pt-5">
    <tr>
        <th>Sản phẩm</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
    </tr>
    <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $key => $value): ?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/img/<?php echo $value['product_image']; ?>">
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><?php echo $value['product_price']; ?>đ</small>
                            <br>
                            <form method="POST" action giohang.php>
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                                <input type="submit" name="remove_product" class="remove-btn" value="Xóa"/>
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form method="POST" action giohang.php>
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                    <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">
                    <input type="submit" name="edit_quantity" class="edit-btn" value="Sửa"/>
                    </form>
                </td>
                <td>
                    <span class="product-price"><?php echo $value['product_price'] * $value['product_quantity']; ?>đ</span>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">Giỏ hàng của bạn hiện đang trống.</td>
        </tr>
    <?php endif; ?>
  </table>
</div>
<div class="cart-total">
   <table>
      <tr>
         <td>Tổng tiền</td>
         <td><?php echo $_SESSION['total'] ?>đ</td>
      </tr>
   </table>
</div>
      <div class="checkout-container">
        <form method="POST" action= "thanhtoan.php">
          <input type="submit" class="btn checkout-btn" name="checkout" value="Thanh toán"/>
        </form>
      </div>
</section>

<?php include('layout/footer.php'); ?>