<!DOCTYPE html><?php include_once '../../../configs.php'; ?>
<!-- saved from url=(0086)http://s.codepen.io/boomerang/6c01873d72d9ff7f5093c565601975d41453896505469/index.html -->
<html class=""><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script src="<?php echo URL_UI_ADMINLOGIN_THEMES;?>layout-adminlogin_files/console_runner-19b53204114bb6697f7c32c3c848fd19.js"></script>
<meta charset="UTF-8">
<meta name="robots" content="noindex"><link rel="canonical" href="http://codepen.io/berdejitendra/pen/KxmvD">
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
<style class="cp-pen-styles">*
{
margin:0px;
padding:0px;
}
  
body{
background:#222526;
position:relative;
padding:20px;
font-family:verdana;
} 
                                
#loginform
{
width:550px;
height:auto;
position:relative;
margin:0 auto;
}

input
{
display:block;
margin:0px auto 15px;
border-radius:5px;
background: #333333;
width:85%;
padding:12px 20px 12px 10px;
border:none;
color:#929999;                       
box-shadow:inset 0px 1px 5px #272727;
font-size:0.8em;
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease; 
}

input:focus
{
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease;  
box-shadow: 0px 0px 5px 1px #161718;
}

button
{
background: #ff5f32;
border-radius:50%;
border:10px solid #222526;
font-size:0.9em;
color:#fff;
font-weight:bold;
cursor:pointer;
width:85px;
height:85px;
position:absolute;
right: -42px;
top: 54px;
text-align:center;
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease;
}

button:hover
{
background:#222526;
border-color:#ff5f32;
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease;
}

button i
{
font-size:20px;
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease;
}

button:hover i
{
color:#ff5f32;
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease;
}
  
*:focus{outline:none;}
::-webkit-input-placeholder {
color:#929999;
}

:-moz-placeholder { /* Firefox 18- */
color:#929999; 
}

::-moz-placeholder {  /* Firefox 19+ */
color:#929999;  
}

:-ms-input-placeholder {  
color:#929999; 
}

h1
{
text-align:center;
color:#fff;
font-size:13px;
padding:12px 0px;
}

#note
{
color:#88887a;
font-size: 0.8em;
text-align:left;
padding-left:5px;
}

#facebook
{
text-align:center;
float:left;
background:#365195;
padding:35px 10px 20px 10px;
width:170px;
height:250px; 
border-radius:3px;
cursor:pointer;
box-shadow: 0px 0px 10px 2px #161718; 
margin-right:10px;
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease;
}

#facebook:hover
{
box-shadow: 0px 0px 0px 0px #161718;
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease;
}

.fa-facebook
{
color:#fff;
font-size:7em;
display:block;
}

a
{
color:#88887a;
text-decoration:none;
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease;
}

a:hover
{
color:#fff;
margin-left:5px;
-webkit-transition:0.5s ease;
-moz-transition:0.5s ease;
-o-transition:0.5s ease;
-ms-transition:0.5s ease;
transition:0.5s ease;
}

#mainlogin
{
float:left;
width:250px;
height:250px;
padding:10px 15px;
position:relative;
background:#555555;
border-radius:3px;
}

#connect
{
font-weight: bold;
color: #fff;
font-size: 13px;
text-align: left;
font-family: verdana;
padding-top:10px;
}

#or
{
position:absolute;
left: -25px;
top: 10px;
background:#222222;
text-shadow:0 2px 0px #121212;
color:#999999;
width:40px;
height:40px;
text-align:center;
border-radius:50%;
font-weight:bold;
line-height:38px;
font-size: 13px;
}
</style></head><body>
<div id="loginform">
	<!-- 
	<div id="facebook">
    	<i class="fa fa-facebook"></i>
        <div id="connect">Connect with Facebook</div>
    </div>
	 -->
	<div id="mainlogin">
		<!-- <div id="or">or</div> -->
		
		<h1>Admin Login Form</h1>
        <form action="<?php echo urlAdminLogin(); ?>" method="post" enctype="multipart/form-data">
        <input name="username" value="<?php echo $_SESSION['FAILED_USERNAME'];?>" placeholder="Tên đăng nhập" type="text">
        <input name="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>" placeholder="Mật khẩu" type="password">
        <button type="submit"><i class="fa fa-arrow-right"></i></button>
        </form>
        
		<!-- <div id="note"><a href="#">Copyright © <?php echo date('Y')?> <?php echo storeName() ;?>.<br> All Rights Reserved.</a></div> -->
        
        <?php if ($_SESSION["ERROR_TEXT"]) { ?>
	    <div class="alert alert-danger">
	    	<div style="float: left;">
	    		<i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
	    	</div>
            <!--
	        <button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;margin: 0">&times;</button>
            -->
	        <br style="clear:both"/>
	    </div>
	<?php } $_SESSION["ERROR_TEXT"] = null; ?>
	</div>
    
</div>
<br>
<div><a href="#">Copyright © <?php echo date('Y')?> <?php echo storeName() ;?>.<br> All Rights Reserved.</a></div>

<script src="./layout-adminlogin_files/css_live_reload_init.js"></script>
</body></html>