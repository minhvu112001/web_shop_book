<?php 
// Cấu hình hệ thống
include_once 'configs.php';
// thư viện hàm
include_once 'lib/table/table.banner.php';
include_once 'lib/table/table.book.php';
include_once 'lib/table/table.zone.php';
include_once 'lib/table/table.customer.php';
include_once 'account-validate.php';

// Nếu khách hàng chưa đăng nhập thì điều hướng sang trang login
checkLoginHome();

if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 
	
	// sửa tài khoản khách hàng
	customerEdit($_GET['cid'], $_POST);
	
	cusInfoReset();
	
	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = 'Bạn đã sửa tài khoản thành công !';
	
	// Điều hướng sang trang đăng nhập
	header ("location: ".urlAccount());
}

$web_title = "Sửa Tài Khoản";
$form_title = 'Sửa Tài Khoản';

include_once 'account-form.php';





