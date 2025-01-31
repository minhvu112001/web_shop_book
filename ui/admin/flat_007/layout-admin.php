<!DOCTYPE html><?php '../../../configs.php'; ?>
<html><!-- orginal design: http://juanproject.org/myxdashboard/profile.html -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $web_title;?></title>
  <link href="<?php echo urlIcon(); ?>" rel="icon">
  <?php include_once DIR_UI."common-head-layout-admin.php";?>
  
    <!-- bootstrap -->
    <style>.file-input-wrapper { overflow: hidden; position: relative; cursor: pointer; z-index: 1; }.file-input-wrapper input[type=file], .file-input-wrapper input[type=file]:focus, .file-input-wrapper input[type=file]:hover { position: absolute; top: 0; left: 0; cursor: pointer; opacity: 0; filter: alpha(opacity=0); z-index: 99; outline: 0; }.file-input-name { margin-left: 8px; }</style><link href="layout-admin_files/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/bootstrap-overrides.css" type="text/css" rel="stylesheet">

    <!-- theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/default.css">

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/dashboard.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/notify.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/bootstrap_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/pizza.css">



    <!-- open sans font -->
    <link href="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/css.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
      <script src="js/html5.js"></script>
    <![endif]-->

<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>
<body class="">

    <!-- navbar -->
    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" id="menu-toggler">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://juanproject.org/myxdashboard/index.html">
            	<img src="<?php echo urlImgStoreLogo(); ?>" width="32" height="32" alt="logo">
            </a>
        </div>

        <ul class="nav navbar-nav pull-right hidden-xs">
            <li class="hidden-xs">
                <input class="search" placeholder="Enter keywords" type="text">
            </li>
