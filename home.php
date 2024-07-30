<?php 
// Cấu hình hệ thống
include_once 'configs.php';

// Thư viện hàm
include_once 'lib/table/table.banner.php';  
include_once 'lib/table/table.book.php';

// Nội dung riêng của trang...
$web_title = "Trang Chủ";
$web_content = DIR_UI_HOME_THEMES."view/view-home.php";

checkFileLayout(FILE_LAYOUT_HOME, $web_content);

// ...được đặt vào bố cục chung của toàn site.
include_once FILE_LAYOUT_HOME;	

