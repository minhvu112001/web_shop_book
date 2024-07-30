<!DOCTYPE html><?php include_once '../../../configs.php'; ?>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  
  <title><?php echo $web_title;?></title>
<link href="<?php echo urlIcon(); ?>" rel="icon">

<link href="<?php echo URL_UI;?>src/css/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet/less">
<script src="<?php echo URL_UI?>/src/js/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo URL_UI?>/src/css/bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>

  
  <link rel="stylesheet" href="<?php echo URL_UI_ADMINLOGIN_THEMES;?>layout-adminlogin_files/css/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <form action="<?php echo urlAdminLogin(); ?>" method="post" enctype="multipart/form-data" class="login">
  
    <p>
      <label for="login">Username:</label>
      <input type="text" name="username" placeholder="Tên đăng nhập" id="login" value="<?php echo $_SESSION['FAILED_USERNAME'];?>">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" placeholder="Mật khẩu" id="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>">
    </p>

    <p class="login-submit">
      <button type="submit" class="login-button">Login</button>
    </p>

    <!-- <p class="forgot-password"><a href="layout-adminlogin.html">Forgot your password?</a></p> -->
    <?php if ($_SESSION["ERROR_TEXT"]) { ?>
	    <div class="alert alert-danger">
	    	<div style="float: left;">
	    		<i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
	    	</div>
	        <button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;margin: 0;text-align:center;padding: 0 0.1em;">&times;</button>
	        <br style="clear:both"/>
	    </div>
	<?php } $_SESSION["ERROR_TEXT"] = null; ?>
  </form>

  <section class="about">
    <!--
    <p class="about-links">
      <a href="#" target="_parent">View Article</a>
      <a href="#" target="_parent">Download</a>
    </p>
    -->
    <p class="about-author">
      Copyright © <?php echo date('Y')?> <?php echo storeName() ;?>. All Rights Reserved.
      <!--
      Original PSD by <a href="http://365psd.com/day/2-234/" target="_blank">Rich McNabb</a>
      -->
  </section>
</body>
</html>