<!--             <li class="notification-dropdown hidden-xs"> -->
<!--                 <a href="#" class="trigger"> -->
<!--                     <i class="glyphicon glyphicon-bell"></i> -->
<!--                     <span class="count">5</span> -->
<!--                 </a> -->
<!--                 <div class="pop-dialog"> -->
<!--                     <div class="pointer right"> -->
<!--                         <div class="arrow"></div> -->
<!--                         <div class="arrow_border"></div> -->
<!--                     </div> -->
<!--                     <div class="body"> -->
<!--                         <a href="#" class="close-icon"><i class="glyphicon glyphicon-remove-circle"></i></a> -->
<!--                         <div class="notifications"> -->
<!--                             <h3>You have 5 new notifications</h3> -->
<!--                             <a href="#" class="item"> -->
<!--                                 <i class="fa fa-bug"></i> Server Error Reports -->
<!--                                 <span class="time"><i class="fa fa-clock-o"></i> 13 min.</span> -->
<!--                             </a> -->
<!--                             <a href="#" class="item"> -->
<!--                                 <i class="fa fa-cloud-download"></i> Backup Completed -->
<!--                                 <span class="time"><i class="fa fa-clock-o"></i> 18 min.</span> -->
<!--                             </a> -->
<!--                             <a href="#" class="item"> -->
<!--                                 <i class="fa fa-cogs"></i> <strong>System Updated</strong> -->
<!--                                 <span class="time"><i class="fa fa-clock-o"></i> 20 min.</span> -->
<!--                             </a> -->
<!--                             <a href="#" class="item"> -->
<!--                                 <i class="fa fa-code"></i> Code Error on Line 101 -->
<!--                                 <span class="time"><i class="fa fa-clock-o"></i> 49 min.</span> -->
<!--                             </a> -->
<!--                             <a href="#" class="item"> -->
<!--                                 <i class="fa fa-refresh fa-spin"></i> Spinner Icon -->
<!--                                 <span class="time"><i class="fa fa-clock-o"></i> 1 day.</span> -->
<!--                             </a> -->
<!--                             <div class="footer"> -->
<!--                                 <a href="#" class="logout">View all notifications</a> -->
<!--                             </div> -->
<!--                         </div> -->
<!--                     </div> -->
<!--                 </div> -->
<!--             </li> -->

		    <li class="notification-dropdown hidden-xs">
                <a href="<?php echo urlHome();?>" title="Trang Chủ" class="trigger">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li class="notification-dropdown hidden-xs">
                <a href="#" class="trigger">
                    <i class="fa fa-envelope"></i>
                    <span class="count">5</span>
                </a>
                <div class="pop-dialog">
                    <div class="pointer right">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <a href="#" class="close-icon"><i class="glyphicon glyphicon-remove-circle"></i></a>
                        <div class="messages">
                            <a href="#" class="item">
                                <img src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/user_2.png" class="display" alt="user">
                                <div class="name">Jhane Doe</div>
                                <div class="msg">
                                Quisque commodo massa sed ipsum porttitor facilisis.
                                </div>
                                <span class="time"><i class="fa fa-clock-o"></i> 5 sec.</span>
                            </a>
                            <a href="#" class="item">
                                <img src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/user_3.png" class="display" alt="user">
                                <div class="name">Jack Daniel</div>
                                <div class="msg">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                </div>
                                <span class="time"><i class="fa fa-clock-o"></i> 37 mins.</span>
                            </a>
                            <a href="#" class="item last">
                                <img src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/user_4.png" class="display" alt="user">
                                <div class="name">Warm Sleepy</div>
                                <div class="msg">
                                Hello, how are you? i just though you were here, i'll see you tomorrow.
                                </div>
                                <span class="time"><i class="fa fa-clock-o"></i> 2 days.</span>
                            </a>
                            <div class="footer">
                                <a href="#" class="logout">View all messages</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle hidden-xs" data-toggle="dropdown"> 
                <img class="img-circle" src="<?php echo userImg(); ?>" alt="avatar"> <?php echo userFullname(); ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Profile</a></li>
                        <li><a href="<?php echo urlAdminSettingEdit();?>">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo urlAdminLogout();?>">Sign Out</a></li>
                    </ul>
            </li>
            <li>
            	<a href="<?php echo urlAdminLogout(); ?>">
            		<i class="fa fa-sign-out"></i>
            		Logout
            	</a>
            </li>
        </ul>
    </header>
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav">
        <div class="profile-hidder">
        <ul class="nav">
                    <li class="nav-profile">
                        <div class="image">
                            <a href="javascript:;"><img src="<?php echo userImg(); ?>" alt=""></a>
                        </div>
                        <div class="info">
                            <a href="#"><?php echo userFullname(); ?> <b class="caret"></b></a>
                            <small>Administrator</small>
                        </div>
                    </li>
                </ul>
            </div>

        <ul id="dashboard-menu">
        	  <!--
              <li class="active">
              -->
              <li class="">
                <!--
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                -->
                <a href="http://juanproject.org/myxdashboard/index.html">
                    <i class="fa fa-laptop"></i>
                    <span>Dashboard</span>
                </a>
            </li>    
            <li class="">
                <a class="dropdown-toggle" href="#">              
                    <i class="fa fa-tags fa-fw"></i>
                    <span>Danh Mục</span> <b class="caret"></b>
                </a>
                 <ul style="display: none;" class="submenu">
                    <li><a href="<?php echo urlAdminCategory() ?>">Loại sản phẩm</a></li>
      				<li><a href="<?php echo urlAdminBook() ?>">Sản phẩm</a></li>
      				<li><a href="<?php echo urlAdminPublisher() ?>">Nhà Sản Xuất</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo urlAdminModule(); ?>">
                    <i class="fa fa-puzzle-piece fa-fw"></i>
                    <span>Modules</span>
                </a>
            </li>

            <li>
                <a class="dropdown-toggle" href="#">              
                    <i class="fa fa-shopping-cart"></i>
                    <span>Doanh Số</span> <b class="caret"></b>
                </a>
                 <ul class="submenu">
                    <li><a href="<?php echo urlAdminOrder() ?>">Đơn Hàng</a></li>
      				<li><a href="#">Khách hàng</a></li>
                </ul>
            </li>

             <li>                
                <a class="dropdown-toggle" href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Hệ Thống</span> <b class="caret"></b>
                </a>
                <ul class="submenu">
                    <li><a href="<?php echo urlAdminSettingEdit() ?>">Settings</a></li>
      
			      <li><a href="<?php echo urlAdminBanner() ?>">Banners</a>
			      </li>
			      
			      <li><a href="<?php echo urlAdminUser() ?>">Quản Trị Viên</a>
			      </li>
                </ul>
            </li>
            
        </ul>
    </div>
    <!-- end sidebar -->


    <!-- main container -->
    <div class="content">
    <div id="pad-wrapper">
    	<?php include_once $web_content;?> 
    </div>
    <!-- /pad-wrapper -->
    </div><!-- content --> 
    <!-- /main container -->




            <!--post modal-->
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                           <h4><strong>Delete Confirmation</strong></h4>
                        </div>
                    
                        <div class="modal-body"><p></p></div>
                       
                        <div class="modal-footer">
                            <button class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Close</button>
                            <button data-dismiss="modal" class="btn btn-danger btn-sm" id="btnYes">Confirm</button> 
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification -->
            <div class="ui-notify" id="container"></div> 



    <!-- scripts -->
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/analytics.js" async=""></script><script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery_006.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/bootstrap.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/theme.js"></script>


    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery-jvectormap-1.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery_002.js"></script>

    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/waypoints.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery_003.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/bootstrap-modal.js"></script>
    
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery_007.js"></script>

    <!-- Upload file drag and drop -->
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/filedrag.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/bootstrap_002.js"></script>

    <!-- notification -->
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery-ui.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery_004.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/jquery_005.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/bootstrap_calendar.js"></script>


    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/snap.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/pizza.js"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES ?>layout-admin_files/index.js"></script>
    <script type="text/javascript">
    //Google Analytics
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-52249171-1', 'myxvip.com');
      ga('send', 'pageview');
        </script>


<div class="jvectormap-label"></div></body></html>