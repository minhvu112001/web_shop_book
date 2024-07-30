<!DOCTYPE html><?php include_once '../../../configs.php'; ?>
<!-- saved from url=(0086)http://s.codepen.io/boomerang/84700bf57044c949a2310159603de28d1453902011320/index.html -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $web_title; ?></title>

<meta charset="UTF-8"><meta name="robots" content="noindex"><link rel="canonical" href="http://codepen.io/edbond88/pen/yGjAu">
<link href="<?php echo URL_UI_ADMINLOGIN_THEMES;?>layout-adminlogin_files/css" rel="stylesheet" type="text/css">
<link rel="stylesheet prefetch" href="http://codepen.io/assets/reset/normalize.css">


</script>
<style class="cp-pen-styles">* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

html {
  background: #E2E2E2;
}

body {
  background: #E2E2E2;
  margin: 0;
  padding: 0;
  font-family: 'Lato', sans-serif;
}

.login-form-wrap {
  background: #5170ad;
  background: -moz-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #5170ad), color-stop(100%, #355493));
  background: -webkit-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: -o-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: -ms-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: radial-gradient(ellipse at center, #5170ad 0%, #355493 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5170ad', endColorstr='#355493',GradientType=1 );
  border: 1px solid #2d416d;
  box-shadow: 0 1px #5670A4 inset, 0 0 10px 5px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  position: relative;
  width: 360px;
  height: 380px;
  margin: 60px auto;
  padding: 50px 30px 0 30px;
  text-align: center;
}
.login-form-wrap:before {
  background: url(0vLxyVB.png);
  display: block;
  content: '';
  width: 58px;
  height: 19px;
  top: 10px;
  left: 10px;
  position: absolute;
}
.login-form-wrap > h1 {
  margin: 0 0 50px 0;
  padding: 0;
  font-size: 26px;
  color: #fff;
}
.login-form-wrap > h5 {
  margin-top: 40px;
}
.login-form-wrap > h5 > a {
  font-size: 14px;
  color: #fff;
  text-decoration: none;
  font-weight: 400;
}

.login-form input[type="text"], .login-form input[type="password"] {
  width: 100%;
  border: 1px solid #314d89;
  outline: none;
  padding: 12px 20px;
  color: #afafaf;
  font-weight: 400;
  font-family: 'Lato', sans-serif;
  cursor: pointer;
}
.login-form input[type="text"] {
  border-bottom: none;
  border-radius: 4px 4px 0 0;
  padding-bottom: 13px;
  box-shadow: 0 -1px 0 #E0E0E0 inset, 0 1px 2px rgba(0, 0, 0, 0.23) inset;
}
.login-form input[type="password"] {
  border-top: none;
  border-radius: 0 0 4px 4px;
  box-shadow: 0 -1px 2px rgba(0, 0, 0, 0.23) inset, 0 1px 2px rgba(255, 255, 255, 0.1);
}
.login-form input[type="submit"] {
  font-family: 'Lato', sans-serif;
  font-weight: 400;
  background: #e0e0e0;
  background: -moz-linear-gradient(top, #e0e0e0 0%, #cecece 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #e0e0e0), color-stop(100%, #cecece));
  background: -webkit-linear-gradient(top, #e0e0e0 0%, #cecece 100%);
  background: -o-linear-gradient(top, #e0e0e0 0%, #cecece 100%);
  background: -ms-linear-gradient(top, #e0e0e0 0%, #cecece 100%);
  background: linear-gradient(to bottom, #e0e0e0 0%, #cecece 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e0e0e0', endColorstr='#cecece',GradientType=0 );
  display: block;
  margin: 20px auto 0 auto;
  width: 100%;
  border: none;
  border-radius: 3px;
  padding: 8px;
  font-size: 17px;
  color: #636363;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.45);
  font-weight: 700;
  box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.17), 0 1px 0 rgba(255, 255, 255, 0.36) inset;
}
.login-form input[type="submit"]:hover {
  background: #DDD;
}
.login-form input[type="submit"]:active {
  padding-top: 9px;
  padding-bottom: 7px;
  background: #C9C9C9;
}

 .alert-danger {
    background-color: #fef1f1;
    border-color: #fcd9df;
    color: #f56b6b;
}
  .alert {
    padding: 10px;
    margin-bottom: 17px;
    border: 1px solid transparent;
    border-radius: 3px;
}
</style>

</head><body>
<section class="login-form-wrap">
  <h1>Admin Login Form</h1>
  <form id="target" class="login-form" action="<?php echo urlAdminLogin(); ?>" method="post" enctype="multipart/form-data">
  <?php if ($_SESSION["ERROR_TEXT"]) { ?>
	    <div class="alert alert-danger">
	    	<div style="float: left;">
	    		<i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
	    	</div>
	        <button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;margin: 0">&times;</button>
	        <br style="clear:both"/>
	    </div>
	<?php } $_SESSION["ERROR_TEXT"] = null; ?>
    <label>
      <input type="text" name="username" required="" placeholder="Username" value="<?php echo $_SESSION['FAILED_USERNAME'];?>">
    </label>
    <label>
      <input type="password" name="password" required="" placeholder="Password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>">
    </label>
    <input type="submit" value="Đăng Nhập">
  </form>
  <!-- <h5><a href="#">Forgot password</a></h5> -->
</section>


</body></html>