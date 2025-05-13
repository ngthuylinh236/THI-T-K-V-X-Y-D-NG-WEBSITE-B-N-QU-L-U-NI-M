<?php
include('server/connection.php');
if(isset($_GET['product_id'])){
  $product_id= $_GET['product_id'];
    $stmt=$conn->prepare('SELECT*FROM products WHERE product_id=?');
    $stmt->bind_param('i',$product_id);
    $stmt->execute();
    $product=$stmt -> get_result();
}else{
  header('location:index.php');
}
?>
<?php include('layout/header.php'); ?>

    <!-- Phần sản phẩm trong container -->
    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">
          <?php while($row=$product-> fetch_assoc()){?>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assets/img/<?php echo $row['product_image'];?>" id="mainimg"/>
                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="assets/img/<?php echo $row['product_image1'];?>" width="100%" class="small-img" />
                    </div>
                    <div class="small-img-col">
                        <img src="assets/img/<?php echo $row['product_image2'];?>" width="100%" class="small-img" />
                    </div>
                    <div class="small-img-col">
                        <img src="assets/img/<?php echo $row['product_image3'];?>" width="100%" class="small-img" />
                    </div>
                    <div class="small-img-col">
                        <img src="assets/img/<?php echo $row['product_image4'];?>" width="100%" class="small-img" />
                    </div>
                </div>
            </div>
<!--Single product-->
            <div class="col-lg-6 col-md-12 col-12">
              <h5 class="py-4" style="font-family: Arial, sans-serif; font-weight: bold; font-size: 30px;"><?php echo $row['product_name'];?></h5>
                <h2 style="color:red"><?php echo $row['product_price'];?>đ</h2>
                <form method="POST" action="giohang.php">
                  <input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>"/>
                  <input type="hidden" name="product_image" value="<?php echo $row['product_image'];?>"/>
                  <input type="hidden" name="product_name" value="<?php echo $row['product_name'];?>"/>
                  <input type="hidden" name="product_price" value="<?php echo $row['product_price'];?>"/>
                  <input type="number" name="product_quantity" value="1"/>
                  <button class="buy-btn" type="submit" name="them_vao_gio">Thêm vào giỏ hàng</button>
                </form>
                <h4 class="mt-5 pb-5">Mô tả sản phẩm</h4>
                <span><?php echo nl2br($row['product_description']);?></span>
            </div>
        </div>
    <?php }?>
    </section>
<!--Related product-->
<section id="related-product" class="my-5 pd-5">
  <div class="container text-center mt-5 py-5">
    <h3 style="font-family: 'Arial'; font-weight: 700;">Sản phẩm liên quan</h3>
    <hr style="color:coral">
    <p>Hãy khám phá những sản phẩm nổi bật của chúng tôi tại đây</p>
  </div> 
  <div class="row mx-auto container-fluid">
  <?php include('server/laysanpham.php')?>
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






  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
      var mainimg = document.getElementById("mainimg");
      var smallimg = document.getElementsByClassName("small-img");
      
      for (let i = 0; i < smallimg.length; i++) {
        smallimg[i].onclick = function() {
          mainimg.src = smallimg[i].src;
        }
      }
    </script>
<?php include('layout/footer.php'); ?>