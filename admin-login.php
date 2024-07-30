<?php
// cấu hình hệ thống
include_once 'configs.php';

// Nếu người dùng điền thông tin đăng nhập
// vào form và đẩy lên
if ( $_SERVER['REQUEST_METHOD'] == "POST" )  
{ 
	//var_dump($_POST);die();
	// Mở sesion mới
	@session_destroy();
    session_start();
    session_regenerate_id();
    
    // Xác thực định danh của user
	include_once 'admin-authenticate.php';
	die();
} // end login

// Hiển thị màn hình đăng nhập
$web_title  = "Quản trị";

checkFileLayout(FILE_LAYOUT_ADMIN_LOGIN, $web_content);

include_once FILE_LAYOUT_ADMIN_LOGIN;
