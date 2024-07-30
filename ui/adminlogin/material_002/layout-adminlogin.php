<!DOCTYPE html><?php include_once '../../../configs.php'; ?>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/x-icon" href="https://bookion-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico">
  <link rel="mask-icon" type="" href="https://bookion-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111">
  <title><?php echo $web_title;?></title>
<link href="<?php echo urlIcon(); ?>" rel="icon">

<link href="<?php echo URL_UI;?>src/css/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet/less">
<!-- Đoạn mã này hay gây lỗi 
<link href="<?php echo URL_UI;?>src/js/admin/bootstrap/less/bootstrap.less" rel="stylesheet/less">

 -->
<link href="<?php echo URL_UI;?>src/css/bootstrap/normalize.css" rel="stylesheet/less" id="less:admin-view-javascript-bootstrap-less-bootstrap">
<link href="<?php echo URL_UI ?>src/css/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">

<script src="<?php echo URL_UI?>src/js/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo URL_UI?>src/css/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL_UI?>src/css/bootstrap/less-1.7.4.min.js"></script>
  
  
  
  
      <style>
      @import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
    </style>

  <script>
  window.console = window.console || function(t) {};
</script>

  
  
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>

</head>

<body translate="no">

  <div class="login-page">
  <div class="form">
    <form class="register-form">
      <input placeholder="name" type="text">
      <input placeholder="password" type="password">
      <input placeholder="email address" type="text">
      <button>create</button>
      <p class="message">Already registered? <a rel="nofollow" href="#">Sign In</a></p>
    </form>
    <form action="<?php echo urlAdminLogin(); ?>" method="post" enctype="multipart/form-data">
    	<h3>Admin Login Form</h3>
                <?php if ($_SESSION["ERROR_TEXT"]) { ?>
                    <div class="alert alert-danger"><!-- Dùng biện pháp tinh chỉnh khi bê các thành phần giao diện từ thiết kế cũ sang thiết kế mới -->
                        <div style="float: left;">
                            <i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;margin: 0">&times;</button>
                        <br style="clear:both"/>
                    </div>
                <?php } $_SESSION["ERROR_TEXT"] = null; ?>
      <input name="username" placeholder="Tên đăng nhập" type="text">
      <input name="password" placeholder="Mật khẩu" type="password">
      <button>Đăng Nhập</button>
      <!-- <p class="message">Not registered? <a rel="nofollow" href="#">Create an account</a></p> -->
      
    </form>
  </div>
</div>
    <script src="<?php URL_UI_ADMINLOGIN_THEMES;?>template_files/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26.js"></script>

  <script src="<?php URL_UI_ADMINLOGIN_THEMES;?>template_files/jquery.js"></script>

    <script>
    $('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
  //# sourceURL=pen.js
  </script>

  
  



 </body></html>