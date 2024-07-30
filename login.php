<?php
include_once 'configs.php';

// Nếu như khách hàng đã đăng nhập vào rồi
// thì điều hướng sang trang chủ
if (isset ($_SESSION['CUS_LOGGED'])) 
{
	$app = APP;
	header("location: ".urlHome());
	
}	// Nếu khách hàng đăng nhập (submit login form)
else if ( $_SERVER['REQUEST_METHOD'] == "POST" )  
{ 
	
	// Mở sesion mới
	@session_destroy();
    session_start();
    session_regenerate_id();
    
    // Xác thực tài khoản khách hàng
	include_once("account-authenticate.php");
	die();
} // end login

// Nội dung riêng của trang...
$web_title = "Đăng Nhập";
$web_content = DIR_UI_HOME_THEMES."view/view-login.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// ...được đặt vào bố cục của toàn site.
include_once FILE_LAYOUT_HOME;
