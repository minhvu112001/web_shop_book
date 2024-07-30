<?php
// Cấu hình hệ thống
include_once 'configs.php';
// Thư viện hàm
include_once 'lib/table/table.book.php';
include_once 'cart-session.php';

$json = array();

if (!empty($_POST['quantity'])) 
{
	// Cập nhật giỏ hàng
	foreach ($_POST['quantity'] as $key => $value) 
	{
		cartUpdate($key, $value);
	}
			
	$_SESSION['success'] = 'Đã cập nhật giỏ hàng thành công !';

	unset($SESSION['shipping_method']);
	unset($SESSION['shipping_methods']);
	unset($SESSION['payment_method']);
	unset($SESSION['payment_methods']);

	// Điều hướng
	header ("location: ".urlCart());
}

header("Content-Type: application/json;charset=UTF-8");
echo json_encode($json);
