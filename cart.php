<?php
// Cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'cart-session.php';
include_once 'lib/tool.image.php';

// Nội dung riêng của trang...
$web_title = "Xem Giỏ Hàng";
$web_content = DIR_UI_HOME_THEMES."view/view-checkout-cart.php";
// ... được kiểm tra
checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// ...và được đặt vào bố cục chung của toàn site:
include_once(FILE_LAYOUT_HOME);
