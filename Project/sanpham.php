
<?php include('layout/header.php'); ?>
    <style>
      .pagination a{
        color:coral;
      }
      .pagination li:hover a{
        color:#fff;
        background: coral;
      }

</style>

  <!--Featured-->
  <section id="featured" class="my-5 pd-5">
    <div class="container text-center mt-5 py-5">
      <h3 style="font-family: 'Arial'; font-weight: 700;">Sản phẩm nổi bật</h3>
      <hr style="color:coral">
      <p>Hãy khám phá những sản phẩm nổi bật của chúng tôi tại đây</p>
    </div> 
    <div class="search-container d-flex justify-content-center align-items-center mb-4">
    <input type="text" id="searchInput" class="form-control me-2" placeholder="Tìm sản phẩm..." style="width: 300px;" />
    <button class="btn btn-primary" onclick="filterProducts()">Tìm kiếm</button>
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

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center mt-5">
    <li class="page-item"><a class="page-link" href="#">&#60;</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">&#62;</a></li>
  </ul>
</nav>




<script>
document.getElementById("searchInput").addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        filterProducts();
    }
});

function filterProducts() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const products = document.querySelectorAll(".product");

    let hasResults = false;
    products.forEach(product => {
        const productName = product.querySelector(".p-name").textContent.toLowerCase();
        if (productName.includes(input)) {
            product.style.display = "block";
            hasResults = true;
        } else {
            product.style.display = "none";
        }
    });

    const noResult = document.getElementById("noResult");
    if (!hasResults) {
        noResult.style.display = "block";
    } else {
        noResult.style.display = "none";
    }
}
</script>
<?php include('layout/footer.php'); ?>
