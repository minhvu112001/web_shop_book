<?php
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.publisher.php';

include_once 'publisher-validate.php';

// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateForm())  
{
	// Sửa nhà sản xuất
	foreach ($_POST['selected'] as $publisher_id) 
	{
		publisherDelete($publisher_id);
	}
	
	// Thông báo thêm mới thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã xóa thành công nhà sản xuất !';
	
	// Điều hướng tới trang danh mục sản phẩm
	// có phân trang và sắp xếp
	$url = '?';

     if (isset($_REQUEST['filter_name'])) {
          $url .= '&filter_name=' . urlencode(html_entity_decode($_REQUEST['filter_name'], ENT_QUOTES, 'UTF-8'));
     }

     if (isset($_REQUEST['sort'])) {
          $url .= '&sort=' . $_REQUEST['sort'];
     }

     if (isset($_REQUEST['order'])) {
          $url .= '&order=' . $_REQUEST['order'];
     }

     if (isset($_REQUEST['page'])) {
          $url .= '&page=' . $_REQUEST['page'];
     }
     
     if($url=='?') $url = '';
     
    // điều hướng về trang danh mục nhà sản xuất 
	header ("location: ".urlAdminPublisher().$url);
	die();
}


include_once 'publisher-form.php';