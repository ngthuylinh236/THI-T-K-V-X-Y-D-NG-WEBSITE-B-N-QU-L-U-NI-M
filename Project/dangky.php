<?php
session_start();
include('server/connection.php');
if(isset($_POST['register'])){
  $name= $_POST['name'];
  $email= $_POST['email'];
  $password= $_POST['password'];
  $confirmpassword= $_POST['confirmpassword'];
  
  if($password !== $confirmpassword){
    header('location:dangky.php?error= Mật khẩu không khớp ');
  }
  else if (strlen($password)<6){
    header('location:dangky.php?error= Mật khẩu phải chứa ít nhất 6 kí tự');
  }else{
//Check xem có tài khoảm chưa
        $stmt1= $conn->prepare("SELECT count(*) FROM users where user_email=?");
        $stmt1->bind_param('s',$email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->fetch();
        $stmt1->close(); // Đóng statement sau khi sử dụng
        if ($num_rows != 0){
          header('location: dangky.php?error= Tài khoản đã tồn tại!');
        }else{
              $stmt=$conn->prepare("INSERT INTO users(user_name, user_email, user_password) VALUES (?,?,?)");
              $stmt -> bind_param('sss',$name, $email, md5($password));
              if($stmt->execute()){
                  $user_id=$stmt->insert_id;
                  $_SESSION['user_id']=$user_id;
                  $_SESSION['user_email']=$email;
                  $_SESSION['user_name']=$name;
                  $_SESSION['logged_in']=true;
                  header('location: dangky.php?error=Đăng ký thành công!');
              }
        }  
      }
    }else if(isset($_SESSION['logged_in'])){
      header('location:taikhoan.php');
      exit;

    }
?>
<?php include('layout/header.php'); ?>

<!--Đăng ký-->
    <section class="my-5 pt-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Đăng ký</h2>
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="dangky.php">
              <p style="color:red;"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                <div class="form-group">
                    <label>Họ tên</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Nhập tên" required/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Nhập email" required/>
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Nhập mật khẩu" required/>
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="register-confirmpassword" name="confirmpassword" placeholder="Nhập lại mật khẩu" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control" id="register-btn" name="register" value="Đăng ký"/>
                </div>
                <div class="form-group">
                    <a id="login-url" href ='dangnhap.php' class="btn">Bạn đã có tài khoản. Đăng nhập ngay!</a>
                </div>
            </form>
        </div>
    </section>




    <?php include('layout/footer.php'); ?>