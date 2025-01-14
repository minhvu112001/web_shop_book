﻿<!DOCTYPE HTML><?php include_once '../../../configs.php'; ?>
<!-- saved from url=(0026)https://demo.opencart.com/ -->
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<HTML lang="en" dir="ltr"><!-- HTML Design Template: https://demo.opencart.com -->
<!--<![endif]-->

<HEAD>
    <META content="IE=11.0000" http-equiv="X-UA-Compatible">

    <META charset="UTF-8">
    <META name="viewport" content="width=device-width, initial-scale=1">
    <TITLE><?php echo $web_title;?></TITLE>
    <!-- <LINK href="https://demo.opencart.com/image/catalog/cart.png" rel="icon"> -->
    <LINK href="<?php echo storeIcon();?>" rel="icon">
	<?php include_once DIR_UI."common-head-layout-home.php"?>
    <META name="description" content="The OpenCart demo store">
    <META name="keywords" content="opencart,demo,store,ecommerce">
    <META http-equiv="X-UA-Compatible" content="IE=edge">
    
    
    <LINK href="<?php echo URL_UI_HOME_THEMES ?>template_files/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
    <LINK href="<?php echo URL_UI_HOME_THEMES ?>template_files/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen">
    <LINK href="<?php echo URL_UI_HOME_THEMES ?>template_files/css.css" rel="stylesheet" rel="stylesheet" type="text/css" media="screen">
    <LINK href="<?php echo URL_UI_HOME_THEMES ?>template_files/stylesheet.css" rel="stylesheet" type="text/css" media="screen">
    <LINK href="<?php echo URL_UI_HOME_THEMES ?>template_files/flexslider.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo URL_UI ?>src/js/jquery/plugins/magnific/magnific-popup.css" rel="stylesheet" type="text/css" media="screen">
	<link href="<?php echo URL_UI ?>src/js/jquery/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" media="screen">
	<link href="<?php echo URL_UI ?>src/js/jquery/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" media="screen">
    
    <SCRIPT src="<?php echo URL_UI_HOME_THEMES ?>template_files/jquery-2.1.1.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="<?php echo URL_UI_HOME_THEMES ?>template_files/bootstrap.min.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="<?php echo URL_UI_HOME_THEMES ?>template_files/common.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="<?php echo URL_UI_HOME_THEMES ?>view/class.cart.js" type="text/javascript"></SCRIPT>
    <SCRIPT src="<?php echo URL_UI_HOME_THEMES ?>template_files/jquery.flexslider-min.js" type="text/javascript"></SCRIPT>
	<script src="<?php echo URL_UI?>src/js/jquery/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
	<!-- thư viện javascript cho xem slide ảnh chi tiết sản phẩm: -->
	<script src="<?php echo URL_UI?>src/js/jquery/plugins/magnific/jquery.magnific-popup.min.js" type="text/javascript"></script>
	
	<!-- 
	THƯ VIỆN Google Map 
	@see http://tilotiti.github.io/jQuery-Google-Map/
	@see http://static.livedemo00.template-help.com/opencart_53398/catalog/view/theme/theme532/js/jquery.rd-google-map.js
	-->
	
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
	<!-- Nếu thiếu key sẽ bị lỗi ở một số tình huống -->
	<!-- 
	<script type="text/javascript">
	    google.load("maps", "3.4", {
	    	other_params: "key= AIzaSyBfMWzk7lWu-vuy2iBVkUpdBKS6ZnxPjjU&sensor=false&language=en"
	    });
	</script>
	 -->
	
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBfMWzk7lWu-vuy2iBVkUpdBKS6ZnxPjjU&sensor=false"></script>
	<script type="text/javascript" src="<?php echo URL_UI?>src/js/jquery/plugins/google/jquery.googlemap.js"></script>
	
    <META name="GENERATOR" content="MSHTML 11.00.9600.16384">
</HEAD>

<BODY class="common-home">
    <NAV id="top">
        <DIV class="container">
            <!-- 
            <DIV class="pull-left">
                <FORM id="currency" action="https://demo.opencart.com/index.php?route=common/currency/currency" enctype="multipart/form-data" method="post">
                     <DIV class="btn-group">
                        <BUTTON class="btn btn-link dropdown-toggle" data-toggle="dropdown"><STRONG>$</STRONG> 
