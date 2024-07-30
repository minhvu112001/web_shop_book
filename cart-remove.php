<?php
// Cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/table/table.book.php';
include_once 'cart-session.php';

$json = array();

// Xóa bỏ sản phẩm khỏi giỏ hàng
if (isset($_POST['key'])) 
{
	cartRemove($_POST['key']);

	$_SESSION['success'] = 'Đã xóa bỏ sản phẩm khỏi giỏ hàng';

	unset($_SESSION['shipping_method']);
	unset($_SESSION['shipping_methods']);
	unset($_SESSION['payment_method']);
	unset($_SESSION['payment_methods']);
			
	$json['total'] = cartGetTextCountAndTotal();
}	
		
header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);