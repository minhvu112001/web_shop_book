<?php
// cấu hình hệ thống
include_once '../configs.php';
// thư viện hàm
include_once '../lib/table/table.book.php';

include_once "book-validate.php";

if ( isset($_POST['selected']) && validateCopy())  
{
	// Copy sản phẩm
	foreach ($_POST['selected'] as $book_id) 
	{
		bookCopy($book_id);
	}
	
	// Thông báo sao chép thành công
	$_SESSION['SUCCESS_TEXT'] = 'Đã sao chép sản phẩm thành công !';
	
	// Điều hướng tới trang danh mục sản phẩm
	// có phân trang và sắp xếp
	$url = '';

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
	die();
}

// dòng này dễ gây chết chương trình
include_once 'book.php';