<SPAN class="hidden-xs hidden-sm hidden-md">Currency</SPAN> <I class="fa fa-caret-down"></I></BUTTON>
                        <UL class="dropdown-menu">
                            <LI>
                                <BUTTON name="EUR" class="currency-select btn btn-link btn-block" type="button">€ 
  Euro</BUTTON>
                            </LI>
                            <LI>
                                <BUTTON name="GBP" class="currency-select btn btn-link btn-block" type="button">£ 
  Pound Sterling</BUTTON>
                            </LI>
                            <LI>
                                <BUTTON name="USD" class="currency-select btn btn-link btn-block" type="button">$ 
  US Dollar</BUTTON>
                            </LI>
                        </UL>
                    </DIV>
                    <INPUT name="code" type="hidden">
                    <INPUT name="redirect" type="hidden" value="https://demo.opencart.com/index.php?route=common/home">
                </FORM>
            </DIV>
             -->
            <DIV class="nav pull-right" id="top-links">
                <UL class="list-inline">
                    <LI>
                        <A href="https://demo.opencart.com/index.php?route=information/contact"><I 
  class="fa fa-phone"></I></A>
                        <SPAN class="hidden-xs hidden-sm hidden-md"><?php echo storeTelephone(); ?></SPAN>
                    </LI>
                    <LI class="dropdown">
                        <?php if (isset ($_SESSION['CUS_LOGGED'])) { ?>
                        <A title="My Account" class="dropdown-toggle" href="<?php echo urlAccount(); ?>" data-toggle="dropdown">
                        	<I class="fa fa-user"></I> <SPAN class="hidden-xs hidden-sm hidden-md"><?php echo $_SESSION['CUS_FULLNAME'] ?></SPAN> <SPAN class="caret"></SPAN>
                        </A>
                        <UL class="dropdown-menu dropdown-menu-right">
                            <li>
                            	<a href="<?php echo urlOrderHistory();?>"><i class="fa fa-list"></i>&nbsp;Lịch Sử Đơn Hàng</a>
                            </li>
                            <li><a href="<?php echo urlLogout();?>"><i class="fa fa-sign-out"></i>&nbsp;Đăng Thoát</a></li>
                        </UL>
                        <?php } else {?>
                        <A title="My Account" class="dropdown-toggle" href="<?php echo urlAccount(); ?>" data-toggle="dropdown"><I class="fa fa-user"></I> <SPAN class="hidden-xs hidden-sm hidden-md">Tài Khoản</SPAN> <SPAN class="caret"></SPAN></A>
                        <UL class="dropdown-menu dropdown-menu-right">
                            <LI>
                                <A href="<?php echo urlRegister(); ?>"><i class="fa fa-user"></i>&nbsp;Đăng Kí</A>
                            </LI>
                            <LI>
                                <A href="<?php echo urlLogin(); ?>"><i class="fa fa-lock"></i>&nbsp;Đăng Nhập</A>
                            </LI>
                        </UL>                        
                        <?php } ?>
                    </LI>
                    
                    
                    
                    
                    <!-- 
                    <LI>
                        <A title="Wish List (0)" id="wishlist-total" href="#"><I class="fa fa-heart"></I> <SPAN class="hidden-xs hidden-sm hidden-md">Wish List (0)</SPAN></A>
                    </LI>
                     -->
                    <LI>
                        <A title="Shopping Cart" href="<?php echo urlShoppingCart(); ?>"><I class="fa fa-shopping-cart"></I> <SPAN class="hidden-xs hidden-sm hidden-md">Giỏ Hàng</SPAN></A>
                    </LI>
                    <LI>
                        <A title="Checkout" href="<?php echo urlCheckout(); ?>"><I 
  class="fa fa-share"></I> <SPAN 
  class="hidden-xs hidden-sm hidden-md">Thanh Toán</SPAN></A>
                    </LI>
                </UL>
            </DIV>
        </DIV>
    </NAV>
    <HEADER>
        <DIV class="container">
            <DIV class="row">
                <DIV class="col-sm-4">
                    <DIV id="logo">
                        <A href="<?php echo urlHome(); ?>">
                            <IMG height="64" width="64" title="<?php echo storeName(); ?>" class="img-responsive" alt="<?php echo storeName(); ?>" src="<?php echo storeLogo(); ?>">
                        </A>
                    </DIV>
                </DIV>
                <DIV class="col-sm-5">
                    <DIV class="input-group" id="search">
                        <INPUT name="search" class="form-control input-lg" type="text" placeholder="Search" value="">
                        <SPAN class="input-group-btn"><BUTTON class="btn btn-default btn-lg" type="button"><I 
