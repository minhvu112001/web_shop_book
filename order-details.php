<?php 
// Cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/table/table.order.php';

// Nếu khách hàng chưa đăng nhập thì điều hướng sang trang login
checkLoginHome();

// Lấy ra chi tiết đơn hàng theo id
$order = orderDetailsWithFormat($_GET['order_id']);

// Nội dung riêng của trang...
$web_title = "Chi Tiết Đơn Hàng";
$web_content = DIR_UI_HOME_THEMES."view/view-order-details.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// ...được đặt vào bố cục chung của toàn site.
include_once FILE_LAYOUT_HOME;	

