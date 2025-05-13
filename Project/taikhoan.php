<?php
session_start();
include('server/connection.php');
if(!isset($_SESSION['logged_in'])){
  header('location:dangnhap.php');
  exit;
}
if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location:dangnhap.php');
    exit;
  }
}
if(isset($_POST['change_password'])){
  $password= $_POST['password'];
  $confirmpassword= $_POST['confirmpassword'];
  $user_email=$_SESSION['user_email'];
  if($password !== $confirmpassword){
    header('location:taikhoan.php?error= Mật khẩu không khớp ');
  }
  else if (strlen($password)<6){
    header('location:taikhoan.php?error= Mật khẩu phải chứa ít nhất 6 kí tự');
  }else{
    $stmt=$conn->prepare("UPDATE users SET user_password =? WHERE user_email=? ");
    $stmt->bind_param('ss',md5($password),$user_email);
    if($stmt->execute()){
      header('location:taikhoan.php?message=Mật khẩu đã cập nhật');
    } else {
      header('location:taikhoan.php?error=Không thể cập nhật mật khẩu mới');
    }
  }
}


//Đơn hàng của bạn ở chỗ này//
if(isset($_SESSION['logged_in'])){
  $user_id = $_SESSION['user_id']; 
  $stmt=$conn->prepare("SELECT * FROM orders WHERE user_id=?");
  $stmt-> bind_param('i',$user_id);
  $stmt->execute();
  $orders=$stmt->get_result();
}
?>
<?php include('layout/header.php'); ?>

      <section class="my-5 pt-5">
        <div class="container">
            <div class="row">
                <!-- Account Info -->
                <div class="col-md-6">
                    <h2 class="font-weight-bold">Thông tin tài khoản</h2>
                    <hr style="color:coral">
                    <div class="account-info">
                        <p>Họ tên: <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];}?></span></p>
                        <p>Email: <span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];} ?></span></p>
                        <p><a href="#orders" id="order-btn">Đơn hàng của bạn</a></p>
                        <p><a href="taikhoan.php?logout=1" id="logout-btn">Đăng xuất</a></p>
                    </div>
                </div>
                <!-- Change Password -->
                <div class="col-md-6">
                    <h2 class="font-weight-bold">Đổi mật khẩu</h2>
                    <hr style="color:coral">
                    <form id="account-form" method="POST" action="taikhoan.php">
                      <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
                      <p class="text-center" style="color:red"><?php if(isset($_GET['message'])){echo $_GET['message'];}?></p>
                        <div class="form-group"> 
                            <label for="account-password">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="account-password" name="password" placeholder="Nhập mật khẩu mới" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="account-confirmpassword">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control" id="account-confirmpassword" name="confirmpassword" placeholder="Nhập lại mật khẩu mới" required>
                        </div>
                        <div class="form-group">
                        <input type="submit" class="btn btn-primary mt-4" name="change_password" id="change-pass-btn" value="Đổi mật khẩu"></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
  <!--Order-->  
    <section id='orders' class="orders container my-5 py-3">
      <div class="container mt-5">
          <h2 class="font-weight-bold">Đơn hàng của bạn</h2>
          <hr style="color:coral">
      </div>
      <table class="mt-5 pt-5">
        <tr>
          <th>Mã đơn hàng</th>
          <th>Giá trị</th>
          <th>Trạng thái</th>
          <th>Thời gian</th>
          <th>Chi tiết đơn hàng</th>
        </tr>
        <?php while($row = $orders->fetch_assoc()){ ?>
                <tr>
                  <td>
                    <span><?php echo $row['order_id'];?></span>
                  </td>
                  <td>
                    <span><?php echo $row['order_cost'];?>đ</span>
                  </td>
                  <td>
                    <span><?php echo $row['order_status'];?></span>
                  </td>
                  <td>
                    <span><?php echo $row['order_date'];?></span>
                  </td>
                  <td>
                    <form method="POST" action="chitietdonhang.php">
                      <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id"/>
                     <input class="btn orderdetails-btn" name="order_details_btn" type="submit" value="Xem chi tiết"/>
                    </form>
                  </td>
                </tr>
      <?php } ?>
      </table>
    </section>


<!--footer-->
<?php include('layout/footer.php'); ?>