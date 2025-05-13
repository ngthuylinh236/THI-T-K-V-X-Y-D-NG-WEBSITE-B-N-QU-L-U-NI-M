<?php
  session_start();
  if(!empty($_SESSION['cart']) && isset($_POST['checkout'])){
  }else{

  }
?>
<?php include('layout/header.php'); ?>
    <style>
        
        .success-container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
        .success-container .icon {
            background-color: #6cba6f;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
        }
        .success-container .icon i {
            color: white;
            font-size: 40px;
        }
        .success-container h2 {
            color: #6cba6f;
            margin-bottom: 10px;
        }
        .success-container p {
            color: #555;
            margin-bottom: 20px;
        }
        .success-container .button {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .success-container .button a {
            padding: 10px 20px; /* Khoảng cách bên trong */
            font-size: 1rem; /* Kích thước chữ */
            border: none; 
            background-color: coral; /* Màu nền */
            color: white; /* Màu chữ */
            cursor: pointer; /* Con trỏ chuột */
            margin-top: 15px; /* Khoảng cách phía trên */
            border-radius: 5px; /* Bo tròn góc */
            text-decoration: none; /* Xóa gạch chân */
            transition: background-color 0.3s; /* Hiệu ứng chuyển màu mượt mà */
        }

        .success-container .button a:hover {
            background-color: darkorange; /* Màu nền khi hover */
        }

    </style>

<!--Sau khi đặt hàng xong nè--> 
<section class="my-5 pt-5">
<div class="success-container">
    <div class="icon">
        <i>✔</i>
    </div>
    <h2>Bạn đã đặt hàng thành công</h2>
    <div class="button">
        <a href="index.php">Quay lại trang chủ</a>
    </div>
</div>
</section>






<?php include('layout/footer.php'); ?>