<?php 
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.banner.php';
include_once 'lib/table/table.book.php';
include_once 'lib/table/table.customer.php';

// Nếu khách hàng chưa đăng nhập thì điều hướng sang trang login
checkLoginHome();
	
$customer_info = customerGetById($_SESSION['CUS_LOGGED']);

$fullname = $customer_info['fullname'];

$email = $customer_info['email'];

$telephone = $customer_info['telephone'];

$fax = $customer_info['fax'];

$address = $customer_info['address'];

$city = $customer_info['city'];

// Nội dung riêng của trang...
$web_title = "Tài khoản";
$web_content = DIR_UI_HOME_THEMES."view/view-account.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// ...được đặt vào bố cục của toàn site.
include_once FILE_LAYOUT_HOME ;	

