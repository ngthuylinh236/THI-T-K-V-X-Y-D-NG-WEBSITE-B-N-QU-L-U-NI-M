<?php
session_start();
include ('server/connection.php');
$stmt=$conn->prepare('SELECT*FROM products LIMIT 8');
$stmt->execute();
$featured_products=$stmt -> get_result();
?>
<?php include('layout/header.php'); ?>
   <!--Đây là Trang chủ-->
    <section id="home">
        <div class= "container"></div>
          <h5>Khám phá </h5>
          <h1>Những món quà <span>ý nghĩa</span></h1>
          <p>Hành động thay lời iu thương</p>
          <button class="buy-btn" onclick="window.location.href='sanpham.php'">Mua ngay</button>
    </section> 
    <section id= "featured" class="my-5 pd-5">
      <div class="container text-center mt-5 py-5">
        <h3 style="font-family: 'Arial'; font-weight: 700;">Bộ sưu tập</h3>
        <hr>
        <p>Bộ sưu tập sản phẩm đa dạng của chúng tôi</p>
      </div>
  </section>

   <!--new-->
   <section id="new" class="w-100">
    <!-- Dùng row bao bọc tất cả -->
    <div class="row">
      <!-- Cột 1 -->
      <div class="one">
        <img class="img-fluid" src="assets/img/valentine.avif" />
        <div class="details">
          <h2>Quà Valentine</h2>
          <button class="text-uppercase" onclick="window.location.href='valentine.php'">Xem ngay</button>
        </div>
      </div>
      <!-- Cột 2 -->
      <div class="one">
        <img class="img-fluid" src="assets/img/giangsinh.jpg" />
        <div class="details">
          <h2>Quà Giáng Sinh</h2>
          <button class="text-uppercase" onclick="window.location.href='giangsinh.php'">Xem ngay</button>
        </div>
      </div>
      <!-- Cột 3 -->
      <div class="one">
        <img class="img-fluid" src="assets/img/sinhnhat.jpg" />
        <div class="details">
          <h2>Quà Sinh Nhật</h2>
          <button class="text-uppercase" onclick="window.location.href='sinhnhat.php'">Xem ngay</button>
        </div>
      </div>
    </div>
  </section>
  
  <!--Featured-->
  <section id="featured" class="my-5 pd-5">
    <div class="container text-center mt-5 py-5">
      <h3 style="font-family: 'Arial'; font-weight: 700;">Sản phẩm nổi bật</h3>
      <hr>
      <p>Hãy khám phá những sản phẩm nổi bật của chúng tôi tại đây</p>
    </div> 
    <div class="row mx-auto container-fluid">
    <?php while($row=$featured_products-> fetch_assoc()){?>

      <div class="product col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/img/<?php echo $row['product_image'];?>"/>
          <h5 class="p-name"><?php echo $row['product_name'];?></h5>
          <h4 class="p-price"><?php echo $row['product_price'];?>đ</h4>
          <a href="<?php echo "chitietsp.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Mua ngay</button></a>
      </div>
    <?php } ?>
  </div>
</section>
<!--footer-->
<?php include('layout/footer.php'); ?>