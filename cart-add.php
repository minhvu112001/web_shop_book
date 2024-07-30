<?php
// Cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/table/table.book.php';
include_once 'cart-session.php';

/*
 Luồng chương trình: user bấm vào nút 'Thêm vào giỏ hàng' trên giao diện html
 --> common.js 
 --> cart {add: }
 --> /common/cart-info.php ---> cart.php, view-cart.php
 */

// dữ liệu json hất về phía trình duyệt khách.
$json = array();

// Bắt id của sản phẩm mới thêm vào giỏ hàng
// (gửi lên từ ajax post)
if (isset($_POST['book_id'])) 
{
	$book_id = (int)$_POST['book_id'];
} 
else 
{
	$book_id = 0;
}
	
$book_info = bookGetById($book_id);

if ($book_info) 
{
	// Số lượng sản phẩm thêm vào giỏ hàng
	if (isset($_POST['quantity'])) 
	{
		$quantity = (int)$_POST['quantity'];
	} 
	else 
	{
		$quantity = 1;
	}
		
	if (!$json) 
	{
		// Thêm mới sản phẩm vào giỏ hàng với số lượng cụ thể.
		cartAdd($_POST['book_id'], $_POST['quantity']);
			
		// Gửi thông báo thành công sang bên view
		$json['success'] = sprintf("Bạn đã thêm thành công %s vào giỏ hàng", $book_info['name']);
				
		unset($SESSION['shipping_method']);
		unset($SESSION['shipping_methods']);
		unset($SESSION['payment_method']);
		unset($SESSION['payment_methods']);

		// đoạn text hiển thị số sản phẩm trong giỏ hàng và tổng giá trị của chúng
		$json['total'] = cartGetTextCountAndTotal();
				
	} 
	else 
	{
		$json['redirect'] = urlBookDetails().'&book_id='.$_POST['book_id']; 
	}
}	
	
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);