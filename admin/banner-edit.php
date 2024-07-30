<?php
// Cấu hình hệ thống
include_once '../configs.php';

// Thư viện hàm
include_once '../lib/table/table.banner.php';
include_once 'banner-validate.php';

// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{
	// Sửa banner
	bannerEdit($_GET['banner_id'], $_POST);
	
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã sửa banner thành công !';
	
	// Điều hướng tới trang danh mục sản phẩm
	// có phân trang và sắp xếp
	$url = '?';

     if (isset($_REQUEST['sort'])) {
          $url .= '&sort=' . $_REQUEST['sort'];
     }

     if (isset($_REQUEST['order'])) {
          $url .= '&order=' . $_REQUEST['order'];
     }

     if (isset($_REQUEST['page'])) {
          $url .= '&page=' . $_REQUEST['page'];
     }
     
	header ("location: ".urlAdminBanner().$url);
}

$form_title = 'Sửa Banner';

include_once 'banner-form.php';