class="fa fa-search"></I></BUTTON> </SPAN> </DIV>
                </DIV>
                <DIV class="col-sm-3">
                    <?php include_once "view/view-cart.php";?>
                </DIV>
            </DIV>
        </DIV>
    </HEADER>
    <DIV class="container">
        <NAV class="navbar" id="menu">
            <DIV class="navbar-header">
                <SPAN class="visible-xs" id="category">Danh Mục</SPAN>
                <BUTTON class="btn btn-navbar navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-ex1-collapse"><I 
class="fa fa-bars"></I></BUTTON> </DIV>
            <DIV class="collapse navbar-collapse navbar-ex1-collapse">
            	<ul class="nav navbar-nav">
			      <?php foreach (categoryGetAllForMenuHomePage() as $category) { ?>
			        <?php if ($category['children']) { ?>
			        <li class="dropdown">
			          <a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?>&nbsp;<i class="fa fa-angle-down"></i></a>
			          <div class="dropdown-menu">
			            <div class="dropdown-inner">
			              <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
			              <ul class="list-unstyled">
			                <?php foreach ($children as $child) { ?>
			                <li>
			                	<a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
			                	<!-- 
			                	<div class="dropdown-menu">
						            <div class="dropdown-inner">
						              <?php //foreach (array_chunk($child['children'], ceil(count($child['children']) / $child['column'])) as $children2) { ?>
						              <ul class="list-unstyled">
						                <?php //foreach ($children2 as $child2) { ?>
						                <li>
						                	<a href="<?php //echo $child2['href']; ?>"><?php //echo $child2['name']; ?></a>
						                </li>
						                <?php //} ?>
						              </ul>
						              <?php //} ?>
						            </div>
						            <a href="<?php //echo $child['href']; ?>" class="see-all">Xem tất <?php //echo $child['name']; ?></a> 
						        </div>
			                	 -->
			                </li>
			                <?php } ?>
			              </ul>
			              <?php } ?>
			            </div>
			            <a href="<?php echo $category['href']; ?>" class="see-all">Xem tất <?php echo $category['name']; ?></a> 
			          </div>
			        </li>
			        <?php } else { ?>
			        <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
			        <?php } ?>
			      <?php } ?>
			      </ul>
            </DIV>
        </NAV>
    </DIV>
    
    <!-- web content, web_content, ruột -->
    <?php include_once $web_content ; ?>
    
    
    <footer>
  <div class="container">
    <div class="row">
            <div class="col-sm-3">
        <h5>Thông Tin</h5>
        <ul class="list-unstyled">
                    <li><a href="#4">Giới Thiệu</a></li>
                    <li><a href="#6">Thông Tin Giao Hàng</a></li><!-- Delivery Information -->
                    <li><a href="#3">Chính Sách Quyền Riêng Tư</a></li>
                    <li><a href="#5">Điều Khoản Sử Dụng</a></li>
                  </ul>
      </div>
            <div class="col-sm-3">
        <h5>Dịch Vụ Khách Hàng</h5>
        <ul class="list-unstyled">
          <li><a href="#">Liên Hệ</a></li>
          <li><a href="#">Quy Định Đổi Trả Hàng</a></li><!-- Return & Exchange Policy -->
          <li><a href="#">Bản Đồ Site</a></li>
        </ul>
      </div>
      <div class="col-sm-3">
        <h5>Thông Tin Thêm</h5>
        <ul class="list-unstyled">
          <li><a href="#">Thương Hiệu</a></li>
          <li><a href="#">Phiếu Quà Tặng</a></li><!-- Gift Vouchers -->
          <li><a href="#">Tiếp Thị Liên Kết</a></li><!-- Affiliates -->
          <li><a href="#">Sản Phẩm Đặc Biệt</a></li>
        </ul>
      </div>
      <div class="col-sm-3">
        <h5>Tài Khoản</h5>
        <ul class="list-unstyled">
          <li><a href="#">Tài Khoản Của Tôi</a></li>
          <li><a href="#">Lịch Sử Đơn Hàng</a></li>
          <li><a href="#">Wish List</a></li>
          <li><a href="#">Thư Thông Báo</a></li><!-- Newsletter -->
        </ul>
      </div>
    </div>
    <hr>
    <p>Copyright © <?php echo date('Y')?> <?php echo storeName() ;?>. All Rights Reserved.</p> 
  </div>
</footer>
</BODY>

</HTML>