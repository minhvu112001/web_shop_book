<!DOCTYPE html><?php '../../../configs.php'; ?>
<html lang="en"><!-- saved from url=(0045) http://themeslivepreview.com/amaretti-v1.1.4/-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?php echo $web_title;?></title>
	<link href="<?php echo urlIcon(); ?>" rel="icon">
	<?php include_once DIR_UI."common-head-layout-admin.php";?>
   	
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/nanoscroller.css"><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/theme-switcher.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-1.2.2.css"><link type="text/css" href="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/style(1).css" rel="stylesheet">  <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;box-sizing: content-box;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style></head>
  <body style="">
    <div class="am-wrapper">
      <nav class="navbar navbar-default navbar-fixed-top am-top-header">
        <div class="container-fluid">
          <div class="navbar-header">
            <div class="page-title"><span>Dashboard</span></div>
            <a href="#" class="am-toggle-left-sidebar navbar-toggle collapsed"><span class="icon-bar"><span></span><span></span><span></span></span></a>
            <a href="<?php echo urlHome();?>" class="navbar-brand">
            	<img src="<?php echo storeLogo();?>" width="64"/>
            </a>
          </div><a href="#" class="am-toggle-right-sidebar"><span class="icon s7-menu2"></span></a><a href="#" data-toggle="collapse" data-target="#am-navbar-collapse" class="am-toggle-top-header-menu collapsed"><span class="icon s7-angle-down"></span></a>
          <div id="am-navbar-collapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right am-user-nav">
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="<?php echo userImg();?>"><span class="user-name"><?php echo userFullname();?></span><span class="angle-down s7-angle-down"></span></a>
                <ul role="menu" class="dropdown-menu">
                  <li><a href="<?php echo urlAdminUserEdit().'&user_id='.userId();?>"> <span class="icon s7-user"></span>My profile</a></li>
                  <li><a href="<?php echo urlAdminSettingEdit();?>"> <span class="icon s7-config"></span>Settings</a></li>
                  <li><a href="#" onclick="alert('Đang xây dựng!')"> <span class="icon s7-help1"></span>Trợ Giúp</a></li>
                  <li><a href="<?php echo urlAdminLogout();?>"> <span class="icon s7-power"></span>Đăng Thoát</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav am-nav-right">
              <li><a href="<?php echo urlHome();?>">Trang Chủ</a></li>
              <li><a href="<?php echo urlAdminLogout();?>">Đăng Thoát &nbsp;<i class="fa fa-sign-out fa-lg"></i></a></li>
              <!--
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle">Services <span class="angle-down s7-angle-down"></span></a>
                <ul role="menu" class="dropdown-menu">
                  <li><a href="#">UI Consulting</a></li>
                  <li><a href="#">Web Development</a></li>
                  <li><a href="#">Database Management</a></li>
                  <li><a href="#">Seo Improvement</a></li>
                </ul>
              </li>
              
              <li><a href="#">Support</a></li>
              -->
            </ul>
            <ul class="nav navbar-nav navbar-right am-icons-nav">
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon s7-comment"></span></a>
                <ul class="dropdown-menu am-messages">
                  <li>
                    <div class="title">Messages<span class="badge">3</span></div>
                    <div class="list">
                      <div class="am-scroller nano has-scrollbar">
                        <div class="content nano-content" tabindex="0" style="right: -17px;">
                          <ul>
                            <li class="active"><a href="#">
                                <div class="logo"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar2.jpg"></div>
                                <div class="user-content"><span class="date">April 25</span><span class="name">Jessica Caruso</span><span class="text-content">Request you to be a part of the same so that we can work...</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar3.jpg"></div>
                                <div class="user-content"><span class="date">March 18</span><span class="name">Joel King</span><span class="text-content"> We wish to extend the building.</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar4.jpg"></div>
                                <div class="user-content"><span class="date">January 3</span><span class="name">Claire Sassu</span><span class="text-content"> We the ladies of a block are wiling to join together to set up a catering...</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar5.jpg"></div>
                                <div class="user-content"><span class="date">January 2</span><span class="name">Emily Carter</span><span class="text-content"> Request you to be a part of the same so that we can work...</span></div></a></li>
                          </ul>
                        </div>
                      <div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div>
                    </div>
                    <div class="footer"> <a href="#">View all messages</a></div>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon s7-bell"></span><span class="indicator"></span></a>
                <ul class="dropdown-menu am-notifications">
                  <li>
                    <div class="title">Notifications<span class="badge">3</span></div>
                    <div class="list">
                      <div class="am-scroller nano has-scrollbar">
                        <div class="content nano-content" tabindex="0" style="right: -17px;">
                          <ul>
                            <li class="active"><a href="#">
                                <div class="logo"><span class="icon s7-pin"></span></div>
                                <div class="user-content"><span class="circle"></span><span class="name">Jessica Caruso</span><span class="text-content"> accepted your invitation to join the team.</span><span class="date">2 min ago</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><span class="icon s7-add-user"></span></div>
                                <div class="user-content"><span class="name">Joel King</span><span class="text-content"> is now following you</span><span class="date">2 days ago</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><span class="icon s7-gleam"></span></div>
                                <div class="user-content"><span class="name">Claire Sassu</span><span class="text-content"> is watching your main repository</span><span class="date">2 days ago</span></div></a></li>
                            <li><a href="#">
                                <div class="logo"><span class="icon s7-add-user"></span></div>
                                <div class="user-content"><span class="name">Emily Carter</span><span class="text-content"> is now following you</span><span class="date">5 days ago</span></div></a></li>
                          </ul>
                        </div>
                      <div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div>
                    </div>
                    <div class="footer"> <a href="#">View all notifications</a></div>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon s7-share"></span></a>
                <ul class="dropdown-menu am-connections">
                  <li>
                    <div class="title">Connections</div>
                    <div class="list">
                      <div class="content">
                        <ul>
                          <li>
                            <div class="logo"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/github.png"></div>
                            <div class="field"><span>GitHub</span>
                              <div class="pull-right">
                                <div class="switch-button switch-button-sm">
                                  <input type="checkbox" checked="" name="check1" id="switch1"><span>
                                    <label for="switch1"></label></span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="logo"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/bitbucket.png"></div>
                            <div class="field"><span>Bitbucket</span>
                              <div class="pull-right">
                                <div class="switch-button switch-button-sm">
                                  <input type="checkbox" name="check2" id="switch2"><span>
                                    <label for="switch2"></label></span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="logo"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/slack.png"></div>
                            <div class="field"><span>Slack</span>
                              <div class="pull-right">
                                <div class="switch-button switch-button-sm">
                                  <input type="checkbox" checked="" name="check3" id="switch3"><span>
                                    <label for="switch3"></label></span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="logo"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/dribbble.png"></div>
                            <div class="field"><span>Dribbble</span>
                              <div class="pull-right">
                                <div class="switch-button switch-button-sm">
                                  <input type="checkbox" name="check4" id="switch4"><span>
                                    <label for="switch4"> </label></span>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="footer"> <a href="#">View all connections</a></div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="am-left-sidebar">
        <div class="content">
          <div class="am-logo"></div>
          <ul class="sidebar-elements">
            <li class="parent active open"><a href="<?php echo urlAdminDashboard();?>"><i class="icon s7-monitor"></i><span>Dashboard</span></a>
              <!--
              <ul class="sub-menu">
              	<li class="title">Dashboard</li>
              	<li class="nav-items">
              	<div class="am-scroller nano has-scrollbar">
              		<div class="content nano-content" tabindex="0" style="right: -17px;">
              			<ul>
              				<li class="active"><a href="index.php">Version 1</a></li>
              				<li><a href="dashboard2.php">Version 2</a></li>
              				<li><a href="dashboard3.php">
              						<span class="label label-primary pull-right">New</span>Version 3
              					</a>
                			</li>
                			<li><a href="dashboard4.php"><span class="label label-primary pull-right">New</span>Version 4</a>
                			</li>
                		</ul>
                	</div>
                	<div class="nano-pane" style="display: none;">
                		<div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div>
                	</div>
                </div>
                </li>
              </ul>
              -->
            </li>
            <!--
            <li class="parent"><a href="#"><i class="icon s7-diamond"></i><span>UI Elements</span></a>
              <ul class="sub-menu"><li class="title">UI Elements</li>
              <li class="nav-items"><div class="am-scroller nano has-scrollbar"><div class="content nano-content" tabindex="0" style="right: -17px;"><ul><li><a href="ui-general.php">General</a>
                </li><li><a href="ui-alerts.php">Alerts</a>
                </li><li><a href="ui-panels.php">Panels</a>
                </li><li><a href="ui-buttons.php">Buttons</a>
                </li><li><a href="ui-modals.php">Modals</a>
                </li><li><a href="ui-notifications.php">Notifications</a>
                </li><li><a href="ui-icons.php">Icons</a>
                </li><li><a href="ui-grid.php">Grid</a>
                </li><li><a href="ui-tabs-accordions.php">Tabs &amp; Accordions</a>
                </li><li><a href="ui-nestable-lists.php">Nestable Lists</a>
                </li></ul></div><div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div></li></ul>
            </li>
            -->
            <li class="parent"><a href="charts.php">
            	<i class="icon s7-graph"></i><span>Doanh Số</span></a>
              	<ul class="sub-menu"><li class="title">Doanh Số</li>
                
                
                
              <li class="nav-items">
              	<div class="am-scroller nano has-scrollbar">
              		<div class="content nano-content" tabindex="0" style="right: -17px;">
              			<ul>
              				<li><a href="<?php echo urlAdminOrder() ?>">Đơn Hàng</a></li>
      						<li><a href="<?php echo urlAdminCustomer();?>">Khách hàng</a></li>
                		</ul>
                	</div>
                <div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div></li></ul>
            </li>
            <!--
            <li class="parent"><a href="#"><i class="icon s7-ribbon"></i><span>Forms</span></a>
              <ul class="sub-menu"><li class="title">Forms</li>
                
                
                
                
                
                
              <li class="nav-items"><div class="am-scroller nano has-scrollbar"><div class="content nano-content" tabindex="0" style="right: -17px;"><ul><li><a href="form-elements.php">Elements</a>
                </li><li><a href="form-validation.php">Validation</a>
                </li><li><a href="form-wizard.php">Wizard</a>
                </li><li><a href="form-masks.php">Input Masks</a>
                </li><li><a href="form-wysiwyg.php">WYSIWYG Editor</a>
                </li><li><a href="form-upload.php">Multi Upload</a>
                </li></ul></div><div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div></li></ul>
            </li>
            -->
            <li class="parent"><a href="<?php echo urlAdminModule();?>"><i class="icon s7-box2"></i><span>Modules</span></a>
              <!--
              <ul class="sub-menu">
              	<li class="title">Modules</li>
              	<li class="nav-items">
              		<div class="am-scroller nano has-scrollbar">
              		<div class="content nano-content" tabindex="0" style="right: -17px;">
              			<ul>
              				<li><a href="tables-general.php">General</a>
                			</li>
                			<li><a href="tables-datatables.php">Data Tables</a>
                			</li>
                		</ul>
                	</div>
                	<div class="nano-pane" style="display: none;">
                	<div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);">
                	</div>
                	</div>
                	</div>
                </li>
               </ul>
               -->
            </li>
            <li class="parent"><a href="#"><i class="icon s7-note2"></i><span>Danh Mục</span></a>
              <ul class="sub-menu"><li class="title">Danh Mục</li>
                
              <li class="nav-items"><div class="am-scroller nano has-scrollbar"><div class="content nano-content" tabindex="0" style="right: -17px;">
              <ul>
              	<li><a href="<?php echo urlAdminCategory() ?>">Loại sản phẩm</a></li>
			      <li><a href="<?php echo urlAdminBook() ?>">Sản phẩm</a></li>
			      <li><a href="<?php echo urlAdminPublisher() ?>">Nhà Sản Xuất</a></li>
               </ul></div><div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div></li></ul>
            </li>
            <!--
            <li class="parent"><a href="#"><i class="icon s7-mail"></i><span>Email</span></a>
              <ul class="sub-menu"><li class="title">Email</li>
                
                
                
              <li class="nav-items"><div class="am-scroller nano has-scrollbar"><div class="content nano-content" tabindex="0" style="right: -17px;"><ul><li><a href="email-inbox.php"><span class="label label-primary pull-right">New</span>Inbox</a>
                </li><li><a href="email-read.php"><span class="label label-primary pull-right">New</span>Email Detail</a>
                </li><li><a href="email-compose.php"><span class="label label-primary pull-right">New</span>Email Compose</a>
                </li></ul></div><div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div></li></ul>
            </li>
            -->
            <li class="parent"><a href="#"><i class="fa fa-cog fa-3x"></i><span>Hệ Thống</span></a>
              <ul class="sub-menu"><li class="title">Settings</li>
                
                
              <li class="nav-items"><div class="am-scroller nano has-scrollbar">
              <div class="content nano-content" tabindex="0" style="right: -17px;">
              <ul>
              	<li><a href="<?php echo urlAdminSettingEdit() ?>"><span>Settings</span></a></li>
      
			      <li><a href="<?php echo urlAdminBanner() ?>"></i><span>Banners</span></a>
			      </li>
			      
			      <li><a href="<?php echo urlAdminUser() ?>"><span>Quản Trị Viên</span></a>
			      </li>
              </ul></div><div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div></li></ul>
            </li>
            <!--
            <li class="parent"><a href="#"><i class="icon s7-map-marker"></i><span>Maps</span></a>
              <ul class="sub-menu"><li class="title">Maps</li>
                
                
              <li class="nav-items"><div class="am-scroller nano has-scrollbar"><div class="content nano-content" tabindex="0" style="right: -17px;"><ul><li><a href="maps-google.php">Google Maps</a>
                </li><li><a href="maps-vector.php">Vector Maps</a>
                </li></ul></div><div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div></li></ul>
            </li>
            -->
          </ul>
          <!--Sidebar bottom content-->
        </div>
      </div>
      <div class="am-content">
        <div class="main-content">
        	<?php include_once $web_content;?>
        </div>
      </div>
      <nav class="am-right-sidebar">
        <div class="sb-content">
          <div class="user-info"><img src="<?php echo userImg(); ?>"><span class="name"><?php echo userName(); ?><span class="status"></span></span><span class="position"><?php echo userFullname();?></span></div>
          <div class="tab-navigation">
            <ul role="tablist" class="nav nav-tabs nav-justified">
              <li role="presentation" class="active"><a href="#tab1" aria-controls="home" role="tab" data-toggle="tab"> <span class="icon s7-smile"></span></a></li>
              <li role="presentation"><a href="#tab2" aria-controls="profile" role="tab" data-toggle="tab"> <span class="icon s7-chat"></span></a></li>
              <li role="presentation"><a href="#tab3" aria-controls="messages" role="tab" data-toggle="tab"> <span class="icon s7-help2"></span></a></li>
              <li role="presentation"><a href="#tab4" aria-controls="settings" role="tab" data-toggle="tab"> <span class="icon s7-ticket"></span></a></li>
            </ul>
          </div>
          <div class="tab-panel">
            <div class="tab-content">
              <div id="tab1" role="tabpanel" class="tab-pane announcement active am-scroller nano has-scrollbar">
                <div class="nano-content" tabindex="0" style="right: -17px;">
                  <div class="content">
                    <h2>Announcement</h2>
                    <ul>
                      <li>
                        <div class="icon"><span class="icon s7-sun"></span></div>
                        <div class="content"><a href="#">Happy Day</a><span>Suspendisse nec leo tortor rhoncus tincidunt. Duis sit amet rutrum elit.</span></div>
                      </li>
                      <li>
                        <div class="icon"><span class="icon s7-gift"></span></div>
                        <div class="content"><a href="#">Congratulations Developers</a><span>Suspendisse nec leo tortor rhoncus tincidunt. Duis sit amet rutrum elit.</span></div>
                      </li>
                      <li>
                        <div class="icon"><span class="icon s7-star"></span></div>
                        <div class="content"><a href="#">High Score</a><span>Suspendisse nec leo tortor rhoncus tincidunt. Duis sit amet rutrum elit.</span></div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="search">
                  <input type="text" placeholder="Search..." name="q"><span class="s7-search"></span>
                </div>
              <div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 440px; transform: translate(0px, 0px);"></div></div></div>
              <div id="tab2" role="tabpanel" class="tab-pane chat">
                <div class="chat-contacts">
                  <div class="chat-sections">
                    <div class="am-scroller nano has-scrollbar">
                      <div class="content nano-content" tabindex="0" style="right: -17px;">
                        <h2>Recent</h2>
                        <div class="recent">
                          <div class="user"><a href="#"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar4.jpg">
                              <div class="user-data"><span class="status away"></span><span class="name">Claire Sassu</span><span class="message">Can you share the...</span></div></a></div>
                          <div class="user"><a href="#"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar7.jpg">
                              <div class="user-data"><span class="status"></span><span class="name">Maggie jackson</span><span class="message">I confirmed the info.</span></div></a></div>
                          <div class="user"><a href="#"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar3.jpg">
                              <div class="user-data"><span class="status offline"></span><span class="name">Joel King		</span><span class="message">Ready for the meeti...</span></div></a></div>
                        </div>
                        <h2>Contacts</h2>
                        <div class="contact">
                          <div class="user"><a href="#"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar6.jpg">
                              <div class="user-data2"><span class="status"></span><span class="name">Mike Bolthort</span></div></a></div>
                          <div class="user"><a href="#"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar7.jpg">
                              <div class="user-data2"><span class="status"></span><span class="name">Maggie jackson</span></div></a></div>
                          <div class="user"><a href="#"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar8.jpg">
                              <div class="user-data2"><span class="status offline"></span><span class="name">Jhon Voltemar</span></div></a></div>
                        </div>
                      </div>
                    <div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div>
                  </div>
                  <div class="search">
                    <input type="text" placeholder="Search..." name="q"><span class="s7-search"></span>
                  </div>
                </div>
                <div class="chat-window">
                  <div class="title">
                    <div class="user"><img src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/avatar7.jpg">
                      <h2>Maggie jackson</h2><span>Active 1h ago</span>
                    </div><span class="icon return s7-angle-left"></span>
                  </div>
                  <div class="chat-messages">
                    <div class="am-scroller nano has-scrollbar">
                      <div class="content nano-content" tabindex="0" style="right: -17px;">
                        <ul>
                          <li class="friend">
                            <div class="msg">Hello</div>
                          </li>
                          <li class="self">
                            <div class="msg">Hi, how are you?</div>
                          </li>
                          <li class="friend">
                            <div class="msg">Good, I'll need support with my pc</div>
                          </li>
                          <li class="self">
                            <div class="msg">Sure, just tell me what is going on with your computer?</div>
                          </li>
                          <li class="friend">
                            <div class="msg">I don't know it just turns off suddenly</div>
                          </li>
                        </ul>
                      </div>
                    <div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div>
                  </div>
                  <div class="chat-input">
                    <div class="input-wrapper"><span class="photo s7-camera"></span>
                      <input type="text" placeholder="Message..." name="q" autocomplete="off"><span class="send-msg s7-paper-plane"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div id="tab3" role="tabpanel" class="tab-pane faqs am-scroller nano has-scrollbar">
                <div class="nano-content" tabindex="0" style="right: -17px;">
                  <div class="content">
                    <h2>FAQs</h2>
                    <div id="accordion" role="tablist" aria-multiselectable="true" class="panel-group accordion">
                      <div class="panel">
                        <div role="tab" class="panel-heading">
                          <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#faq1" aria-expanded="true" aria-controls="collapseOne">
                              <div class="icon"><span class="s7-angle-down"></span></div><span class="title">Under Error 352</span></a></h4>
                        </div>
                        <div id="faq1" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse in">
                          <div class="panel-body">Suspendisse nec leo tortor rhoncus tincidunt. Duis sit amet rutrum elit.</div>
                        </div>
                      </div>
                      <div class="panel">
                        <div role="tab" class="panel-heading">
                          <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#faq2" aria-expanded="false" aria-controls="collapseTwo" class="collapsed">
                              <div class="icon"><span class="s7-angle-down"></span></div><span class="title">Failure platform</span></a></h4>
                        </div>
                        <div id="faq2" role="tabpanel" aria-labelledby="headingTwo" class="panel-collapse collapse">
                          <div class="panel-body">Suspendisse nec leo tortor rhoncus tincidunt. Duis sit amet rutrum elit.</div>
                        </div>
                      </div>
                      <div class="panel">
                        <div role="tab" class="panel-heading">
                          <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#faq3" aria-expanded="false" aria-controls="collapseThree" class="collapsed">
                              <div class="icon"><span class="s7-angle-down"></span></div><span class="title">Error 404</span></a></h4>
                        </div>
                        <div id="faq3" role="tabpanel" aria-labelledby="headingThree" class="panel-collapse collapse">
                          <div class="panel-body">Suspendisse nec leo tortor rhoncus tincidunt. Duis sit amet rutrum elit.</div>
                        </div>
                      </div>
                      <div class="panel">
                        <div role="tab" class="panel-heading">
                          <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#faq4" aria-expanded="false" aria-controls="collapseThree" class="collapsed">
                              <div class="icon"><span class="s7-angle-down"></span></div><span class="title">New workstation</span></a></h4>
                        </div>
                        <div id="faq4" role="tabpanel" aria-labelledby="headingThree" class="panel-collapse collapse">
                          <div class="panel-body">Suspendisse nec leo tortor rhoncus tincidunt. Duis sit amet rutrum elit.</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="search">
                  <input type="text" placeholder="Search..." name="q"><span class="s7-search"></span>
                </div>
              <div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div>
              <div id="tab4" role="tabpanel" class="tab-pane ticket am-scroller nano has-scrollbar">
                <div class="nano-content" tabindex="0" style="right: -17px;">
                  <div class="content">
                    <h2>New Ticket</h2>
                    <form>
                      <div class="form-group send-ticket">
                        <input type="text" placeholder="Title" class="form-control">
                      </div>
                      <div class="form-group send-ticket">
                        <textarea rows="3" placeholder="Write Here..." class="form-control"></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary btn-lg">Create Ticket</button>
                    </form>
                  </div>
                </div>
              <div class="nano-pane" style="display: none;"><div class="nano-slider" style="height: 20px; transform: translate(0px, 0px);"></div></div></div>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <script async="" src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/analytics.js"></script><script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery.nanoscroller.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/main.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/theme-switcher.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery.flot.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery.flot.pie.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery.flot.orderBars.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/curvedLines.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-us-merc-en.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-uk-mill-en.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-fr-merc-en.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-us-il-chicago-mill-en.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-au-mill-en.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-in-mill-en.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-map.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/jquery-jvectormap-ca-lcc-en.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/countUp.min.js" type="text/javascript"></script>
    <script src="<?php echo URL_UI_ADMIN_THEMES;?>layout-admin_files/Chart.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      	App.dashboard();
      
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
      	App.livePreview();
      });
      
    </script>
    <script type="text/javascript">
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      
      ga('create', 'UA-68396117-1', 'auto');
      ga('send', 'pageview');
      
      
    </script>
    <div class="ft_theme_switcher ocult">
      <!--
      <div class="toggle"><i class="icon s7-settings"></i></div>
      -->
      <div class="desc">
        <h3>Theme Switcher</h3>
        <p>Select a color scheme. You can create your own color theme with less files.</p>
      </div>
      <div class="style_list">
        <div class="style">
          <div class="colors">
            <div style="background: #EF6262;" class="color"></div>
            <div style="background: #95d9f0;" class="color"></div>
            <div style="background: #ffdc7a;" class="color"></div>
            <div style="background: #7a98bf;" class="color"></div>
            <div style="background: #cccccc;" class="color"></div>
            <div class="name"> Default</div>
          </div><a href="?theme=default"></a>
        </div>
        <div class="style">
          <div class="colors">
            <div style="background: #7F64B5;" class="color"></div>
            <div style="background: #65CEEC;" class="color"></div>
            <div style="background: #ffdc7a;" class="color"></div>
            <div style="background: #45D8C2;" class="color"></div>
            <div style="background: #e0e0e0;" class="color"></div>
            <div class="name"> Twilight</div>
          </div><a href="?theme=twilight"></a>
        </div>
        <div class="style">
          <div class="colors">
            <div style="background: #4e91ff;" class="color"></div>
            <div style="background: #f55244;" class="color"></div>
            <div style="background: #FBBF22;" class="color"></div>
            <div style="background: #49AD70;" class="color"></div>
            <div style="background: #DFDFDF;" class="color"></div>
            <div class="name"> Google</div>
          </div><a href="?theme=google"></a>
        </div>
        <div class="style">
          <div class="colors">
            <div style="background: #f7c954;" class="color"></div>
            <div style="background: #88ca92;" class="color"></div>
            <div style="background: #7fcff5;" class="color"></div>
            <div style="background: #8B8CCC;" class="color"></div>
            <div style="background: #CCCCCC;" class="color"></div>
            <div class="name"> Sunrise</div>
          </div><a href="?theme=sunrise"></a>
        </div>
        <div class="style">
          <div class="colors">
            <div style="background: #6bc3b0;" class="color"></div>
            <div style="background: #FFE088;" class="color"></div>
            <div style="background: #bda5d7;" class="color"></div>
            <div style="background: #FF7FA0;" class="color"></div>
            <div style="background: #dfdfdf;" class="color"></div>
            <div class="name">Cake</div>
          </div><a href="?theme=cake"></a>
        </div>
      </div>
    </div>
  
<div class="am-scroll-top"></div><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div><div class="jvectormap-label"></div></body></html>