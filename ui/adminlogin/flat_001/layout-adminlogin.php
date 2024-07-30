<!DOCTYPE html><?php include_once '../../../configs.php'; ?>
<!-- saved from url=(0086)http://s.codepen.io/boomerang/4e19cedecbe35e85fb3e7b982ce299781453894340049/index.html -->
<html class=" -webkit-"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script src="<?php echo URL_UI_ADMINLOGIN_THEMES;?>template_files/console_runner-19b53204114bb6697f7c32c3c848fd19.js"></script>
<meta charset="UTF-8">
<!-- tích hợp css và js của các thành phần giao diện cũ
	ví dụ: alert báo lỗi đăng nhập  cần css và js cũ 
-->
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

<meta name="robots" content="noindex"><link rel="canonical" href="http://codepen.io/lsgrrd/pen/xvwHn">

<script src="<?php echo URL_UI_ADMINLOGIN_THEMES;?>template_files/prefixfree.min.js"></script>
<style class="cp-pen-styles">@import url(http://weloveiconfonts.com/api/?family=entypo);
@import url(http://fonts.googleapis.com/css?family=Roboto);

/* zocial */
[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
}

*,
*:before,
*:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box; 
}


h2 {
  color:rgba(255,255,255,.8);
  margin-left:12px;
}

body {
  background: #272125;
  font-family: 'Roboto', sans-serif;
  
}

form {
  position:relative;
  margin: 50px auto;
  width: 380px;
  height: auto;
}

input {
  padding: 16px;
  border-radius:7px;
  border:0px;
  background: rgba(255,255,255,.2);
  display: block;
  margin: 15px;
  width: 300px;  
  color:white;
  font-size:18px;
  height: 54px;
}

input:focus {
  outline-color: rgba(0,0,0,0);
  background: rgba(255,255,255,.95);
  color: #e74c3c;
}

button {
  float:right;
  height: 121px;
  width: 50px;
  border: 0px;
  background: #e74c3c;
  border-radius:7px;
  padding: 10px;
  color:white;
  font-size:22px;
}

.inputUserIcon {
  position:absolute;
  top:68px;
  right: 80px;
  color:white;
}

.inputPassIcon {
  position:absolute;
  top:136px;
  right: 80px;
  color:white;
}

input::-webkit-input-placeholder {
  color: white;
}

input:focus::-webkit-input-placeholder {
  color: #e74c3c;
}
</style></head><body>
<form action="<?php echo urlAdminLogin(); ?>" method="post" enctype="multipart/form-data">
	
  <h2><span class="entypo-login"></span> Login</h2>
  <button class="submit"><span class="entypo-lock"></span></button>
  <span class="entypo-user inputUserIcon" style="color: white;"></span>
  <input name="username" value="<?php echo $_SESSION['FAILED_USERNAME'];?>" placeholder="Tên đăng nhập" type="text">
  <span class="entypo-key inputPassIcon" style="color: white;"></span>
  <input name="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>" placeholder="Mật khẩu" type="password">
  
  <?php if ($_SESSION["ERROR_TEXT"]) { ?>
	    <div class="alert alert-danger">
	    	<div style="float: left;">
	    		<i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
	    	</div>
	        <button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;height: 1em;margin: 0">&times;</button>
	        <br style="clear:both"/>
	    </div>
	<?php } $_SESSION["ERROR_TEXT"] = null; ?>
</form>
<h4 style="text-align: center;margin-top: 200px;">Copyright © <?php echo date('Y')?> <?php echo storeName() ;?>. All Rights Reserved.</h4>
<script src="<?php echo URL_UI_ADMINLOGIN_THEMES;?>template_files/stopExecutionOnTimeout.js"></script><script src="<?php echo URL_UI_ADMINLOGIN_THEMES;?>template_files/jquery.min.js"></script>
<script>
$('.user').focusin(function () {
    $('.inputUserIcon').css('color', '#e74c3c');
}).focusout(function () {
    $('.inputUserIcon').css('color', 'white');
});
$('.pass').focusin(function () {
    $('.inputPassIcon').css('color', '#e74c3c');
}).focusout(function () {
    $('.inputPassIcon').css('color', 'white');
});
//# sourceURL=pen.js
</script>
<script src="<?php echo URL_UI_ADMINLOGIN_THEMES;?>template_files/css_live_reload_init.js"></script>
</body></html>