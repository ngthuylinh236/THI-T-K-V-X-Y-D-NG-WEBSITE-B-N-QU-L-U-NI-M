<?php
include('server/connection.php');

// Lấy tham số category từ URL hoặc mặc định là 'Quà giáng sinh'
$category = isset($_GET['category']) ? $_GET['category'] : 'Quà sinh nhật';

// Truy vấn sản phẩm theo danh mục
$stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ?");
$stmt->bind_param("s", $category);
$stmt->execute();
$sinhnhat_products = $stmt->get_result();
?>

<?php include('layout/header.php'); ?>
    <!-- Sản phẩm Giáng Sinh -->
    <section id="sinhnhat" class="my-5 pd-5">
        <div class="container text-center mt-5 py-5">
            <h3 style="font-family: 'Arial'; font-weight: 700;">Quà Sinh Nhật</h3>
            <hr style="color:coral">
            <p>Hãy khám phá những món quà sinh nhật tuyệt vời của chúng tôi!</p>
        </div> 
        <div class="row mx-auto container-fluid">
            <?php if ($sinhnhat_products->num_rows > 0) : ?>
                <?php while ($row = $sinhnhat_products->fetch_assoc()) : ?>
                    <div class="product col-lg-3 col-md-4 col-sm-12">
                        <img class="img-fluid mb-3" src="assets/img/<?php echo $row['product_image'];?>"/>
                        <h5 class="p-name"><?php echo $row['product_name'];?></h5>
                        <h4 class="p-price"><?php echo $row['product_price'];?>đ</h4>
                        <a href="<?php echo "chitietsp.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Mua ngay</button></a>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p class="text-center">Hiện tại chưa có sản phẩm nào thuộc danh mục này.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include('layout/footer.php'); ?>
