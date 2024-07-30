<?php 
// Cấu hình hệ thống
include_once 'configs.php';
// thư viện hàm
include_once 'lib/table/table.banner.php';
include_once 'lib/table/table.book.php';
include_once 'lib/table/table.zone.php';
include_once 'lib/table/table.customer.php';
include_once 'account-validate.php';

if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{ 
	// Thêm mới tài khoản khách hàng
	customerAdd($_POST);
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Bạn đã tạo tài khoản thành công !';
	
	// Điều hướng sang trang đăng nhập
	header ("location: ".urlLogin());
}

$web_title = "Đăng Kí Tài Khoản";
$form_title = 'Đăng Kí Tài Khoản';

include_once 'account-form.php';	

