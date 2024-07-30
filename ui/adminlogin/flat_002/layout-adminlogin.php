<!DOCTYPE HTML><?php include_once '../../../configs.php'; ?>
<!-- saved from url=(0047)http://p.w3layouts.com/demos/entrar_shadow/web/ -->
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<HTML><HEAD><META 
content="IE=11.0000" http-equiv="X-UA-Compatible">
	 	 
<META charset="utf-8">		 
<!-- tích hợp css và js của các thành phần giao diện cũ
			 ví dụ: alert báo lỗi đăng nhập  cần css và js cũ 
		-->
<title><?php echo $web_title;?></title>
<link href="<?php echo systemIcon(); ?>" rel="icon">
<LINK href="<?php echo URL_UI_ADMINLOGIN_THEMES;?>template_files/style.css" rel="stylesheet" 
type="text/css">		 
<META name="viewport" content="width=device-width, initial-scale=1">		 
<SCRIPT type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </SCRIPT>
		 <!--webfonts-->		 <LINK href="<?php echo URL_UI_ADMINLOGIN_THEMES;?>template_files/css.css" rel="stylesheet" 
type="text/css">		 <!--//webfonts--> 
<META name="GENERATOR" content="MSHTML 11.00.9600.16412"></HEAD> 
<BODY>
<SCRIPT>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-30027142-1', 'w3layouts.com');
  ga('send', 'pageview');
</SCRIPT>
 
<SCRIPT id="_fancybar_js" src="<?php echo URL_UI_ADMINLOGIN_THEMES;?>template_files/fancybar.js" type="text/javascript" async></SCRIPT>
	  <!-----start-main---->	  
<DIV class="main"><!---728x90---> 
<DIV style="text-align: center;">


</DIV>
<DIV class="login-form">
<H1>Member Login</H1>
<DIV class="head"><IMG alt="" src="<?php echo URL_UI_ADMINLOGIN_THEMES;?>template_files/user.png">
					 </DIV>
<form action="<?php echo urlAdminLogin(); ?>" method="post" enctype="multipart/form-data">
<INPUT name="username" class="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'USERNAME';}" type="text" value="<?php echo $_SESSION['FAILED_USERNAME'];?>">
						 <INPUT name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" type="password" value="<?php echo $_SESSION['FAILED_PASSWORD'];?>">
						 
<DIV class="submit"><INPUT onclick="myFunction()" type="submit" value="LOGIN">
					 </DIV>
<P><A href="#">Forgot Password 
?</A></P>
<?php if ($_SESSION["ERROR_TEXT"]) { ?>
	    <div class="alert alert-danger">
	    	<div style="float: left;">
	    		<i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION["ERROR_TEXT"]; ?>
	    	</div>
	        <button type="button" class="close" data-dismiss="alert" style="float: right;display: block;width: 1em;margin: 0">&times;</button>
	        <br style="clear:both"/>
	    </div>
	<?php } $_SESSION["ERROR_TEXT"] = null; ?>
</FORM></DIV><!--//End-login-form-->			 <!---728x90---> 
<DIV style="text-align: center;">

</DIV><!-----start-copyright---->   					 
<DIV class="copy-right">
<P><h4 style="text-align: center;margin-top: 200px;">Copyright © <?php echo date('Y')?> <?php echo storeName() ;?>. All Rights Reserved.</h4></P></DIV><!-----//end-copyright---->
		 </DIV><!---728x90---> 
<DIV style="text-align: center;">

 
</DIV><!-----//end-main---->		 		 </BODY></HTML>
