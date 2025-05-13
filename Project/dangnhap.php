<?php
session_start();
include('server/connection.php');
if(isset($_POST['login'])){
  $email=$_POST['email'];
  $password=md5($_POST['password']);

  $stmt=$conn->prepare("SELECT user_id,user_name, user_email, user_password FROM users WHERE user_email=? AND user_password=? LIMIT 1");
  $stmt->bind_param('ss',$email,$password);
  if($stmt-> execute()){
    $stmt->bind_result($user_id,$user_name, $user_email, $user_password);
    $stmt->store_result();
    if($stmt->num_rows==1){
      $stmt->fetch();
      $_SESSION['user_id']=$user_id;
      $_SESSION['user_name']=$user_name;
      $_SESSION['user_email']=$user_email;
      $_SESSION['logged_in']=true;
      header('location: taikhoan.php?message=Đăng nhập thành công!');
    }

  }else{
    header('location: dangnhap.php?error=Đăng nhập lỗi');
  }

}
?>
<?php include('layout/header.php'); ?>

<!--Đăng nhập-->
    <section class="my-5 pt-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Đăng nhập</h2>
        </div>
        <div class="mx-auto container">
            <form id="login-form" method="POST" action="dangnhap.php">
              <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Nhập email" required/>
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Nhập mật khẩu" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control" id="login-btn" name='login' value="Đăng nhập"/>
                </div>
                <div class="form-group">
                    <a id="register-url" class="btn" href="dangky.php">Bạn chưa có tài khoản? Đăng ký ngay!</a>
                </div>
            </form>
        </div>
    </section>





    <?php include('layout/footer.php'); ?>