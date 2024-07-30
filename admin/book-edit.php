<?php
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.book.php';

include_once 'book-validate.php';

// Nếu user gửi form lên
// toàn bộ dữ liệu thêm mới được lưu trong biến mảng $_POST
if ( $_SERVER['REQUEST_METHOD'] == "POST" && validateFormBook())  
{ //var_dump($_POST['sort_order']);die();
	// Thêm mới sản phẩm
	bookEdit($_REQUEST['book_id'], $_POST);
	
	// Thông báo sửa thành công
	$_SESSION['SUCCESS_TEXT'] = "Đã sửa thành công sản phẩm";
	
	// Điều hướng tới trang danh mục sản phẩm
	// có phân trang và sắp xếp
	$url = '?';

     if (isset($_REQUEST['filter_name'])) 
     {
          $url .= '&filter_name=' . urlencode(html_entity_decode($_REQUEST['filter_name'], ENT_QUOTES, 'UTF-8'));
     }

     if (isset($_REQUEST['filter_model'])) 
     {
          $url .= '&filter_model=' . urlencode(html_entity_decode($_REQUEST['filter_model'], ENT_QUOTES, 'UTF-8'));
     }

     if (isset($_REQUEST['filter_price'])) 
     {
          $url .= '&filter_price=' . $_REQUEST['filter_price'];
     }

     if (isset($_REQUEST['filter_status'])) 
     {
          $url .= '&filter_status=' . $_REQUEST['filter_status'];
     }

     if (isset($_REQUEST['sort'])) 
     {
          $url .= '&sort=' . $_REQUEST['sort'];
     }

     if (isset($_REQUEST['order'])) 
     {
          $url .= '&order=' . $_REQUEST['order'];
     }

     if (isset($_REQUEST['page'])) 
     {
          $url .= '&page=' . $_REQUEST['page'];
     }
     
	header ("location: ".urlAdminBook().$url);
}

// Thông tin riêng của trang
$web_title = 'Sản Phẩm';
$form_title = 'Sửa Thông Tin Sản Phẩm';

include_once 'book-form.php';