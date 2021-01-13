<?php 
if(isset($_SESSION['user'])){
    header('location:index.php');
}
if(isset($_COOKIE['register'])){
    ?>
    <script>alert("<?php echo $_COOKIE['register'].' Đã đăng kí tài khoản thành công mời đăng nhập!!!'?>")</script>
    <?php
}
require 'layout/autoload.php';
if(isset($_POST['login'])){
    $username = $_POST['user'];
    $pass = $_POST['pass'];
    $user = new User();
    $getuser = $user->getUserByUsername($username);
    // var_dump($getuser);
    foreach ($getuser as $key => $value) {
        $pass_hash = $value['password'];
    }
    if(count($getuser) > 0){
        session_start();
        if(password_verify($pass,$pass_hash)){
            $_SESSION['user'] = $username;
            header('location:index.php');
        }else{
            $error_password = "Sai Mật Khẩu.";
        }
    }else{
        $error_username = "Sai Tên Đăng Nhập";
    }
}
require 'layout/header.php';
?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div class="san-pham">
    <center><span>LOGIN</span></center>  
</div>
        <form action="" method="post">
            <label>Username: </label>
            <input placeholder="Nhập username ..." required class="form-control" type="text" name="user">
            <div class="error">
                <?php if(isset($error_username)) echo $error_username ?>
            </div>
            <label>Password: </label>
            <input placeholder="Nhập password ..." required class="form-control" type="password" name="pass">
            <div class="error">
                <?php if(isset($error_password)) echo $error_password ?>
            </div><br>
            <input type="checkbox" name="remember"> Remember <br> <br>
            <center><input class="btn btn-info" type="submit" name="login" value="Đăng Nhập"></center>
        </form>
    </div>
</div>
<?php
require 'layout/close.php';
require 'layout/footer.php';
?>
