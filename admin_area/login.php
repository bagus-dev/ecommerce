<?php
    session_start();
    include("includes/db.php");
    $admin_email = "";
    $admin_pass = "";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Store Admin Area</title>
    <link rel = "stylesheet" href = "css/bootstrap-337.min.css">
    <link rel = "stylesheet" href = "font-awesome/css/font-awesome.min.css">
    <link rel = "stylesheet" href = "css/style.css">
    <link rel = "stylesheet" href = "css/login.css">
    <link rel = "icon" type = "image/png" href = "../images/ecom-store-logo.png">
</head>
<body>
    <div class="container"><!-- container Begin -->
        <form action="" class="form-login" method = "post"><!-- form-login Begin -->
            <h2 class = "form-login-heading"> Admin Login </h2>
            <input type="text" class="form-control" placeholder = "Alamat Email" name = "admin_email" required>
            <input type = "password" class = "form-control" placeholder = "Kata Sandi Anda" name = "admin_pass" required>
            <button type = "submit" class="btn btn-lg btn-primary btn-block" name = "admin_login"><!-- btn btn-lg btn-primary btn-block Begin -->
                Login
            </button><!-- btn btn-lg btn-primary btn-block Finish -->
        </form><!-- form-login Finish -->
    </div><!-- container Finish -->
</body>
</html>
<?php
    if(isset($_POST["admin_login"])){
        $pesan_error = "";
        $admin_email = htmlentities(strip_tags(trim($_POST["admin_email"])));
        if(empty($admin_email)){
            $pesan_error = "Alamat Email Belum Diisi.";
            echo "<script>alert('$pesan_error')</script>";
        }
        $admin_pass = htmlentities(strip_tags(trim($_POST["admin_pass"])));
        if(empty($admin_pass)){
            $pesan_error = "Kata Sandi Belum Diisi.";
            echo "<script>alert('$pesan_error')</script>";
        }
        if($pesan_error == ""){
            $admin_email = mysqli_real_escape_string($con,$admin_email);
            $admin_pass = mysqli_real_escape_string($con,$admin_pass);
            $admin_pass_sha1 = sha1($admin_pass);
        
            $get_admin = "SELECT * FROM admins WHERE admin_email = '$admin_email' AND admin_pass = '$admin_pass_sha1'";
            $run_admin = mysqli_query($con,$get_admin);

            if(mysqli_num_rows($run_admin) >= 1){
                session_start();
                $_SESSION["admin_email"] = $admin_email;
                header("Location: index.php?dashboard");
                echo "<script>alert('Selamat Datang Kembali')</script>";
            }
            else{
                echo "<script>alert('Email atau Kata Sandi salah !')</script>";
            }
        }
    }
?>