<?php
include('server/connection.php');
if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])){
    $order_id=$_POST['order_id'];
    $stmt=$conn->prepare("SELECT * FROM order_items WHERE order_id=?");
    $stmt->bind_param('i',$order_id);
    $stmt->execute();
    $order_details=$stmt->get_result();
}else{
    header:('location:taikhoan.php');
    exit;
}
?>
<?php include('layout/header.php'); ?>
    <style>
  .product-info {
    display: flex;
    align-items: center; /* Căn giữa hình và tên sản phẩm theo trục dọc */
  }

  .product-info img {
    width: 50px; /* Điều chỉnh kích thước hình ảnh */
    height: 50px; /* Điều chỉnh kích thước hình ảnh */
    object-fit: cover; /* Đảm bảo hình ảnh giữ tỉ lệ */
    margin-right: 10px; /* Tạo khoảng cách giữa hình và tên */
  }

  .product-info p {
    margin: 0; /* Loại bỏ margin mặc định của thẻ <p> */
  }
</style>





  <!--Order-->  
    <section id='orders' class="orders container my-5 py-3">
      <div class="container mt-5">
          <h2 class="font-weight-bold">Chi tiết đơn hàng</h2>
          <hr style="color:coral">
      </div>
      <table class="mt-5 pt-5 mx-auto">
        <tr>
          <th>Tên sản phẩm</th>
          <th>Giá</th>
          <th>Số lượng</th>
        </tr>
        <?php while($row = $order_details->fetch_assoc()){ ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/img/<?php echo $row ['product_image']?>"/>
                            <div>
                                <p class="mt-3"><?php echo $row ['product_name']?></p>
                            </div>
                        </div>
                    </td>
               
                  <td>
                    <span><?php echo $row ['product_price']?>đ</span>
                  </td>
                  <td>
                    <span><?php echo $row ['product_quantity']?></span>
                  </td>
                </tr>
      <?php } ?>
      </table>
    </section>

    <?php include('layout/footer.php'); ?>